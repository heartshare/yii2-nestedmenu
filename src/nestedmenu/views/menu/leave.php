<?php
use nestedmenu\helpers\Glyph;

//$config = common\modules\nestedmenu\models\NestedMenuConfig::find()->where(['tree_id' => $model->id]);
//$profile = common\modules\nestedmenu\models\NestedMenuProfile::find()->where(['tree_id' => $model->id]);
//\yii\helpers\VarDumper::dump($model->config,10,true);
?>
<div class="well well-sm">
    <div class="row">
        <div class="col-lg-6">
            <h4><?= $model->profile->title ?></h4>
        </div>
        <div class="col-lg-6">
            <div class="btn-group pull-right">
                <button data-id="<?= $model->id ?>" type="button" class="btn btn-success appendToList">
                    <?= Glyph::icon(Glyph::ICON_PLUS_SIGN) ?>
                </button>
                <button type="button" class="btn btn-info editListItem">
                    <?= Glyph::icon(Glyph::ICON_EDIT) ?>
                </button>
                <button type="button" class="btn btn-danger removeFromList">
                    <?= Glyph::icon(Glyph::ICON_TRASH) ?>
                </button>
            </div>
        </div>
    </div>
</div>