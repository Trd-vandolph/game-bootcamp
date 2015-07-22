<?php

namespace Fuel\Migrations;

class Add_type_to_users
{
	public function up()
	{
		\DBUtil::add_fields('users', array(
			'type' => array('constraint' => 11, 'type' => 'int'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('users', array(
			'type'

		));
	}
}