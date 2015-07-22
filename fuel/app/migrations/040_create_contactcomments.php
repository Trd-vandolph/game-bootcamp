<?php

namespace Fuel\Migrations;

class Create_contactcomments
{
	public function up()
	{
		\DBUtil::create_table('contactcomments', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'contactforum_id' => array('constraint' => 11, 'type' => 'int'),
			'body' => array('type' => 'text'),
			'deleted_at' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('contactcomments');
	}
}