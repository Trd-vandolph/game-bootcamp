<?php

namespace Fuel\Migrations;

class Create_banks
{
	public function up()
	{
		\DBUtil::create_table('banks', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'name' => array('constraint' => 255, 'type' => 'varchar'),
			'branch' => array('constraint' => 255, 'type' => 'varchar'),
			'type' => array('constraint' => 11, 'type' => 'int'),
			'account' => array('constraint' => 255, 'type' => 'varchar'),
			'number' => array('constraint' => 255, 'type' => 'varchar'),
			'etc' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('banks');
	}
}