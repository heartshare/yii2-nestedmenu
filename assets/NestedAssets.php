<?php
namespace nestedmenu\assets;


use yii\web\AssetBundle;
use frontend\assets\AppAsset;


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
    /**
     * @var array
     */
    public $css = [
        'css/animate.min.css',
        'css/tasktree.css',
    ];

    /**
     * @var array
     */
    public $js = [
        'js/jquery.mjs.nestedSortable.js',
        'js/menulist.js',
        'js/menulist-events.js',
//        'dist/js/foundation.min.js',
//        'dist/js/foundation.topbar.js',
//        'dist/js/app.js'
    ];
    /**
     * @var array
     */
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\jui\SortableAsset'
    ];
    /**
     * @var array
     */
    public $publishOptions = [
      'forceCopy' => true
    ];

} 