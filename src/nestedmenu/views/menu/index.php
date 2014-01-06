<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\Glyph;
use yii\helpers\VarDumper;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\modules\nestedmenu\MenuQuery $searchModel
 */

$this->title = 'Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">
	<h1><?= Html::encode($this->title) ?></h1>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a(Glyph::icon(Glyph::ICON_TREE_DECIDUOUS).' Create Menu', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckBoxColumn'],
            ['attribute' =>'profile.title'],
			'title',
			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
