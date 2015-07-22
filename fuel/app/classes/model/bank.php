<?php

class Model_Bank extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'user_id',
		'name' => array('default' => ""),
		'branch' => array('default' => ""),
		'type' => array('default' => 0),
		'account' => array('default' => ""),
		'number' => array('default' => ""),
		'etc' => array('default' => ""),
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

	protected static $_table_name = 'banks';

}
