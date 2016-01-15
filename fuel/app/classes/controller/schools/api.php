<?php

class Controller_Schools_Api extends Controller_Rest
{
	private $user = null;
	private $auth_status = false;

	public function before(){

		parent::before();

		if(Auth::check()){

			$user_id = Auth::get_user_id()[1];
			$this->user = Model_User::find($user_id);

			if($this->user->group_id == 1){
				$this->auth_status = true;

				if($this->user->timezone != ""){
					$timezone = Config::get("timezone.timezone");
					if(isset($timezone[$this->user->timezone])){
						date_default_timezone_set($timezone[$this->user->timezone]);
					}
				}
			}
		}

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
					["student_id", $this->user->id],
					["status", 1],
					["freetime_at", "<=", time() + 900],
					["freetime_at", ">=", time() - 3000],
				]
			]);

			if($reservation != null){
				if($reservation->freetime_at <= time() + 120){
					$reservation->is_ready = true;
				}else{
					$reservation->is_ready = false;
				}

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
