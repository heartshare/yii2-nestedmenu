<?php

/**
 * Created by JetBrains PhpStorm.
 * User: pascal
 * Date: 15.07.13
 * Time: 21:11
 *
 * @package pb_menu/widgets
 */

class SidrBar extends CInputWidget {

    public $treeId = false;
    public $navId = 'not_defined';
    public $navButton = 'not_defined';

    public function init()
    {
        parent::init();
        if(!$this->treeId)
            throw new CHttpException('500','$treeId is required');

        $this->registerClientScript();
        $this->render(
           'topnavbar',
           array(
               'model'=> $this->getTreeById(),
               'navId' => $this->navId,
               'navButton' => $this->navButton
           )
        );
    }

    private function getTreeById()
    {
        return MenuList::model()->getTreeByPk($this->treeId);
    }

    /**
     * Register required script files
     */
    public function registerClientScript()
    {
        Yii::app()->menu->registerAssetCss('/stylesheets/jquery.sidr.light.css');
        Yii::app()->menu->registerAssetCss('topNavBar.css');
        Yii::app()->menu->registerAssetJs('jquery.sidr.min.js',CClientScript::POS_END);
        Yii::app()->clientScript->registerScript(uniqid().'_menu',
            "
            $('#{$this->navButton}').sidr({
              name: 'sidr-left',
              side: 'left' // By default
//              ,body:'#page'
            });
//            jQuery.sidr( ['toogle'],[ 'sidr-left'] )
            ",
            CClientScript::POS_READY
        );
    }

}