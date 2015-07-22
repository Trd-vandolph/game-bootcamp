<?php

namespace Fuel\Migrations;

class Add_text_type_id_to_contents
{
	public function up()
	{
		\DBUtil::add_fields('contents', array(
			'text_type_id' => array('constraint' => 11, 'type' => 'int'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('contents', array(
			'text_type_id'

		));
	}
}