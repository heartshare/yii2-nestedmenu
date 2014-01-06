<?php

/**
 * This is the model class for table "menu_list_tree".
 *
 * @package pb_menu\models
 * The followings are the available columns in table 'menu_list_tree':
 * @property integer $tree_id
 * @property integer $list_id
 *
 * The followings are the available model relations:
 * @property MenuList $list
 * @property MenuTree $tree
 */
class MenuListTree extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MenuListTree the static model class
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
		return 'menu_list_tree';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tree_id, list_id', 'required'),
			array('tree_id, list_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('tree_id, list_id', 'safe', 'on'=>'search'),
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
			'list' => array(self::BELONGS_TO, 'MenuList', 'list_id'),
			'tree' => array(self::BELONGS_TO, 'MenuTree', 'tree_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'tree_id' => 'Tree',
			'list_id' => 'List',
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

		$criteria->compare('tree_id',$this->tree_id);
		$criteria->compare('list_id',$this->list_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}