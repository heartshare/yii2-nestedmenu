<?php

namespace nestedmenu\models;

use creocoder\yii\behaviors\NestedSet;

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
                'class' => 'creocoder\yii\behaviors\NestedSet',
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
        return $this->hasMany(MenuProfile::className(), ['tree_id' => 'id']);
    }

    /**
     *
     * @param $url
     * @return bool
     */
    protected static function getOptionActiveLink($url)
    {
        if (Yii::app()->request->requestUri == $url) {
            return true;
        }
        return false;
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
        $root = Menu::model()->findByPk($id);

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

        $_child = $root->children()->findAll();
        $data = array();
        foreach ($_child as $tree) {
            if (isset($tree->config)) {

            }
            $optionActive = false;
            $optionVisible = true;
            $optionIcon = '';
            $optionUrl = '';
            if (isset($tree->config)) {
                if ($tree->children()->findAll() != null) {
//                    CVarDumper::dump(self::getTreeByPk($tree->id));
                }

                if ($tree->config->menu_url) {
                    $optionActive = self::getOptionActiveLink(Yii::app()->baseUrl . $tree->config->menu_url);
                    $optionUrl = Yii::app()->baseUrl . $tree->config->menu_url;
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

            $data[] = array(
                'label' => $tree->name,
                'encodeLabel' => true,
                'url' => $optionUrl,
                'active' => $optionActive,
                'items' => self::checkChildrenForMenu($tree->id),
//                'itemOptions' => array(
//                    'itemTemplate' => '<i class="'.$optionIcon.'" ></i>{menu}'
//                ),
                'icon' => $optionIcon,
                'visible' => $optionVisible,
            );
        }
        return $data;
    }
}
