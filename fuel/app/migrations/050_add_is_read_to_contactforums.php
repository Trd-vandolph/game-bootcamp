<?php

namespace Fuel\Migrations;

class Add_is_read_to_contactforums
{
	public function up()
	{
		\DBUtil::add_fields('contactforums', array(
			'is_read' => array('constraint' => 1, 'type' => 'tinyint'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('contactforums', array(
			'is_read'

		));
	}
}