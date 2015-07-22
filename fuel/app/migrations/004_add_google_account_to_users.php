<?php

namespace Fuel\Migrations;

class Add_google_account_to_users
{
	public function up()
	{
		\DBUtil::add_fields('users', array(
			'google_account' => array('constraint' => 255, 'type' => 'varchar'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('users', array(
			'google_account'

		));
	}
}