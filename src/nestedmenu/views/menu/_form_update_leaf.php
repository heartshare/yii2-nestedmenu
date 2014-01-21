<?php
use nestedmenu\helpers\ActiveFormHelper;
?>
<?php $form = \yii\widgets\ActiveForm::begin(
    [
        'action' =>$action,
        'id' => 'form_update_leaf'
    ]
); ?>
<?= \yii\helpers\Html::activeHiddenInput($model,'id') ?>
<?= $form->field($model->profile, 'title') ?>
<?= $form->field($model->profile, 'description')->textarea(); ?>
<?= $form->field($model->config, 'url_shema') ?>
<?= $form->field($model->config, 'url_relative')->textInput(['disabled' => true]) ?>
<?= $form->field($model->config, 'url_absolute')->textInput(['disabled' => true]) ?>
<?=
$form->field($model->config, 'url_target')->dropDownList([
    '_self' => '_self',
    '_blank' => '_blank',
    '_top' => '_top'
]) ?>
<?= \yii\helpers\Html::submitButton($model->isNewRecord ? 'Create' : 'Update', $model->isNewRecord ?['class' =>  'btn btn-success']:['class' =>  'btn btn-primary']) ?>
<?php \yii\widgets\ActiveForm::end(); ?>
