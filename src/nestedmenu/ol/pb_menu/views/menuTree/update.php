<?php
/**
 * @package pb_menu\views
 */
?>
<?php
$this->breadcrumbs=array(
    'Home' => array(Yii::app()->homeUrl),
	'Menu Trees'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
        array('label'=>'Manage MenuTree','url'=>array('admin')),
        array('label'=>'Create MenuTree','url'=>array('create')),
        array('label'=>'View MenuTree','url'=>array('view','id'=>$model->id)),
	);
	?>

	<h1>Update MenuTree <?php echo $model->title; ?></h1>
    <ul class="nav nav-tabs" id="tree_tabs">
        <li><a href="#menutree">Menü bearbeiten</a></li>
        <li class="active"><a href="#menulist">Menü Baum</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" id="menutree">
            <?php $this->renderPartial('_form',array('model'=>$model)) ?>
        </div>
        <div class="tab-pane active" id="menulist">
            <div class="span8">
                <?php $this->renderPartial('update_tab_tree',array('model'=>$model)) ?>
            </div>
        </div>
    </div>
<?php Yii::app()->clientScript->registerScript(
    'tree_update_tabs',
    "$('#tree_tabs a').click(function (e) {
          e.preventDefault();
          $(this).tab('show');
        })",
    CClientScript::POS_READY
) ?>
<?php $this->widget('bootstrap.widgets.BsModal', array(
    'id' => 'modal_append_task',
    'header' => 'Neuen Menüpunkt anlegen',
    'content' => '<div id="append"></div>',
)); ?>