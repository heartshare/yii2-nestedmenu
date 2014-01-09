<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var nestedmenu\models\NestedMenu $model
 */

$this->title = 'Create Nested Menu';
$this->params['breadcrumbs'][] = ['label' => 'Nested Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nested-menu-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form_menu', [
		'model' => $model,
	]); ?>

</div>
