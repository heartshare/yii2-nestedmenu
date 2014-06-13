<?php

namespace nestedmenu\models;
use Yii;
use creocoder\behaviors\NestedSet;
use creocoder\behaviors\NestedSetQuery;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "tbl_nested_menu_tree".
 *
 * @property integer $id
 * @property string $title
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_nested_menu_tree';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['title', 'root', 'lft', 'rgt', 'level'], 'required'],
//            [['root', 'lft', 'rgt', 'level'], 'integer'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'title',
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
                'class' => 'creocoder\behaviors\NestedSet',
                'hasManyRoots'=>true
            ),
        );
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
     * @return \yii\db\ActiveRelation
     */
    public function getNestedMenuTreeProfiles()
    {
        return $this->hasMany(NestedMenuConfig::className(), ['tree_id' => 'id']);
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

    /**
     * Checks whether a menu item is active.
     * This is done by checking if [[route]] and [[params]] match that specified in the `url` option of the menu item.
     * When the `url` option of a menu item is specified in terms of an array, its first element is treated
     * as the route for the item and the rest of the elements are the associated parameters.
     * Only when its route and parameters match [[route]] and [[params]], respectively, will a menu item
     * be considered active.
     * @param array $item the menu item to be checked
     * @return boolean whether the menu item is active
     */
    protected function isItemActive($item)
    {
        if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
            $route = $item['url'][0];
            if ($route[0] !== '/' && Yii::$app->controller) {
                $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
            }
            if (ltrim($route, '/') !== $this->route) {
                return false;
            }
            unset($item['url']['#']);
            if (count($item['url']) > 1) {
                foreach (array_splice($item['url'], 1) as $name => $value) {
                    if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
                        return false;
                    }
                }
            }
            return true;
        }
        return false;
    }


}
