<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MobileController
 *
 * @author appleuser
 */
class MobileController extends Controller
{
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
                   ),
                   array('allow', // allow admin user to perform 'admin' and 'delete' actions
                           'actions'=>array('index','view','create','update','admin','delete'),
                           //'users'=>array('admin'),
                           'expression'=>"Yii::app()->user->has_permission('admin')",
                   ),*/
                   array('deny',  // deny all users
                           'users'=>array('*'),
                   ),
           );
    }
    /**
    * Lists all models.
    */
    public function actionIndex($id)
    {
        $last_update=$id;//TODO fix this quick hack into a nicer url at some point
        $send=array();
        //TODO put a patch in place that if their is no image a default image will be sent
        $slides=$this->loadSlides($last_update);
        $media=$this->loadMedia($last_update);
        $messages=$this->loadMessage($last_update);
        
        $send['slides']=$slides;
        $send['media']=$media;
        $send['messages']=$messages;
        
        echo json_encode($send);
           /*$dataProvider=new CActiveDataProvider('Message');
           $this->render('index',array(
                   'dataProvider'=>$dataProvider,
           ));*/
    }
    
    /**
     * pull all the slides that are active
     * @return array
     */
    private function loadSlides($last_update)
    {
        $slides=  Slides::model()->findAll('updated>:dateCode',array(':dateCode'=>$last_update));
        
        if($slides===null)
            return array();
        else
        {
            $send_slides=array();
            foreach($slides as $slide)
            {
                $send_slide=array('id'=>$slide->id,
                    'imageurl'=>$slide->imageurl,
                    'link'=>$slide->link,
                    'caption'=>$slide->caption,
                    'start_date'=>$slide->starts,
                    'expires'=>$slide->expires,
                    'active'=>$slide->active,
                    'last_modified'=>$slide->updated);
                if($slide->imageurl=="")
                    $send_slide['imageurl']=Yii::app()->getBaseUrl(true) . "/images/slide_default_260_250.png"; 
                array_push($send_slides, $send_slide);
            }
            return $send_slides;
        }
    }
    
    /**
     * pull all the media
     * @return array
     */
    private function loadMedia($last_update)
    {
        $criteria=new CDbCriteria(); 
        $criteria->order="date";
        $criteria->condition='updated>:dateCode';
        $criteria->params=array(':dateCode'=>$last_update);
        $messageCategories=  Category::model()->findAll($criteria);
        
        if($messageCategories===null)
        {
            return array();
        }
        else 
        {
            $send_media=array(); 
            foreach($messageCategories as $category)
            {
                $send_category=array("id"=>$category->id,
                    'imageurl'=>$category->imageurl,
                    'title'=>$category->title,
                    'author'=>$category->author,
                    'date'=>$category->date,
                    'active'=>$category->active,
                    'last_modified'=>$category->updated);
                if($category->imageurl=="")
                    $send_category['imageurl']=Yii::app()->getBaseUrl(true) . "/images/message_category_default_100_100.png"; 
                    array_push($send_media, $send_category);
            }
            return $send_media;
        }
    }
   
    /**
     * pull all the message that fall under the give category ID
     * @param int $last_update
     * @return array
     */
    private function loadMessage($last_update)
    {
        $criteria=new CDbCriteria(); 
        $criteria->order="date";
        $criteria->condition='updated>:dateCode';
        $criteria->params=array(':dateCode'=>$last_update);
        $messages=  Message::model()->findAll($criteria);
        
        if($messages===null)
        {
            return array();
        }
        else 
        {
            $send_messages=array();
            foreach($messages as $message)
            {
                $send_message=array('id'=>$message->id,
                    'catID'=>$message->category,
                    'url'=>$message->url,
                    'title'=>$message->title,
                    'date'=>$message->date,
                    'active'=>$message->active,
                    'last_modified'=>$message->updated);
                array_push($send_messages, $send_message);
            }
            return $send_messages;
        }
    }
}

?>
