<?php

namespace Fuel\Migrations;

class Add_student_id_to_lessontimes
{
	public function up()
	{
		\DBUtil::add_fields('lessontimes', array(
			'student_id' => array('constraint' => 11, 'type' => 'int'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('lessontimes', array(
			'student_id'

		));
	}
}