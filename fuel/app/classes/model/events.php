<?php

class Model_Events extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'title',
		'allday' => array('default' => 0),
		'body',
		'start_time' => array('default' => 0),
		'end_time' => array('default' => 0),
		'created_at',
		'deleted_at' => array('default' => 0),
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

	protected static $_table_name = 'events';

}
