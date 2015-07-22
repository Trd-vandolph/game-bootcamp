<?php

namespace Fuel\Migrations;

class Create_lessontimes
{
	public function up()
	{
		\DBUtil::create_table('lessontimes', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'teacher_id' => array('constraint' => 11, 'type' => 'int'),
			'freetime_at' => array('constraint' => 11, 'type' => 'int'),
			'status' => array('constraint' => 11, 'type' => 'int'),
			'deleted_at' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('lessontimes');
	}
}