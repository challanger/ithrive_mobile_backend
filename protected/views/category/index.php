<?php
/* @var $this CategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Messages',
);

$this->menu=array(
	array('label'=>'Create Category', 'url'=>array('create')),
        array('label'=>'Create Message', 'url'=>array('message/create')),
	//array('label'=>'Manage Category', 'url'=>array('admin')),
);
?>

<h1>Messages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
