<?php

namespace nestedmenu\models;

/**
 * This is the model class for table "tbl_nested_menu_tree_profile".
 *
 * @property integer $id
 * @property integer $tree_id
 * @property string $title
 * @property string $slug
 * @property string $description
 *
 * @property NestedMenuTree $tree
 */
class MenuProfile extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'tbl_nested_menu_tree_profile';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['tree_id'], 'required'],
			[['tree_id'], 'integer'],
			[['description'], 'string'],
			[['title'], 'string', 'max' => 355],
			[['slug'], 'string', 'max' => 125]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'tree_id' => 'Nested Menu Tree',
			'title' => 'Titel',
			'slug' => 'Intern Slug',
			'description' => 'Beschreibung',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getTree()
	{
		return $this->hasOne(Menu::className(), ['id' => 'tree_id']);
	}
}
