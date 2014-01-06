<?php
/**
 * Class NestedSetWithManyRoots
 * @package pb_menu/extensions/nestedset/test
 */
class NestedSetWithManyRoots extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function behaviors()
	{
		return array(
			'tree'=>array(
				'class'=>'ext.NestedSetBehavior',
				'hasManyRoots'=>true,
			),
		);
	}

	public function rules()
	{
		return array(
			array('name','required'),
		);
	}
}