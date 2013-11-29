<?php
/* @var $this SlidesController */
/* @var $model Slides */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'slides-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'imageurl'); ?>
		<?php echo $form->textField($model,'imageurl',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'imageurl'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'caption'); ?>
		<?php echo $form->textArea($model,'caption',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'caption'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'starts'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'name'=>'starts_save',
                                'value'=>Yii::app()->dateFormatter->format("MM/dd/yyyy",  $model->starts),
                                'options'=>array(
                                'showAnim'=>'fold',
                                ),
                                'htmlOptions'=>array(
                                'style'=>'height:15px;'
                                ),
                        )); 

//echo $form->dateSelector($model,'starts'); ?>
		<?php echo $form->error($model,'starts'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'expires'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'name'=>'expires_save',
                                'value'=>Yii::app()->dateFormatter->format("MM/dd/yyyy",  $model->expires),
                                'options'=>array(
                                'showAnim'=>'fold',
                                ),
                                'htmlOptions'=>array(
                                'style'=>'height:15px;'
                                ),
                        ));
                //echo $form->textField($model,'expires'); ?>
		<?php echo $form->error($model,'expires'); ?>
        </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->