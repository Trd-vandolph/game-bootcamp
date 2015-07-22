<?php

namespace Fuel\Migrations;

class Edit_change_html_from_users
{
	public function up()
	{
		\DBUtil::modify_fields('users', array(
			'charge_html' => array('type' => 'int', 'constraint' => 11)
		));
	}

	public function down()
	{
	\DBUtil::modify_fields('users', array(
			'charge_html' => array('type' => 'tinyint', 'constraint' => 1)
		));
	}
}