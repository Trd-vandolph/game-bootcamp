<?php

namespace Fuel\Migrations;

class Add_timezone_to_users
{
	public function up()
	{
		\DBUtil::add_fields('users', array(
			'timezone' => array('constraint' => 255, 'type' => 'varchar'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('users', array(
			'timezone'

		));
	}
}