<?php
/* @var $this MessageController */
/* @var $model Message */

$this->breadcrumbs=array(
	'Messages'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Message', 'url'=>array('index')),
	array('label'=>'Create Message', 'url'=>array('create')),
	array('label'=>'Update Message', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Message', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Message', 'url'=>array('admin')),
);
?>

<h1>View Message <?php echo $model->title; ?></h1>

<?php $attribute_name=$model->attributeLabels();
    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
                'title',
                array(
                    'label'=>$attribute_name['category'],
                    'value'=> $model->category0->title),
		'url',
                array(
                    'label'=>$attribute_name['date'],
                    'value'=>$model->getDate()),
		/*'created_by',
		'created',
		'updated_by',
		'updated',*/
	),
)); ?>
