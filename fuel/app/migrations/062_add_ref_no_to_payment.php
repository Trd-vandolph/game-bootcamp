<?php

namespace Fuel\Migrations;

class Add_ref_no_to_payment
{
	public function up()
	{
		\DBUtil::add_fields('payment', array(
			'ref_no' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			
		));
	}

	public function down()
	{
		\DBUtil::drop_fields('payment', array(
			'ref_no'

		));
	}
}
