<?php

namespace nestedmenu;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use nestedmenu\models\Menu;

/**
 * MenuQuery represents the model behind the search form about Menu.
 */
class MenuQuery extends Model
{
	public $id;
	public $title;
	public $root;
	public $lft;
	public $rgt;
	public $level;

	public function rules()
	{
		return [
			[['id', 'root', 'lft', 'rgt', 'level'], 'integer'],
			[['title'], 'safe'],
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

	public function search($params)
	{
		$query = Menu::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id');
		$this->addCondition($query, 'title', true);
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
