<?php

namespace Fuel\Migrations;

class Add_charge_html_to_users
{
	public function up()
	{
		\DBUtil::add_fields('users', array(
			'charge_html' => array('constraint' => 1, 'type' => 'tinyint'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('users', array(
			'charge_html'

		));
	}
}