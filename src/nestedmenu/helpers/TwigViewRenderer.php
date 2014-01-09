<?php
/**
 * User: Pascal Brewing
 * Date: 21.11.13
 * Time: 18:39
 * @package nestedmenu\helpers
 * Class TwigViewRenderer
 */
namespace nestedmenu\helpers;

use yii\twig\ViewRenderer;

use nestedmenu\Typo;
use nestedmenu\Glyph;
use nestedmenu\ActiveFormHelper;

/**
 * Class TwigViewRenderer
 * @package nestedmenu\helpers
 */
class TwigViewRenderer extends ViewRenderer {

    public function init(){
        parent::init();
        $this->twig->addGlobal('typo',new Typo());
        $this->twig->addGlobal('glyph',new Glyph());
        $this->twig->addGlobal('activeformhelper',new ActiveFormHelper());
    }

} 