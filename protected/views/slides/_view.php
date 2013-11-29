<?php
/* @var $this SlidesController */
/* @var $data Slides */
?>

<div class="view">
    <div class="slides_image">
        <?php 
        if(($data->imageurl=="")||(is_null($data->imageurl)))
            echo "<img src='".Yii::app()->request->baseUrl."/images/thrive.png'>";
        else 
            echo "<img src='{$data->imageurl}'>";
        ?>
    </div>
    <div class="slides_info">
        <div class="slides_link">
            <span class="slide_lable"><?php echo CHtml::encode($data->getAttributeLabel('link')); ?>:</span>
            <?php echo CHtml::encode($data->link); ?>
        </div>
        <div class="slides_caption">
            <span class="slide_lable"><?php echo CHtml::encode($data->getAttributeLabel('caption')); ?>:</span>
                <?php echo CHtml::encode($data->caption); ?>
        </div>
        <div class="slides_starts">
            <span class="slide_lable"><?php echo CHtml::encode($data->getAttributeLabel('starts')); ?>:</span>
                <?php echo CHtml::encode(date("m/d/y",$data->starts)); ?>
        </div>
        <div class="slides_expires">
            <span class="slide_lable"><?php echo CHtml::encode($data->getAttributeLabel('expires')); ?>:</span>
                <?php echo CHtml::encode(date("m/d/y",$data->expires)); ?>
        </div>
        <div class="slides_controls">
            <a href="/mobile/ithrive/index.php/slides/update/<?php echo $data->id; ?>" title="Update" class="update">
                <img alt="Update" src="/mobile/ithrive/assets/b111dc47/gridview/update.png">
            </a>
            <a href="/mobile/ithrive/index.php/slides/delete/<?php echo $data->id; ?>" title="Delete" class="delete">
                <img alt="Delete" src="/mobile/ithrive/assets/b111dc47/gridview/delete.png">
            </a>
        </div>
    </div>
    <div class="clear"></div>
</div>