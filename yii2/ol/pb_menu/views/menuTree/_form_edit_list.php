<?php
/**
 * @package pb_menu\views
 */
/* @var $this MenuListConfigController */
/* @var $model MenuListConfig */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'layout' => BSHtml::FORM_LAYOUT_HORIZONTAL,
    'id' => 'menu-list-config-_form_edit_list-form'
)); ?>
    <?= $form->errorSummary($model) ?>
    <?= $form->hiddenField($model,'menu_list_id') ?>
    <?= $form->textFieldControlGroup($model,'name'); ?>
    <?= $form->textFieldControlGroup($model,'menu_url') ?>

    <?= $form->checkBoxControlGroup($model,'use_visible',array('disabled' => false)) ?>
    <?= $form->dropDownListControlGroup($model, 'url_target',
            array('_self' =>'_self','_blank' => '_blank','_top'=>'_top'),
            array('empty' => 'Target auswählen')
        );
    ?>
    <?= $form->checkBoxControlGroup($model,'active',array('disabled' => false)) ?>
    <?= $form->inlineRadioButtonListControlGroup($model, 'icon_id',
            $model->getIconAsArray()
        );
    ?>
<?= BSHtml::formActions(array(
        BSHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('color' => BSHtml::BUTTON_COLOR_PRIMARY,'id' => 'submitEditList')),
    )); ?>
<?php $this->endWidget(); ?>