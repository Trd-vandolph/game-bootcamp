<?php

namespace Fuel\Migrations;

class Add_status_to_mail
{
	public function up()
	{
		\DBUtil::add_fields('mail', array(
			'status' => array('constraint' => 1, 'type' => 'tinyint'),
			
		));
	}

	public function down()
	{
		\DBUtil::drop_fields('mail', array(
			'status'

		));
	}
}
