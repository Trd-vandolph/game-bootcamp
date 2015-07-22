<?php

namespace Fuel\Migrations;

class Add_sex_to_users
{
	public function up()
	{
		\DBUtil::add_fields('users', array(
			'sex' => array('constraint' => 1, 'type' => 'tinyint'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('users', array(
			'sex'

		));
	}
}