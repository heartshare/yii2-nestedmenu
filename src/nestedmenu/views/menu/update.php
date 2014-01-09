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

<?= Typo::pageHeader($this->title,$model->title) ?>

<!--	--><?php //echo $this->render('_form', [
//		'model' => $model,
//	]); ?>
<?= Html::button(Glyph::icon(Glyph::ICON_PLUS_SIGN),['class' => 'appendToList btn btn-success','data-id' => $model->id]) ?>
    <?php
    /**
     * @package pb_menu\views
     */
    ?>
    <div class="taskTree">
        <?php
        $level=0;
        echo Html::beginTag('ol',array('class' => 'sortable'));
        $categories = NestedMenuTree::find()->where(['root' => $model->id])->addOrderBy('lft')->all();
        $level = 0;
//        //CVarDumper::dump($tasks,100,true);
//        foreach ($categories as $n => $category)
//        {
//            if ($category->level == $level) {
//                echo Html::endTag('li') . "\n";
//            } elseif ($category->level > $level) {
//                echo Html::beginTag('ul') . "\n";
//            } else {
//                echo Html::endTag('li') . "\n";
//
//                for ($i = $level - $category->level; $i; $i--) {
//                    echo Html::endTag('ul') . "\n";
//                    echo Html::endTag('li') . "\n";
//                }
//            }
//
//            echo Html::beginTag('li');
//            echo Html::encode($category->title);
//            $level = $category->level;
//        }
//
//        for ($i = $level; $i; $i--) {
//            echo Html::endTag('li') . "\n";
//            echo Html::endTag('ul') . "\n";
//        }
        foreach($categories as $n=>$task)
        {
//            \yii\helpers\VarDumper::dump($task->children()->all(),10,true);
//            if($task->children()->all())
            if($task->level==$level){
                echo Html::endTag('li');
            }else if($task->level>$level ){
                if($task->level != 1)
                    echo Html::beginTag('ol');
            }else {
                echo Html::endTag('li');

                for($i=$level-$task->level;$i;$i--)
                {
                    echo Html::endTag('ol');
                    echo Html::endTag('li');
                }
            }

            echo Html::beginTag('li',array('class' => $task->level>1?'sub_item':'','id' => 'list_'.$task->id));
            //echo Html::encode($task->name.$task->level.' root:'.$task->isRoot().' leaf:'.$task->isLeaf());
            echo $this->render('leave',array('model' => $task));
            $level=$task->level;
        }

        for($i=$level;$i;$i--)
        {
            echo Html::endTag('li');
            if($task->level != 1)
                echo Html::endTag('ol');
        }
        echo Html::endTag('ol');
        ?>
    </div>
    <?php
        Modal::begin([
          'header' => '<h2>Hello world</h2>',
          'toggleButton' => ['label' => 'click me','class' => 'btn btn-primary'],
            'id' => 'nested_menu_modal'
      ]);




        Modal::end();
    ?>
</div>
