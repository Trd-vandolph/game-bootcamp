<?php

namespace Fuel\Migrations;

class Add_pr_to_users
{
	public function up()
	{
		\DBUtil::add_fields('users', array(
			'pr' => array('type' => 'text'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('users', array(
			'pr'

		));
	}
}