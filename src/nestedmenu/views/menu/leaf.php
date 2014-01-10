<?php
use nestedmenu\helpers\Glyph;

//$config = nestedmenu\models\NestedMenuConfig::find()->where(['tree_id' => $model->id]);
//$profile = nestedmenu\models\NestedMenuProfile::find()->where(['tree_id' => $model->id]);
use \yii\helpers\VarDumper;
//VarDumper::dump($model->isRoot()); //true;
//VarDumper::dump($model->isLeaf()); //false;
?>
<div class="well well-sm">
    <div class="row">
        <div class="col-lg-6">
            <h4><?= $model->profile->title.' '.$model->id ?></h4>
        </div>
        <div class="col-lg-6 last">

            <div class="btn-group pull-right text-right">
                <button data-id="<?= $model->id ?>" type="button" class="btn btn-success appendToList">
                    <?= Glyph::icon(Glyph::ICON_PLUS_SIGN) ?>
                </button>
                <button type="button" class="btn btn-info editListItem">
                    <?= Glyph::icon(Glyph::ICON_EDIT) ?>
                </button>
                <button type="button" class="btn btn-danger removeFromList <?= !$model->isRoot() && !$model->isLeaf() || !$model->isRoot()?'':'disabled'?>">
                    <?= Glyph::icon(Glyph::ICON_TRASH) ?>
                </button>
            </div>
        </div>
    </div>
</div>