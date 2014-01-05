<?php
/**
 * @package pb_menu\views
 */
?>
<?php
$this->breadcrumbs=array(
    'Home' => Yii::app()->homeUrl,
	'Menu Trees'=>array('admin'),
	'Manage',
);

$this->menu=array(
    'items' =>array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create MenuTree','url'=>'create'),
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $.fn.yiiGridView.update('menu-tree-grid', {
            data: $(this).serialize()
        });
        return false;
    });
");
?>
<h1>Manage Menu Trees</h1>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.BsGridView',array(
'id'=>'menu-tree-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
    'type' => BSHtml::GRID_TYPE_CONDENSED,
'columns'=>array(
		'id',
		'title',
		'info',
array(
'class'=>'bootstrap.widgets.BsButtonColumn',
),
),
)); ?>
