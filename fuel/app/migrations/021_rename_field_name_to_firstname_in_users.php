<?php

namespace Fuel\Migrations;

class Rename_field_name_to_firstname_in_users
{
	public function up()
	{
		\DBUtil::modify_fields('users', array(
			'name' => array('name' => 'firstname', 'type' => 'varchar', 'constraint' => 255)
		));
	}

	public function down()
	{
	\DBUtil::modify_fields('users', array(
			'firstname' => array('name' => 'name', 'type' => 'varchar', 'constraint' => 255)
		));
	}
}