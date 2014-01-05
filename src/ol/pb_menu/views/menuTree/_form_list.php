<?php
/**
 * @package pb_menu\views
 */
?>
<?php $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'layout' => BSHtml::FORM_LAYOUT_HORIZONTAL,
    'id' => 'todo-list-task-_form_todolisttask-form'
)); ?>
    <?= $form->errorSummary($model) ?>
    <?php echo $form->textFieldControlGroup($model,'name'); ?>
    <?php echo BSHtml::formActions(array(
        BSHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('color' => BSHtml::BUTTON_COLOR_PRIMARY)),
    )); ?>
<?php $this->endWidget(); ?>