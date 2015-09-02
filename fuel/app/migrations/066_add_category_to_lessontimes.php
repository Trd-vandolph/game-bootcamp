<?php

namespace Fuel\Migrations;

class Add_category_to_lessontimes
{
	public function up()
	{
		\DBUtil::add_fields('lessontimes', array(
			'category' => array('constraint' => 1, 'type' => 'tinyint', 'null' => false, 'default' => '0'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('lessontimes', array(
			'category'

		));
	}
}
