<?php

namespace Fuel\Migrations;

class Add_forum_id_to_comments
{
	public function up()
	{
		\DBUtil::add_fields('comments', array(
			'forum_id' => array('constraint' => 11, 'type' => 'int'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('comments', array(
			'forum_id'

		));
	}
}