<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
	array('label'=>'Update Users', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Users', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>View Users <?php echo $model->name; ?></h1>

<?php 
$attribute_name=$model->attributeLabels();
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'email',
                array(
                    'label'=>$attribute_name['active'],
                    'value'=>$model->getActiveWord()),
		'permission',
                array(
                    'label'=>$attribute_name['created_on'],
                    'value'=>$model->getDateCreated()),
                array(
                    'label'=>$attribute_name['updated_on'],
                    'value'=>$model->getDateUpdated()),
	),
)); ?>
