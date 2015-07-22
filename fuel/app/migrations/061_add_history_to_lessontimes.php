<?php

namespace Fuel\Migrations;

class Add_history_to_lessontimes
{
	public function up()
	{
		\DBUtil::add_fields('lessontimes', array(
			'history' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			
		));
	}

	public function down()
	{
		\DBUtil::drop_fields('lessontimes', array(
			'history'

		));
	}
}
