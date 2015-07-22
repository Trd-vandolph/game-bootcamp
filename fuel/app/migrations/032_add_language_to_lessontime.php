<?php

namespace Fuel\Migrations;

class Add_language_to_lessontime
{
	public function up()
	{
		\DBUtil::add_fields('lessontimes', array(
			'language' => array('constraint' => 11, 'type' => 'int'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('lessontimes', array(
			'language'

		));
	}
}