<?php

class ExternalController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/noformat';

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('media'),
				'users'=>array('*'),
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
	public function actionMedia()
	{
                Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/external_media.css');
		$this->render('media',array(
			'categories'=>$this->loadMedia(),
		));
	}

	/**
	 * Return the All of the active media items 
	 * @return Category the loaded model
	 * @throws CHttpException
	 */
	public function loadMedia()
	{
            $categories=  Category::model()->findAllByAttributes(array("active"=>1),array('order'=>'date desc'));
            if($categories===null)
                    throw new CHttpException(404,'No media can be found');
            return $categories;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Category $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
