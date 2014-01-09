<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use nestedmenu\helpers\ActiveFormHelper;

/**
 * @var yii\web\View $this
 * @var nestedmenu\models\NestedMenu $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="nested-menu-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal','id' => 'form_create_leaf'],
        'fieldConfig' => [
            'template' => ActiveFormHelper::formHorizontalGroupTemplate('col-lg-10'),
            'labelOptions' => [
                'class' => 'col-lg-2 control-label'
            ],
        ],
        'action' =>$action
    ]); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>
    <?= ActiveFormHelper::horizontalFormButton($model->isNewRecord ? 'Create' : 'Update', $model->isNewRecord ?['buttonOptions'=>['class' =>  'btn btn-success']]:[]) ?>
    <?php ActiveForm::end(); ?>

</div>
