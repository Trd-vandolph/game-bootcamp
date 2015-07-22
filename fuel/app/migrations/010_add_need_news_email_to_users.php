<?php

namespace Fuel\Migrations;

class Add_need_news_email_to_users
{
	public function up()
	{
		\DBUtil::add_fields('users', array(
			'need_news_email' => array('constraint' => 1, 'type' => 'tinyint'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('users', array(
			'need_news_email'

		));
	}
}