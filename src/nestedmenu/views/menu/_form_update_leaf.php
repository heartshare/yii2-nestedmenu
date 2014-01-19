<?php $form = \yii\widgets\ActiveForm::begin(); ?>
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

<?php \yii\widgets\ActiveForm::end(); ?>
