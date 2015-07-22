<?php

namespace Fuel\Migrations;

class Add_birthday_to_users
{
	public function up()
	{
		\DBUtil::add_fields('users', array(
			'birthday' => array('type' => 'date'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('users', array(
			'birthday'

		));
	}
}