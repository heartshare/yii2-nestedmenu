<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var nestedmenu\models\NestedMenu $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="nested-menu-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => \common\helpers\ActiveFormHelper::formHorizontalGroupTemplate('col-lg-10'),
            'labelOptions' => [
                'class' => 'col-lg-2 control-label'
            ],
        ]
    ]); ?>
		<?= $form->field($model, 'title')->textInput() ?>
		<?= $form->field($model, 'description')->textarea() ?>
    <?= \common\helpers\ActiveFormHelper::horizontalFormButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	<?php ActiveForm::end(); ?>

</div>
