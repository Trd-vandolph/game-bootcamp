<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.6
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace Fuel\Tasks;


use Oil\Exception;

class Reservation
{
	/* php oil r reservation:soon */
	public static function soon()
	{
		$reservations = \Model_Lessontime::find("all", [
			"where" => [
				["deleted_at", 0],
				["status", 1],
				["freetime_at", "<=", time() + 600],
				["freetime_at", ">=", time()],
			]
		]);

		foreach($reservations as $reservation){

			// for teacher
			$url = "http://olivecode.com/teachers/top";

			$body = \View::forge("email/teachers/reminder_soon",["url" => $url]);
			$sendmail = \Email::forge("JIS");
			$sendmail->from(\Config::get("statics.info_email"),\Config::get("statics.info_name"));
			$sendmail->to($reservation->teacher->email);
			$sendmail->subject("Your lesson will start.");
			$sendmail->html_body(htmlspecialchars_decode($body));

			$sendmail->send();

			// for student
			$url = "http://olivecode.com/students/top";

			$body = \View::forge("email/students/reminder_soon",["url" => $url]);
			$sendmail = \Email::forge("JIS");
			$sendmail->from(\Config::get("statics.info_email"),\Config::get("statics.info_name"));
			$sendmail->to($reservation->student->email);
			$sendmail->subject("Your lesson will start.");
			$sendmail->html_body(htmlspecialchars_decode($body));

			$sendmail->send();
		}
	}

	/* php oil r reservation:hour */
	public static function hour()
	{
		$reservations = \Model_Lessontime::find("all", [
			"where" => [
				["deleted_at", 0],
				["status", 1],
				["freetime_at", "<=", time() + 3600],
				["freetime_at", ">=", time()],
			]
		]);

		foreach($reservations as $reservation){

			// for teacher
			$url = "http://olivecode.com/teachers/top";

			$body = \View::forge("email/teachers/reminder_1hour",["url" => $url]);
			$sendmail = \Email::forge("JIS");
			$sendmail->from(\Config::get("statics.info_email"),\Config::get("statics.info_name"));
			$sendmail->to($reservation->teacher->email);
			$sendmail->subject("Your lesson will start.");
			$sendmail->html_body(htmlspecialchars_decode($body));

			$sendmail->send();

			// for student
			$url = "http://olivecode.com/students/top";

			$body = \View::forge("email/students/reminder_1hour",["url" => $url]);
			$sendmail = \Email::forge("JIS");
			$sendmail->from(\Config::get("statics.info_email"),\Config::get("statics.info_name"));
			$sendmail->to($reservation->student->email);
			$sendmail->subject("Your lesson will start.");
			$sendmail->html_body(htmlspecialchars_decode($body));

			$sendmail->send();
		}
	}
}

