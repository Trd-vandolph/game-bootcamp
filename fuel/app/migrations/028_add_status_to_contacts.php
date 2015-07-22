<?php

namespace Fuel\Migrations;

class Add_status_to_contacts
{
	public function up()
	{
		\DBUtil::add_fields('contacts', array(
			'status' => array('constraint' => 11, 'type' => 'int'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('contacts', array(
			'status'

		));
	}
}