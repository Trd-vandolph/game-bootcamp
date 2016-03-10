<?php

class Model_Lessontime extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'student_id',
		'teacher_id',
		'edoo_tutor',
		'freetime_at',
		'status',
		'number' => array('default' => 0),
		'language' => array('default' => 0),
		'url' => array('default' => ""),
		'feedback' => array('default' => ""),
		'deleted_at' => array('default' => 0),
		'created_at',
		'updated_at',
		'history',
		'for_group',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_belongs_to = array(
		'teacher' => array(
			'model_to' => 'Model_User',
			'key_from' => 'teacher_id',
			'key_to'   => 'id',
			'cascade_delete' => false,
		),

		'student' => array(
			'model_to' => 'Model_User',
			'key_from' => 'student_id',
			'key_to'   => 'id',
			'cascade_delete' => false,
		),
	);

	protected static $_table_name = 'lessontimes';

	public static function sendReservedEMail($id){

		$reservation = Model_Lessontime::find($id);

		// for teacher
		$url = Uri::base()."teachers/top";

		date_default_timezone_set(Config::get("timezone.timezone")[$reservation->teacher->timezone]);

		$body = View::forge("email/teachers/reserved",["url" => $url]);
		$body->set("name", $reservation->teacher->firstname);
		$body->set("reservation", $reservation);
		$sendmail = Email::forge("JIS");
		$sendmail->from(Config::get("statics.info_email"),Config::get("statics.info_name"));
		$sendmail->to($reservation->teacher->email);
		$sendmail->subject("Lesson Booking Confirmation / Game-bootcamp");
		$sendmail->html_body(htmlspecialchars_decode($body));

		$sendmail->send();

		// for student
		$url = Uri::base()."students/top";

		date_default_timezone_set(Config::get("timezone.timezone")[$reservation->student->timezone]);

		$body = View::forge("email/students/reserved",["url" => $url]);
		$body->set("name", $reservation->student->firstname);
		$body->set("reservation", $reservation);
		$sendmail = Email::forge("JIS");
		$sendmail->from(Config::get("statics.info_email"),Config::get("statics.info_name"));
		$sendmail->to($reservation->student->email);
		$sendmail->subject("Lesson Booking Confirmation / Game-bootcamp");
		$sendmail->html_body(htmlspecialchars_decode($body));

		$sendmail->send();
	}

	public static function getCourse($num){
		if($num == -1){
			return "Trial";
		}
		return  Config::get("statics.content_types")[$num];
	}

	public static function courseNumber_1($id){
		switch($id){
			case -1:
				return 1;
			default:
				return Config::get("statics.enchantJS")[0];
		}
	}

	public static function courseNumber_2($id){
		switch($id){
			case -1:
				return 1;
			default:
				return Config::get("statics.enchantJS")[1];
		}
	}

	public static function courseNumber_3($id){
		switch($id){
			case -1:
				return 1;
			default:
				return Config::get("statics.enchantJS")[2];
		}
	}
}
