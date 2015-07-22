<?php

class Model_Content extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'type_id',
		'path',
		'deleted_at' => array('default' => 0),
		'number' => array('default' => 0),
		'text_type_id' => array('default' => 0),
		'sort' => array('default' => 0),
		'created_at',
		'updated_at',
		'exam'
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

	protected static $_table_name = 'contents';

}
