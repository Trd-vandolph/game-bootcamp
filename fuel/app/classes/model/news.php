<?php

class Model_News extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'for_students' => array('default' => 0),
		'for_teachers' => array('default' => 0),
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

	protected static $_table_name = 'news';

}
