<?php
/**
 * @package pb_menu\views
 */
?>
<?php
$this->breadcrumbs=array(
	'Menu Trees'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'Manage MenuTree','url'=>array('admin')),
);
?>

<h1>Create MenuTree</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>