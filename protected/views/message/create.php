<?php
/* @var $this MessageController */
/* @var $model Message */

$this->breadcrumbs=array(
	'Messages'=>array('category/index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Messages', 'url'=>array('category/index')),
	//array('label'=>'Manage Message', 'url'=>array('admin')),
);
?>

<h1>Create Message</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>