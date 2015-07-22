<?php

namespace Fuel\Migrations;

class Add_img_path_to_users
{
	public function up()
	{
		\DBUtil::add_fields('users', array(
			'img_path' => array('constraint' => 255, 'type' => 'varchar'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('users', array(
			'img_path'

		));
	}
}