<?php
/**
 * @package pb_menu
 * Class Pb_menuModule
 */
class PbMenuModule extends CWebModule
{
    /**
     * @var return the assets FolderUrl
     */
    public $assetsUrl;
    /**
     * @var boolean whether to force copying of assets.
     * Useful during development and when upgrading the module.
     */
    public $forceCopyAssets = true;

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'menu.models.*',
			'menu.components.*',
		));
	}

    public function beforeControllerAction($controller, $action)
    {
        if(parent::beforeControllerAction($controller, $action))
        {

            $this->assetsUrl = $this->getAssetsUrl();
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }

    /**
     * Returns the URL to the published assets folder.
     * @return string the URL.
     */
    protected function getAssetsUrl()
    {
        if (isset($this->assetsUrl))
            return $this->assetsUrl;
        else
        {
            $assetsPath = Yii::getPathOfAlias('menu.assets');
            $assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, $this->forceCopyAssets);

            return $this->assetsUrl = $assetsUrl;
        }
    }

    /**
     * Register a specific js file in the asset's js folder
     * @param string $jsFile
     * @param int $position the position of the JavaScript code.
     * @see CClientScript::registerScriptFile
     * @return $this
     */
    public function registerAssetJs($jsFile, $position = CClientScript::POS_END)
    {
        Yii::app()->getClientScript()->registerScriptFile($this->getAssetsUrl() . "/js/{$jsFile}", $position);
        return $this;
    }

    /**
     * Registers a specific css in the asset's css folder
     * @param string $cssFile the css file name to register
     * @param string $media the media that the CSS file should be applied to. If empty, it means all media types.
     * @return $this
     */
    public function registerAssetCss($cssFile, $media = '')
    {
        Yii::app()->getClientScript()->registerCssFile($this->getAssetsUrl() . "/css/{$cssFile}", $media);
        return $this;
    }
}
