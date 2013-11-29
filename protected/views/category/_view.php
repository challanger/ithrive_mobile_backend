<?php
/* @var $this CategoryController */
/* @var $data Category */
?>

<div class="view">
    <div class="category_image">
        <?php 
            if($data->imageurl=="")
                echo "<img src='".Yii::app()->request->baseUrl."/images/thrive.png'>";
            else 
                echo "<img src='{$data->imageurl}'>";
        ?>
    </div>
    <div class="category_info">
        <div class="category_tilte"><?php echo CHtml::encode($data->title); ?></div>
        <div class="category_author"><?php echo CHtml::encode($data->author); ?></div>
        <div class="category_date"><?php echo CHtml::encode(date("m/d/y",$data->date)); ?></div>
        <div class="category_controls">
            <a href="/mobile/ithrive/index.php/category/update/<?php echo $data->id; ?>" title="Update" class="update">
                <img alt="Update" src="/mobile/ithrive/assets/b111dc47/gridview/update.png">
            </a>
            <a href="/mobile/ithrive/index.php/category/delete/<?php echo $data->id; ?>" title="Delete" class="delete">
                <img alt="Delete" src="/mobile/ithrive/assets/b111dc47/gridview/delete.png">
            </a>
        </div>
    </div>
    <div class="clear"></div>
    <div class="category_messages">
        <?php 
        //pull all the messages for this category
        $messages=$data->messages;
        foreach($messages as $message)
        {
            if($message->active==1)
            {
                $this->renderPartial('_messageView',array(
                            'model'=>$message
                    ));
            }
        }
        ?>
    </div>
</div>