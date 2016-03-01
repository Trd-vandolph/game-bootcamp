<?php

class Model_Classroom extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'classname',
        'students_id',
        'school_id',
        'created_at',
        'deleted_at'=>array("default" => 0),
        'updated_at',
        'language'=>array("default" => 0),
        'number'=>array("default" => 0),
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

	protected static $_table_name = 'classroom';

}
