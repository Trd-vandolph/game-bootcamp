<?php

namespace Fuel\Migrations;

class Add_number_to_lessontimes
{
	public function up()
	{
		\DBUtil::add_fields('lessontimes', array(
			'number' => array('constraint' => 11, 'type' => 'int'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('lessontimes', array(
			'number'

		));
	}
}