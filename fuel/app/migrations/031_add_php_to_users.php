<?php

namespace Fuel\Migrations;

class Add_php_to_users
{
	public function up()
	{
		\DBUtil::add_fields('users', array(
			'php' => array('constraint' => 1, 'type' => 'tinyint', 'default' => '0'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('users', array(
			'php'

		));
	}
}