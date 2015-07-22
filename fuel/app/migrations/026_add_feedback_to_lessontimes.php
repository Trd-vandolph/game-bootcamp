<?php

namespace Fuel\Migrations;

class Add_feedback_to_lessontimes
{
	public function up()
	{
		\DBUtil::add_fields('lessontimes', array(
			'feedback' => array('type' => 'text'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('lessontimes', array(
			'feedback'

		));
	}
}