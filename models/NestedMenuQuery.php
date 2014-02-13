<?php

namespace nestedmenu\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use nestedmenu\models\NestedMenuTree;
use yii\helpers\VarDumper;

/**
 * NestedMenuQuery represents the model behind the search form about NestedMenu.
 */
class NestedMenuQuery extends Model
{
    public $id;
    public $root;
    public $lft;
    public $rgt;
    public $level;

    public function rules()
    {
        return [
            [['id', 'root', 'lft', 'rgt', 'level'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'root' => 'Root',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'level' => 'Level',
        ];
    }

    /**
     * add the nested set package
     * @return array
     */
    public function behaviors()
    {
        return array(
            'tree' => array(
                'class' => 'creocoder\behaviors\NestedSetQuery',
            ),
        );
    }

    public function search($params)
    {
        $query = NestedMenuTree::find()->where(['level' => 1]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'id');
        $this->addCondition($query, 'root');
        $this->addCondition($query, 'lft');
        $this->addCondition($query, 'rgt');
        $this->addCondition($query, 'level');


        return $dataProvider;
    }

    protected function addCondition($query, $attribute, $partialMatch = false)
    {
        $value = $this->$attribute;
        if (trim($value) === '') {
            return;
        }
        if ($partialMatch) {
            $value = '%' . strtr($value, ['%' => '\%', '_' => '\_', '\\' => '\\\\']) . '%';
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }

    /**
     * @param $parent_id
     * @return array|bool
     */
    protected static function checkChildrenForMenu($parent_id)
    {
        if ($parent_id == 0) {
            return false;
        }
        $data = self::setMenuTree($parent_id, null);
        return $data;
    }

    /**
     * return a menuList Item for a menu
     * @param $id
     * @param $color
     * @return array
     */
    protected static function setMenuTree($id, $color)
    {
        $root = NestedMenuTree::find($id);

        if (empty($root)) {
            return array(
                $data[] = array(
                    'label' => 'Menu Not Found ' . $id,
                    'url' => array('/menu/menuTree/admin'),
                    'icon' => 'error',
                    'visible' => true
                )
            );
        }
        $urlManager = \Yii::$app->urlManager;
//        exit;
        $_child = $root->children()->all();
        $data = array();
        foreach ($_child as $tree) {
            if (isset($tree->config)) {

            }
            $optionActive = false;
            $optionVisible = true;
            $optionIcon = '';
            $optionUrl = '';
            if (isset($tree->config)) {
                if ($tree->children()->all() != null) {
//                    CVarDumper::dump(self::getTreeByPk($tree->id));
                }

                if ($tree->config->url_shema) {
                    $optionActive = self::getOptionActiveLink(Yii::$app->baseUrl . $tree->config->url_shema);
                    $optionUrl =  $tree->config->url_shema;
                }

                if ($tree->config->use_visible == 1 && !empty($tree->config->visible_criteria)) {
                    $optionVisible = Yii::app()->user->checkAccess($tree->config->visible_criteria);
                }

                if ($tree->config->icon_id != null) {
                    $optionIcon = str_replace('icon-', '', $tree->config->icon->name);
                    if ($color != null) {
                        $optionIcon .= ' ' . $color;
                    }
                }
                if ($tree->config->active == 0) {
                    $optionVisible = false;
                }
            }
//            VarDumper::dump($tree->profile,10,true);
//            exit;
            $data[] = array(
                'label'             => isset($tree->profile->title)?$tree->profile->title:'NOt AVaialable',
                'encodeLabel'       => true,
                'url'               => $optionUrl,
                'active'            => $optionActive,
                'items'             => self::checkChildrenForMenu($tree->id),
////                'itemOptions' => array(
////                    'itemTemplate' => '<i class="'.$optionIcon.'" ></i>{menu}'
////                ),
//                'icon'              => $optionIcon,
                'visible'           => $optionVisible,
            );
        }
        return $data;
    }

    /**
     * return an array for Dropdowns with yiistrap
     * @param $id
     * @param null $color
     * @return array
     */
    public static function getTreeByPk($id, $color = null)
    {
        return self::setMenuTree($id, $color);
    }


    /**
     *
     * @param $url
     * @return bool
     */
    protected static function getOptionActiveLink($url)
    {
        if (Yii::$app->controller->getRoute() === $url) {
            return true;
        }
        return false;
    }
}
