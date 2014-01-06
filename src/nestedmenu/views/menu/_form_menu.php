<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use nestedmenu\helpers\ActiveFormHelper;

/**
 * @var yii\web\View $this
 * @var common\modules\nestedmenu\models\NestedMenu $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="nested-menu-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => ActiveFormHelper::formHorizontalGroupTemplate('col-lg-10'),
            'labelOptions' => [
                'class' => 'col-lg-2 control-label'
            ],
        ]
    ]); ?>
		<?= $form->field($model, 'title')->textInput() ?>
		<?= $form->field($model, 'description')->textarea() ?>
    <?= ActiveFormHelper::horizontalFormButton($model->isNewRecord ? 'Create' : 'Update', $model->isNewRecord ?['buttonOptions'=>['class' =>  'btn btn-success']]:[]) ?>
	<?php ActiveForm::end(); ?>

</div>
