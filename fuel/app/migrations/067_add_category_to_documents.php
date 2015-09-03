<?php

namespace Fuel\Migrations;

class Add_category_to_documents
{
	public function up()
	{
		\DBUtil::add_fields('documents', array(
			'category' => array('constraint' => 1, 'type' => 'tinyint', 'null' => false, 'default' => '0'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('documents', array(
			'category'
		));
	}
}
