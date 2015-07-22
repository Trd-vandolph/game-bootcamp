<?php

class Model_Payment extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'student_id',
		'pay_method',
		'paid_at' => array('default' => 0),
		'receipt',
		'status',
		'method',
		'paid',
		'reason',
		'ref_no',
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

	protected static $_table_name = 'payment';

}
