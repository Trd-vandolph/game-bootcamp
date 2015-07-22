<?php

class Controller_Teachers_Setting extends Controller_Teachers
{

	public function before(){

		parent::before();

	}

	public function action_new(){

		$data = [];

		if(Input::post("firstname", null) != null and Security::check_token()){

			$email = Input::post("email", null);

			if($email != $this->user->email){
				$check_user = Model_User::find("first", [
					"where" => [
						["email" => $email]
					]
				]);

				if($check_user == null){
					$this->email = $email;
				}else{
					$data["error"] = "This email is already in use.";
				}
			}
			if(!isset($data["error"])){
				$this->user->firstname = Input::post("firstname", "");
				$this->user->middlename = Input::post("middlename", "");
				$this->user->lastname = Input::post("lastname", "");
				$this->user->google_account = Input::post("google_account", "");
				$this->user->password = Auth::instance()->hash_password(Input::post('password', ""));
				$this->user->birthday = Input::post("year")."-".Input::post("month")."-".Input::post("day");
				$this->user->google_account = Input::post("google_account");
				$this->user->need_reservation_email = Input::post("need_reservation_email");
				$this->user->need_news_email = Input::post("need_news_email");
				$this->user->timezone = Input::post("timezone");
				$this->user->need_news_email = Input::post("need_news_email");
				$this->user->timezone = Input::post("timezone");
				$this->user->pr = Input::post("pr", "");
				$this->user->educational_background = Input::post("educational_background", "");

				$this->user->php = Input::post("php", 0);
				$this->user->html5 = Input::post("html5", 0);
				$this->user->javascript = Input::post("javascript", 0);
				$this->user->trial = Input::post("trial", 0);
				$this->user->save();

				Response::redirect("teachers");
			}
		}

		$view = View::forge("teachers/setting_new", $data);
		$this->template->content = $view;
	}

	public function action_index()
	{
		$is_chenged = false;
		$data["password_error"] = "";

		if(Input::post("timezone", null) !== null and Security::check_token()){

			$this->user->timezone = Input::post("timezone", "");
			$this->user->save();

			$is_chenged = true;
		}

		if(Input::post("need_reservation_email", null) !== null and Security::check_token()){

			$this->user->need_reservation_email = Input::post("need_reservation_email", 1);
			$this->user->need_news_email = Input::post("need_news_email", 1);

			$this->user->save();

			$is_chenged = true;
		}

		if(Input::post("password", null) != null and Security::check_token()){

			$val = Validation::forge();
			$val->add_callable('passwordvalidation');
			$val->add_field("password", Lang::get('forgotpassword.password'), "required|match_field[password2]|password");
			$val->add_field("password2", Lang::get('forgotpassword.password'), "required|match_field[password]|password");

			if($val->run()){
				$this->user->password = Auth::instance()->hash_password(Input::post('password', ""));

				$this->user->save();
				$is_chenged = true;

			}else{
				$data["password_error"] = "password does not matched.";
			}
		}

		$data["user"] = $this->user;
		$data["is_chenged"] = $is_chenged;

		$view = View::forge("teachers/setting",$data);
		$this->template->content = $view;
	}
}