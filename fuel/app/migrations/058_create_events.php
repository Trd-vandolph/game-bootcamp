<?php

namespace Fuel\Migrations;

class Create_Events
{
	public function up()
	{
		\DBUtil::create_table('events', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'title' => array('constraint' => 255, 'type' => 'varchar'),
			'allday' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'body' => array('constraint' => 255, 'type' => 'varchar'),
			'start_time' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'end_time' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('events');
	}
}