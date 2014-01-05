<?php
/**
 * @package pb_menu\views
 */
?>
<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
    'layout' => BSHtml::FORM_LAYOUT_HORIZONTAL
)); ?>

		<?php echo $form->textFieldControlGroup($model,'id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldControlGroup($model,'title',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textAreaControlGroup($model,'info',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo BSHtml::formActions(array(
        BSHtml::submitButton('Search', array('color' => BSHtml::BUTTON_COLOR_PRIMARY)),
    )); ?>
<?php $this->endWidget(); ?>
