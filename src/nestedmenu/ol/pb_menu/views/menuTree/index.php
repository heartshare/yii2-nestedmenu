<?php
/**
 * @package pb_menu\views
 */
?>
<?php
$this->breadcrumbs=array(
    'Home' => array(Yii::app()->homeUrl),
    'Menu Trees',
);
$this->menu=array(
array('label'=>'Create MenuTree','url'=>array('create')),
array('label'=>'Manage MenuTree','url'=>array('admin')),
);
?>

<h1>Menu Trees</h1>

<?php $this->widget('bootstrap.widgets.BsListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
