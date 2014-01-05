<?php
/**
 * @package pb_menu\views
 */
?>

<?php $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'layout' => BSHtml::FORM_LAYOUT_HORIZONTAL,
)); ?>
    <?= $form->errorSummary($model) ?>
	<?php echo $form->textFieldControlGroup($model,'title',array('class'=>'span5','maxlength'=>255)); ?>
	<?php echo $form->textAreaControlGroup($model,'info',array('rows'=>6, 'cols'=>50, 'class'=>'span5')); ?>
    <?php echo BSHtml::formActions(array(
        BSHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('color' => BSHtml::BUTTON_COLOR_PRIMARY)),
    )); ?>
<?php $this->endWidget(); ?>