<?php

namespace Fuel\Migrations;

class Add_nationality_to_users
{
	public function up()
	{
		\DBUtil::add_fields('users', array(
			'nationality' => array('constraint' => 50, 'type' => 'varchar', 'null' => false, 'default' => '0'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('users', array(
			'nationality'
		));
	}
}
