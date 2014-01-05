<?php
/**
 * @package pb_menu\views
 */
?>
<?php
$this->breadcrumbs=array(
    'Home' => array(Yii::app()->homeUrl),
	'Menu Trees'=>array('index'),
	$model->title,
);
$this->menu=array(
    array('label'=>'Manage MenuTree','url'=>array('admin')),
    array('label'=>'Create MenuTree','url'=>array('create')),
    array('label'=>'Update MenuTree','url'=>array('update','id'=>$model->id)),
    array('label'=>'Delete MenuTree','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>
<h1>Menü Baum / <?php echo $model->title; ?></h1>
<?php $this->widget('zii.widgets.CDetailView',array(
    'data'=>$model,
    'attributes'=>array(
		'id',
		'title',
		'info',
        array(
            'label'=>'Menüpunkte',
            'type'=>'raw',
            'value' => count($model->list)-1
        )
    ),
)); ?>
