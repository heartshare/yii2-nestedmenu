<?php

namespace nestedmenu\models;

/**
 * This is the model class for table "tbl_nested_menu_tree".
 *
 * @property integer $id
 * @property string $title
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 *
 * @property NestedMenuTreeConfig[] $nestedMenuTreeConfigs
 * @property NestedMenuTreeProfile[] $nestedMenuTreeProfiles
 */
class NestedMenuTree extends \yii\db\ActiveRecord
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
			[['title', 'root', 'lft', 'rgt', 'level'], 'required'],
			[['root', 'lft', 'rgt', 'level'], 'integer'],
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
			'title' => 'Title',
			'root' => 'Root',
			'lft' => 'Lft',
			'rgt' => 'Rgt',
			'level' => 'Level',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getNestedMenuTreeConfigs()
	{
		return $this->hasMany(NestedMenuTreeConfig::className(), ['tree_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getNestedMenuTreeProfiles()
	{
		return $this->hasMany(NestedMenuTreeProfile::className(), ['tree_id' => 'id']);
	}
}
