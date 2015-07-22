<?php

namespace Fuel\Migrations;

class Add_url_to_lessontimes
{
	public function up()
	{
		\DBUtil::add_fields('lessontimes', array(
			'url' => array('constraint' => 255, 'type' => 'varchar'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('lessontimes', array(
			'url'

		));
	}
}