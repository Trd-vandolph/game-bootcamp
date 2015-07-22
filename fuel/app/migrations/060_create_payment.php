<?php

namespace Fuel\Migrations;

class Create_payment
{
	public function up()
	{
		\DBUtil::create_table('payment', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'student_id' => array('constraint' => 11, 'type' => 'int'),
			'pay_method' => array('constraint' => 11, 'type' => 'int'),
			'paid_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'receipt' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'status' => array('constraint' => 11, 'type' => 'int', 'null' => false),
			'method' => array('constraint' => 1, 'type' => 'tinyint', 'null' => false),
			'paid' => array('constraint' => 11, 'type' => 'int', 'null' => false),
			'reason' => array('constraint' => 255, 'type' => 'varchar', 'null' => false),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('payment');
	}
}