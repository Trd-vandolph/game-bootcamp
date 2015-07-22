<?php

namespace Fuel\Migrations;

class Add_trial_to_users
{
	public function up()
	{
		\DBUtil::add_fields('users', array(
			'trial' => array('constraint' => 1, 'type' => 'tinyint'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('users', array(
			'trial'

		));
	}
}