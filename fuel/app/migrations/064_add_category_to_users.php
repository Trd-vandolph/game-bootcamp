<?php

namespace Fuel\Migrations;

class Add_category_to_users
{
	public function up()
	{
		\DBUtil::add_fields('users', array(
			'category' => array('constraint' => 1, 'type' => 'tinyint', 'null' => false, 'default' => '0'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('users', array(
			'category'

		));
	}
}
