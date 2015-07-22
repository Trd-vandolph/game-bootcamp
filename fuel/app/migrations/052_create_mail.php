<?php

namespace Fuel\Migrations;

class Create_mail
{
	public function up()
	{
		\DBUtil::create_table('mail', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'for_all' => array('constraint' => 1, 'type' => 'tinyint'),
			'for_students' => array('constraint' => 1, 'type' => 'tinyint'),
			'for_teachers' => array('constraint' => 1, 'type' => 'tinyint'),
			'title' => array('constraint' => 255, 'type' => 'varchar'),
			'body' => array('type' => 'text'),
			'deleted_at' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('mail');
	}
}