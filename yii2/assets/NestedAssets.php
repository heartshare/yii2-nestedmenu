<?php
namespace nestedmenu\assets;


use yii\web\AssetBundle;

/**
 * User: Pascal Brewing
 * Date: 26.12.13
 * Time: 13:19
 *
 * Class NestedAssets
 * @package nestedmenu\assets
 */
class NestedAssets extends AssetBundle{

    public $sourcePath = '@nestedmenu/dist';
    public $css = [
        'css/tasktree.css',
    ];
    public $js = [
        'js/jquery.mjs.nestedSortable.js',
        'js/menulist-min.js',
//        'dist/js/foundation.min.js',
//        'dist/js/foundation.topbar.js',
//        'dist/js/app.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\jui\SortableAsset'

    ];

} 