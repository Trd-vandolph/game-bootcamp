<?php

namespace Fuel\Migrations;

class Add_number_to_contents
{
	public function up()
	{
		\DBUtil::add_fields('contents', array(
			'number' => array('constraint' => 11, 'type' => 'int'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('contents', array(
			'number'

		));
	}
}