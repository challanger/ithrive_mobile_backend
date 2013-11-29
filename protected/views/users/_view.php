<?php
/* @var $this UsersController */
/* @var $data Users */
?>

<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->getActiveWord()); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('permission')); ?>:</b>
	<?php echo CHtml::encode($data->permission); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_on')); ?>:</b>
	<?php echo CHtml::encode(date("M d Y h:i:s a",$data->created_on)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_on')); ?>:</b>
	<?php echo CHtml::encode(date("M d Y h:i:s a",$data->updated_on)); ?>
	<br />


</div>