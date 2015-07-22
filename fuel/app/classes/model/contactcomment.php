<?php

class Model_Contactcomment extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'user_id',
		'contactforum_id',
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

	protected static $_table_name = 'contactcomments';

}
