<?php

/**
 * This is the model class for table "menu_list_config".
 *
 * @package pb_menu\models
 *
 * The followings are the available columns in table 'menu_list_config':
 * @property integer $id
 * @property integer $menu_list_id
 * @property string $menu_url
 * @property string $visible_criteria
 * @property integer $use_visible
 * @property integer $active
 * @property string $url_target
 * @property integer $icon_id
 *
 * The followings are the available model relations:
 * @property MenuIcons $icon
 * @property MenuList $menuList
 */

class MenuListConfig extends CActiveRecord
{
    public $name;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return MenuListConfig the static model class
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
        return 'menu_list_config';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('menu_list_id', 'required'),
            array('menu_list_id, use_visible, active, icon_id', 'numerical', 'integerOnly'=>true),
            array('menu_url', 'length', 'max'=>355),
            array('visible_criteria,name', 'length', 'max'=>255),
            array('url_target', 'length', 'max'=>25),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, menu_list_id, menu_url, name, visible_criteria, use_visible, active, url_target, icon_id', 'safe', 'on'=>'search'),
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
            'icon' => array(self::BELONGS_TO, 'MenuIcons', 'icon_id'),
            'menuList' => array(self::BELONGS_TO, 'MenuList', 'menu_list_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'menu_list_id' => 'Menüpunkt',
            'menu_url' => 'Url',
            'visible_criteria' => 'Verstecken rule',
            'use_visible' => 'Menüpunkt verstecken',
            'active' => 'Aktiv',
            'url_target' => 'Url Target',
            'name' => 'Anzeigename',
            'icon_id' => 'Icon',
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
        $criteria->compare('menu_list_id',$this->menu_list_id);
        $criteria->compare('menu_url',$this->menu_url,true);
        $criteria->compare('visible_criteria',$this->visible_criteria,true);
        $criteria->compare('use_visible',$this->use_visible);
        $criteria->compare('active',$this->active);
        $criteria->compare('url_target',$this->url_target,true);
        $criteria->compare('icon_id',$this->icon_id);
        $criteria->compare('menuList.name',$this->name,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Get only first 140 items becuas this is nature Glyphicons +
     * If you have FontAwesome get All
     * @return array
     */
    public function getIconAsArray()
    {
        $criteria = new CDbCriteria();
        $criteria->limit = 140;
        return CHtml::listData(MenuIcons::model()->findAll($criteria),'id','html');
    }
}