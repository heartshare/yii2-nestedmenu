<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var nestedmenu\models\Menu $model
 */
\nestedmenu\assets\NestedAssets::register($this);

$this->title = 'Update Menu: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="menu-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
