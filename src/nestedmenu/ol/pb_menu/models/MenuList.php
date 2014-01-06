<?php
/**
 * @author Pacal Brewing
 * @email pb@becklyn.com
 * @package pb_menu\models
 *
 * The followings are the available columns in table 'menu_list':
 *
 * @property integer $id
 * @property string $name
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 * @property integer $root
 * @property string $create
 * @property string $update
 *
 * The followings are the available model relations:
 *
 * @property MenuListConfig[] $menuListConfigs
 * @property MenuListTree[] $menuListTrees
 */

class MenuList extends CActiveRecord
{
    public $treeId;
    public $tree;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return MenuList the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'menu_list';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, create, update', 'required'),
            array('lft, rgt, level, root', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, lft, rgt, level, root, create, update', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'config' => array(self::HAS_ONE, 'MenuListConfig', 'menu_list_id'),
            'menutree' => array(self::MANY_MANY,'MenuTree','menu_list_tree(list_id,tree_id)')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'level' => 'Level',
            'root' => 'Root',
            'create' => 'Create',
            'update' => 'Update',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('lft',$this->lft);
        $criteria->compare('rgt',$this->rgt);
        $criteria->compare('level',$this->level);
        $criteria->compare('root',$this->root);
        $criteria->compare('create',$this->create,true);
        $criteria->compare('update',$this->update,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * create and update are required
     * @return bool
     */
    protected function beforeValidate()
    {
        if(parent::beforeValidate()){
            if($this->isNewRecord)
            {
                $this->create = $this->update = date('Y-m-d H:i:s');
            }else{
                $this->update = date('Y-m-d H:i:s');
            }
        }

        return parent::beforeValidate();
    }

    /**
     * set the relation to Menu Tree
     */
    protected function afterSave()
    {
        parent::afterSave();
        if($this->isNewRecord){
            $lookup = new MenuListTree();
            $lookup->list_id = $this->id;
            $lookup->tree_id = $this->treeId;
            $lookup->save(false);
        }
    }

    /**
     * get the Nested Set Behavior
     * @return array
     */
    public function behaviors()
    {
        return array(
            'tree'=>array(
                'class'=>'menu.extensions.nestedset.NestedSetBehavior',
                'hasManyRoots' => true
            ),
        );
    }

    /**
     * return an array for Dropdowns with yiistrap
     * @param $id
     * @param null $color
     * @return array
     */
    public static function getTreeByPk($id , $color = null){
        return self::setMenuTree($id,$color);
    }

    /**
     *
     * @param $url
     * @return bool
     */
    protected static  function getOptionActiveLink($url){
        if(Yii::app()->request->requestUri == $url){
            return true;
        }
        return false;
    }
    /**
     * @param $parent_id
     * @return array|bool
     */
    protected static function checkChildrenForMenu($parent_id){
        if($parent_id == 0){
            return false;
        }
        $data =self::setMenuTree($parent_id,null);
        return $data;
    }

    /**
     * return a menuList Item for a menu
     * @param $id
     * @param $color
     * @return array
     */
    protected static function setMenuTree($id,$color){
        $root = MenuList::model()->findByPk($id);

        if(empty($root)){
            return array(
                $data[] = array(
                    'label'=>'Menu Not Found '.$id,
                    'url' => array('/menu/menuTree/admin'),
                    'icon' => 'error',
                    'visible' => true
                )
            );
        }

        $_child = $root->children()->findAll();
        $data = array();
        foreach($_child as $tree){
            if(isset($tree->config)){

            }
            $optionActive = false;
            $optionVisible = true;
            $optionIcon = '';
            $optionUrl = '';
            if(isset($tree->config))
            {
                if($tree->children()->findAll() != null){
//                    CVarDumper::dump(self::getTreeByPk($tree->id));
                }

                if($tree->config->menu_url){
                    $optionActive = self::getOptionActiveLink(Yii::app()->baseUrl.$tree->config->menu_url);
                    $optionUrl = Yii::app()->baseUrl.$tree->config->menu_url;
                }

                if($tree->config->use_visible == 1 && !empty($tree->config->visible_criteria)){
                    $optionVisible = Yii::app()->user->checkAccess($tree->config->visible_criteria);
                }

                if($tree->config->icon_id != null){
                    $optionIcon = str_replace('icon-','',$tree->config->icon->name);
                    if($color != null){
                        $optionIcon .= ' '.$color;
                    }
                }
                if($tree->config->active == 0){
                    $optionVisible = false;
                }
            }

            $data[] = array(
                'label'=>$tree->name,
                'encodeLabel' => true,
                'url'=>$optionUrl,
                'active'=>$optionActive,
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