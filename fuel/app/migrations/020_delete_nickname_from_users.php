<?php

namespace Fuel\Migrations;

class Delete_nickname_from_users
{
	public function up()
	{
		\DBUtil::drop_fields('users', array(
			'nickname'

		));
	}

	public function down()
	{
		\DBUtil::add_fields('users', array(
			'nickname' => array('constraint' => 255, 'type' => 'varchar'),

		));
	}
}