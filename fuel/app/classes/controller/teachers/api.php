<?php

class Controller_Teachers_Api extends Controller_Rest
{
	private $user = null;
	private $auth_status = false;

	public function before(){

		parent::before();

		if(Auth::check()){

			$user_id = Auth::get_user_id()[1];
			$this->user = Model_User::find($user_id);

			if($this->user->group_id == 10){
				$this->auth_status = true;
			}

			if($this->user->timezone != ""){
				$timezone = Config::get("timezone.timezone");
				if(isset($timezone[$this->user->timezone])){
					date_default_timezone_set($timezone[$this->user->timezone]);
				}
			}

		}

	}

	public function post_delreservation(){

		$code = 0;
		$message = "ok";

		if($this->auth_status){

			$reservation = Model_Lessontime::find(Input::post("id", 0));

			if($reservation != null)
				if($this->user->id == $reservation->teacher_id){
					$reservation->deleted_at = time();
					$reservation->save();
				}else{
					$code = 500;
					$message = "Auth error.";
				}else{
				$code = 404;
				$message = "Reservation not found.";
			}
		}else{
			$code = 500;
			$message = "Auth error.";
		}
		$this->response(array(
			'code' => $code,
			'message' => $message,
		));
	}

	public function post_reservation(){

		$code = 0;
		$message = "ok";

		if($this->auth_status){

			$unixtime = strtotime(Input::post("date", "0000-00-00") . " " . Input::post("hour", 0) . ":00:00");

			$reservation = Model_Lessontime::find("first", [
				"where" => [
					["teacher_id", $this->user->id],
					["freetime_at", $unixtime],
					["deleted_at", 0],
					["category", 1],
				]
			]);
			if($reservation != null){
				if($reservation->status == 0){
					$reservation->deleted_at = time();
					$reservation->save();
					$code = 201;
					$message = "deleted";
				}else{
					$code = 202;
					$message = "reserved";
				}
			}else{
				$reservation = Model_Lessontime::forge();
				$reservation->teacher_id = $this->user->id;
				$reservation->student_id = 0;
				$reservation->status = 0;
				$reservation->freetime_at = $unixtime;
				$reservation->category = 1;
				$reservation->save();
				$code = 200;
			}
		}else{
			$code = 500;
			$message = "Auth error.";
		}
		$this->response(array(
			'code' => $code,
			'message' => $message,
		));
	}

	public function post_getreservation(){

		$code = 0;
		$message = "ok";
		$reservation = null;

		if($this->auth_status){

			$reservation = Model_Lessontime::find("first", [
				"where" => [
					["deleted_at", 0],
					//["url", "<>", ""],
					["teacher_id", $this->user->id],
					["status", 1],
					["freetime_at", "<=", time() + 600],
					["freetime_at", ">=", time() - 3000],
					["category", 1],
				]
			]);

			if($reservation != null){
			}else{
				$code = 404;
				$message = "Reservation not found.";
			}
		}else{
			$code = 500;
			$message = "Auth error.";
		}
		$this->response(array(
			'code' => $code,
			'message' => $message,
			'reservation' => $reservation
		));
	}
}