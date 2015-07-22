<?php

class Model_Contact extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'user_id',
		'title',
		'body',
		'status' => array('default' => 0),
		'deleted_at' => array('default' => 0),
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_belongs_to = array(
		'teacher' => array(
			'model_to' => 'Model_User',
			'key_from' => 'user_id',
			'key_to'   => 'id',
			'cascade_delete' => false,
		),

		'student' => array(
			'model_to' => 'Model_User',
			'key_from' => 'user_id',
			'key_to'   => 'id',
			'cascade_delete' => false,
		),
	);

	public static function validate($fieldset = 'default')
	{
		$val = Validation::forge($fieldset);

		$val->add('title', 'Title')
			->add_rule('required');
		$val->add('body', 'Body')
			->add_rule('required');

		return $val;
	}

	protected static $_table_name = 'contacts';

}
