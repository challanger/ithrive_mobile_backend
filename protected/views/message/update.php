<?php
/* @var $this MessageController */
/* @var $model Message */

$this->breadcrumbs=array(
	'Messages'=>array('category/index'),
	//$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Messages', 'url'=>array('category/index')),
	//array('label'=>'Create Message', 'url'=>array('create')),
	//array('label'=>'View Message', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage Message', 'url'=>array('admin')),
);
?>

<h1>Update Message <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>