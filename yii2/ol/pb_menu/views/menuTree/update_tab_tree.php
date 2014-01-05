<?php
/**
 * @package pb_menu\views
 */
?>
<div class="row">
    <h3>
        <?php echo $model->title; ?>
    </h3>
    <p>
        <?php echo $model->info; ?>
    </p>
</div>
<div class="row">
    <?php echo BSHtml::buttonGroup(array(
//        array('label'=>'create Task', 'url'=>'#','icon' => 'plus-sign','id' => 'createTask'),
        array('label'=>'save','type' => 'success', 'url'=>'#','icon' => 'plus-sign white','id' => 'serialize','color' => BSHtml::BUTTON_COLOR_SUCCESS)
    ),array('size' => BSHtml::BUTTON_SIZE_MINI)); ?>
</div>
<div class="nestedSort">
    <?php $this->renderPartial('list_tree',array('tasks' => $model->list)) ?>
</div>
<div>
    <pre>
        <code id="toArrayOutput"></code>
    </pre>
</div>