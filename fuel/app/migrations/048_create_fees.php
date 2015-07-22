<?php

namespace Fuel\Migrations;

class Create_fees
{
	public function up()
	{
		\DBUtil::create_table('fees', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'year' => array('constraint' => 11, 'type' => 'int'),
			'month' => array('constraint' => 11, 'type' => 'int'),
			'grade' => array('constraint' => 11, 'type' => 'int'),
			'fulltime' => array('constraint' => 11, 'type' => 'int'),
			'is_paid' => array('constraint' => 1, 'type' => 'tinyint', 'default' => '0'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('fees');
	}
}