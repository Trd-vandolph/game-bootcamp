<?php

class Model_Forum extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'user_id',
		'title',
		'body',
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
		'user' => array(
			'model_to' => 'Model_User',
			'key_from' => 'user_id',
			'key_to'   => 'id',
			'cascade_delete' => false,
		),
	);

	protected static $_has_many = array(
		'comments' => array(
			'key_from' => 'id',
			'key_through_to' => 'forum_id',
			'model_to' => 'Model_Comment',
			'cascade_save' => true,
			'cascade_delete' => false,
			'conditions' => array(
				'where' => array(
					array("deleted_at", 0)
				),
				'order_by' => array(
					'created_at' => 'DESC',
				)
			),
		),
	);
	protected static $_table_name = 'forums';

}
