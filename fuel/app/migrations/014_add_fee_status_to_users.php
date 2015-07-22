<?php

namespace Fuel\Migrations;

class Add_fee_status_to_users
{
	public function up()
	{
		\DBUtil::add_fields('users', array(
			'fee_status' => array('constraint' => 11, 'type' => 'int'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('users', array(
			'fee_status'

		));
	}
}