<?php

namespace Fuel\Migrations;

class Add_html5_to_users
{
	public function up()
	{
		\DBUtil::add_fields('users', array(
			'html5' => array('constraint' => 1, 'type' => 'tinyint', 'default' => '0'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('users', array(
			'html5'

		));
	}
}