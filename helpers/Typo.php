<?php
namespace nestedmenu\helpers;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\VarDumper;

/**
 * for using in Twig plz add a Global
 * $this->twig->addGlobal('typo',new Typo());
 *
 * Class Typo
 *
 * @author: Pascal Brewing < pascalbrewing@googlemail.com >
 * @see http://getbootstrap.com/
 * @since 2.0
 * @package nestedmenu\helpers
 */
class Typo {

    /**
     * @param string $title
     * @param string $small
     * @param array $htmlOptions
     * @return string
     * twig example set arr for htmlOptions
     * {% set classExpression = {
     *  'headerOptions':{
     *      'class':'page-header testwurst'
     *  }
     * } %}
     * twig example use arr for htmlOptions
     * {{ typo.pageHeader(model.h1,model.small,classExpression)|raw }}
     */
    public static function pageHeader($title ="",$small="",$htmlOptions = ['class' => 'page-header']){

        $headerOptions      = ArrayHelper::getValue($htmlOptions,'headerOptions',false);

        if($headerOptions)
            $htmlOptions    = $headerOptions;

        $content = '';
        if(!empty($title) || !empty($small))
            $content .= Html::beginTag('h1')."\n".$title."\n";

        if(!empty($small))
            $content .= Html::tag('small',$small)."\n";

        if(!empty($title) || !empty($small))
            $content .= Html::endTag('h1')."\n";

        return Html::tag('div',$content,$htmlOptions);
    }

    /**
     * <strong $htmlOptions>$strong</strong>$body
     * @param bool $strong
     * @param bool $body
     * @param array $htmlOptions
     * @return bool|string
     */
    public static function AlertBodyHelper($strong = false,$body=false,$htmlOptions=[]){
        if($strong)
            $body = Html::tag('strong',$strong,$htmlOptions).' '.$body;
        
        return $body;
    }

    /**
     * @see http://getbootstrap.com/css/#type-blockquotes
     * <blockquote>
     * <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
     * </blockquote>
     * ´´´php
     * htmlOptions
     * [
     *  'smallOptions' => ['class'...]
     *  'blockOptions' => ['class'...]
     *  'emphasisOption' => ['class'...]
     *  'pull' => ['right']
     * ]
     * ´´´
     * @param bool $body
     * @param bool $small
     * @param array $htmlOptions
     * @return string
     */
    public static function blockquote($body=false,$small=false,$htmlOptions=[]){

        $smallOptions   = ArrayHelper::getValue($htmlOptions,'smallOptions',false);
        $blockOptions   = ArrayHelper::getValue($htmlOptions,'blockOptions',[]);
        $emphasisOption = ArrayHelper::getValue($htmlOptions,'emphasisOption',false);
        $pull           = ArrayHelper::getValue($htmlOptions,'pull',false);

        if($pull)
            Html::addCssClass($blockOptions,'pull-'.$pull);

        $content = Html::beginTag('blockquote',$blockOptions);
        $content .= Html::tag('p',$body,$emphasisOption?$emphasisOption:[]);

        if(!empty($small))
            $content .= Html::tag('small',$small,$smallOptions?$smallOptions:[]);

        $content.=Html::endTag('blockquote');
        return $content;

    }

} 