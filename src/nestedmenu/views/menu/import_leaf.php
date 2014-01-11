<?php
use nestedmenu\helpers\Glyph;

//$config = nestedmenu\models\NestedMenuConfig::find()->where(['tree_id' => $model->id]);
//$profile = nestedmenu\models\NestedMenuProfile::find()->where(['tree_id' => $model->id]);
use \yii\helpers\VarDumper;
//VarDumper::dump($model->config->attributes,10,true); //true;
//VarDumper::dump($model->attributes()); //false;
$children = $model->children()->one();
?>
<div data-well="<?= $model->id ?>" class="well well-sm leaf">
    <div class="row">
        <div class="col-lg-6 col-xs-12">
            <h4>
                <?= !$model->isRoot() && !$model->isLeaf() || !$model->isRoot()
                    ?Glyph::icon(Glyph::ICON_LEAF)
                    :Glyph::icon(Glyph::ICON_TREE_DECIDUOUS)?> <?= $model->profile->title.' '.$model->id
                ?>
            </h4>
        </div>
        <div class="col-lg-6 col-xs-12 last">
            <div class="btn-group btn-group-sm pull-right text-right">
                <button
                    data-id="<?= $model->id ?>"
                    type="button"
                    class="btn btn-warning appendToList"
                    data-toggle="tooltip"
                    data-title="Create a new leaf after this"
                    >
                    <?= Glyph::icon(Glyph::ICON_PLUS_SIGN) ?>
                </button>
                <button
                    type="button"
                    class="btn btn-success editListItem"
                    data-toggle="tooltip"
                    data-title="Update"
                    >
                    <?= Glyph::icon(Glyph::ICON_EDIT) ?>
                </button>
                <button
                    type="button"
                    class="btn btn-danger removeFromList <?= !$model->isRoot() && !$model->isLeaf() || !$model->isRoot()?'':'disabled'?>"
                    data-toggle="tooltip"
                    data-title="delete"
                    confirm="Sure you want delete this Tree ?"
                    >
                    <?= Glyph::icon(Glyph::ICON_TRASH) ?>
                </button>
                <button
                    type="button"
                    class="btn btn-primary disclose <?= !empty($children)?'':'disabled'?>"
                    data-toggle="tooltip"
                    data-title="Open"
                    >
                    <?= Glyph::icon(Glyph::ICON_RESIZE_FULL) ?>
                </button>
                <button
                    type="button"
                    data-toggle="tooltip"
                    data-title="Atributes"
                    class="btn btn-info info"
                    id="open_submenu_<?= $model->id ?>"
                    >
                    <?= Glyph::icon(Glyph::ICON_INFO_SIGN) ?>
                </button>
            </div>
        </div>
        <div class="col-lg-12 col-xs-12 config fadeOutLeft animated hidden">
            <?= $this->render('_popover_info_model',['model' => $model]) ?>
        </div>
    </div>
</div>
<?php
$this->registerJs(
    "
        $('#open_submenu_{$model->id}').on('click',function(){
            $(\"[data-well='{$model->id}'] .config\").toggleClass('fadeOutLeft animated hidden').toggleClass('show fadeInLeft animated');
        });
    ".PHP_EOL,
    yii\web\View::POS_READY,
    "open_submenu_{$model->id}"
);
?>