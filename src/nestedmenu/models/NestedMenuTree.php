<?php

namespace nestedmenu\models;
use nestedmenu\behaviors\NestedSet;

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
     * @return array
     */
    public function behaviors() {
        return array(
            'tree' => array(
                'class' => 'common\modules\nestedmenu\behaviors\NestedSet',
                'hasManyRoots'=>true
            ),
        );
    }
//    /**
//     * add the nested set package
//     * @return array
//     */
//    public function behaviors()
//    {
//        return array(
//            'tree' => array(
//                'class' => 'creocoder\yii\behaviors\NestedSet',
//
//            ),
//        );
//    }
    /**
     * @param bool $insert
     * @return bool|void
     */
//    public function afterSave($insert)
//    {
//        parent::afterSave($insert);
//        if($this->isNewRecord){
//            if((int)$this->root !== 1){
//                $profile = new NestedMenuProfile();
//                $profile->tree_id = $this->id;
//                $profile->title = $this->title;
//                $profile->save(false);
//            }
//
//            $config = new NestedMenuConfig();
//            $config->tree_id = $this->id;
//
//            if($config->save(false))
//                return $insert;
//        }
//    }

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getConfig()
	{
		return $this->hasOne(NestedMenuConfig::className(), ['tree_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getProfile()
	{
		return $this->hasOne(NestedMenuProfile::className(), ['tree_id' => 'id']);
	}
}
