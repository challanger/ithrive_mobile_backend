<?php
/* @var $this SlidesController */
/* @var $model Slides */

$this->breadcrumbs=array(
	'Slides'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Slides', 'url'=>array('index')),
	array('label'=>'Create Slides', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#slides-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Slides</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'slides-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'imageurl',
		'link',
		'caption',
		array(
                    'name'=>'starts',
                    'value'=>'$data->getDateStarts()'),
                array(
                    'name'=>'expires',
                    'value'=>'$data->getDateExpires()'),
		/*
		'created_by',
		'created',
		'updated_by',
		'updated',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
