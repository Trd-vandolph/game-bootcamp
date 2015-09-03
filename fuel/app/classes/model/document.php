<?php

class Model_Document extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'path',
		'deleted_at' =>  array('default' => 0),
		'created_at',
		'updated_at',
		'type',
		'category'
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

	protected static $_table_name = 'documents';

}
