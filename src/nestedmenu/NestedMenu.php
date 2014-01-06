<?php


namespace nestedmenu;

use nestedmenu\assets\NestedAssets;
use Yii;
use yii\helpers\VarDumper;

class NestedMenu extends \yii\base\Module
{
	public $controllerNamespace = 'common\modules\nestedmenu\controllers';

	public function init()
	{
		parent::init();
        Yii::setAlias('@nestedmenu', __DIR__);
//        VarDumper::dump(Yii::getAlias('@nestedmenu'),10,true);
		// custom initialization code goes here
	}
}
