<?php

namespace Fuel\Migrations;

class Create_grades
{
	public function up()
	{
		\DBUtil::create_table('grades', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'year' => array('constraint' => 11, 'type' => 'int'),
			'month' => array('constraint' => 11, 'type' => 'int'),
			'grade_1' => array('constraint' => 11, 'type' => 'int'),
			'grade_2' => array('constraint' => 11, 'type' => 'int'),
			'grade_3' => array('constraint' => 11, 'type' => 'int'),
			'grade_4' => array('constraint' => 11, 'type' => 'int'),
			'grade_5' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('grades');
	}
}