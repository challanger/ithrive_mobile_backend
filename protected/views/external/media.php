<?php
foreach($categories as $category)
{
    echo "<div class='external_category_main'>";
    
    
    echo "<div class='external_category_image'>";
    echo "<img src='";
    if(($category->imageurl=="")||(is_null($category->imageurl)))
    {
        echo Yii::app()->baseUrl."/images/message_category_default_100_100.png";
    }
    else 
    {
        echo $category->imageurl;
    }
    echo "' alt='Category {$category->title}'/>";
    echo "</div>";
    echo "<div class='external_category_info'>";
    echo "<h2 class='external_category_title'>{$category->title}</h2>";
    echo "<div class='external_category_authors'>{$category->author}</div>";
    echo "</div>";
    echo "<div style='clear:both;'></div>";
    
    $messages=  Message::model()->findAllByAttributes(array("category"=>$category->id,'active'=>1),array('order' =>'date desc'));
    if(count($messages)>0)
    {
       echo "<div class='external_category_messages'>";
       $i=0;
       foreach($messages as $message)
       {
           if($message->active==1)
           {
               if(($i%2)==0)
                   echo "<div class='external_category_message message_odd'>";
               else 
                   echo "<div class='external_category_message message_even'>";
               echo "<div class='external_message_title'><a target='_blank' href='{$message->url}'>{$message->title}</a></div>";
               echo "<div class='external_message_date'>{$message->getDate()}</div>";
               echo "<div style='clear:both;'></div>";
               echo "</div>";
               $i++;
           }
       }
       echo "</div>";
    }
    
    echo "</div>";
}
?>
