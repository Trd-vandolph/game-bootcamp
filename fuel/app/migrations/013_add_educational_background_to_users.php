<?php

namespace Fuel\Migrations;

class Add_educational_background_to_users
{
	public function up()
	{
		\DBUtil::add_fields('users', array(
			'educational_background' => array('constraint' => 255, 'type' => 'varchar'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('users', array(
			'educational_background'

		));
	}
}