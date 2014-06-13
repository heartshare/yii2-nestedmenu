<?php

namespace nestedmenu\models;

/**
 * This is the model class for table "tbl_nested_menu_tree_config".
 *
 * @property integer $id
 * @property integer $tree_id
 * @property string $url_shema
 * @property string $url_relative
 * @property string $url_absolute
 * @property integer $use_visible
 * @property integer $active
 * @property string $url_target
 * @property integer $icon_id
 *
 * @property NestedMenuTree $tree
 */
class NestedMenuConfig extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'tbl_nested_menu_tree_config';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['tree_id'], 'required'],
			[['tree_id', 'use_visible', 'active', 'icon_id'], 'integer'],
			[['url_shema'], 'string', 'max' => 355],
			[['url_relative', 'url_absolute'], 'string', 'max' => 255],
			[['url_target'], 'string', 'max' => 25]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'tree_id' => 'Menu Liste',
			'url_shema' => 'Url Shema Yii',
			'url_relative' => 'createUrl',
			'url_absolute' => 'createAbsoluteUrl',
			'use_visible' => 'Versteckt nein / ja',
			'active' => 'Aktiv nein/ja',
			'url_target' => 'Im Fenster öffnen',
			'icon_id' => 'Icons',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getTree()
	{
		return $this->hasOne(NestedMenuTree::className(), ['id' => 'tree_id']);
	}
}
