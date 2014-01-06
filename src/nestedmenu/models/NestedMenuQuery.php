<?php

namespace nestedmenu\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use nestedmenu\models\NestedMenuTree;

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
                'class' => 'creocoder\yii\behaviors\NestedSetQuery',
            ),
        );
    }

	public function search($params)
	{
		$query = NestedMenuTree::find();
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
			$value = '%' . strtr($value, ['%'=>'\%', '_'=>'\_', '\\'=>'\\\\']) . '%';
			$query->andWhere(['like', $attribute, $value]);
		} else {
			$query->andWhere([$attribute => $value]);
		}
	}
}
