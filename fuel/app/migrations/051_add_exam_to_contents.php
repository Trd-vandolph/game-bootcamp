<?php

namespace Fuel\Migrations;

class Add_exam_to_contents
{
	public function up()
	{
		\DBUtil::add_fields('contents', array(
			'exam' => array('constraint' => 11, 'type' => 'varchar', 'null' => true),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('contents', array(
			'exam'

		));
	}
}
