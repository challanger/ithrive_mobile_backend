<?php

class MessageController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),*/
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','update','delete'),//,'index','view','admin'),
				//'users'=>array('admin'),
                                'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Message;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Message']))
		{
			$model->attributes=$_POST['Message'];

			$tempSave=CUploadedFile::getInstance($model,'url');
			if(!is_null($tempSave))
			{
				$filePath = Yii::app()->params['mediaAudoPath'] . $model->id."-".time().'.'. $tempSave->getExtensionName();
				$model->url = $filePath;
			}

      $date_parts=explode("/",$_POST['date_save']);
      if(count($date_parts)==3)
      {
          $model->date=  mktime(1, 1, 1, $date_parts[0], $date_parts[1], $date_parts[2]);
      }
      else
          $model->date=0;

			if($model->save())
			{
				if(!is_null($tempSave))
					$tempSave->saveAs(Yii::app()->params['webRoot'].$filePath);
				$this->redirect(array('category/index'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Message']))
		{
			$model->attributes=$_POST['Message'];

			$tempSave=CUploadedFile::getInstance($model,'url');
			if(!is_null($tempSave))
			{
				$filePath = Yii::app()->params['mediaAudoPath'] . $model->id."-".time().'.'. $tempSave->getExtensionName();
				$model->url = $filePath;
			}


      $date_parts=explode("/",$_POST['date_save']);
      if(count($date_parts)==3)
      {
          $model->date=  mktime(1, 1, 1, $date_parts[0], $date_parts[1], $date_parts[2]);
      }
      else
          $model->date=0;

			if($model->save())
			{
				if(!is_null($tempSave))
					$tempSave->saveAs(Yii::app()->params['webRoot'].$filePath);
				$this->redirect(array('category/index'));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
                $resource=$this->loadModel($id);
                $resource->active=0;
                $resource->save();

		//$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('category/index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Message');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Message('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Message']))
			$model->attributes=$_GET['Message'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Message the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Message::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Message $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='message-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
