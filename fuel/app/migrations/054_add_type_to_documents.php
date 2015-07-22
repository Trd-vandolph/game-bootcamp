<?php

namespace Fuel\Migrations;

class Add_type_to_documents
{
	public function up()
	{
		\DBUtil::add_fields('documents', array(
			'type' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('documents', array(
			'type'

		));
	}
}
