<?php
use yii\helpers\Html;
use common\helpers\Glyph;
use common\helpers\Typo;
use nestedmenu\assets\NestedAssets;
use nestedmenu\models\NestedMenuTree;
use yii\bootstrap\modal;

NestedAssets::register($this);

$this->title = 'Update Menu: ' . $model->profile->title;
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

?>
<div class="menu-update">

    <?= Typo::pageHeader($this->title, $model->title) ?>

    <!--	--><?php //echo $this->render('_form', [
    //		'model' => $model,
    //	]);
    ?>
    <?= Html::button(Glyph::icon(Glyph::ICON_PLUS_SIGN), ['class' => 'appendToList btn btn-success', 'data-id' => $model->id]) ?>
    <div class="row">
        <div class="col-lg-6 tree connect">
            <div class="taskTree">
                <?php
                $level = 0;
                echo Html::beginTag('ol', array('class' => 'sortable','id' => 'taskTree1'));
                $tree = NestedMenuTree::find()->with('config','profile')->where(['root' => $model->id])->addOrderBy('lft')->all();
                $level = 0;
                foreach ($tree as $n => $task) {
//            \yii\helpers\VarDumper::dump($task->children()->all(),10,true);
//            if($task->children()->all())
                    if ($task->level == $level) {
                        echo Html::endTag('li');
                    } else if ($task->level > $level) {
                        if ($task->level != 1)
                            echo Html::beginTag('ol');
                    } else {
                        echo Html::endTag('li');

                        for ($i = $level - $task->level; $i; $i--) {
                            echo Html::endTag('ol');
                            echo Html::endTag('li');
                        }
                    }

                    $parent = $task->parent()->one();
                    $prev = $task->prev()->one();
                    $next = $task->next()->one();

                    echo Html::beginTag(
                        'li',
                        [
                            'class' => $task->level > 1 ? 'sub_item fadeInLeftBig animated' : '',
                            'id' => 'list_' . $task->id,
                            'data-asset-id' => $task->id,
                            'data-next' => isset($next->id) ? $next->id : false,
                            'data-prev' => isset($prev->id) ? $prev->id : false,
                            "data-parent" => isset($parent->id) ? $parent->id : false
                        ]
                    );
                    //echo Html::encode($task->name.$task->level.' root:'.$task->isRoot().' leaf:'.$task->isLeaf());
                    echo $this->render('leaf', array('model' => $task));
                    $level = $task->level;
                }

                for ($i = $level; $i; $i--) {
                    echo Html::endTag('li');
                    if ($task->level != 1)
                        echo Html::endTag('ol');
                }
                echo Html::endTag('ol');
                ?>
            </div>
        </div>
        <div class="col-lg-6 configure connect">
        </div>
        <div class="clearfix"></div>
    </div>

    <?php
    Modal::begin([
        'header' => '<h2>Hello world</h2>',
        'toggleButton' => ['label' => 'click me', 'class' => 'btn btn-primary'],
        'id' => 'nested_menu_modal'
    ]);
    Modal::end();
    ?>
</div>
