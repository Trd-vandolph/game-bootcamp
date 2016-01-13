<?php

class Controller_Students_Signin extends Controller_Base
{

	public function action_index()
	{
		$this->template = View::forge("students/template");

		// login
		if(Input::post("email", null) !== null and Security::check_token()){
			$email = Input::post('email', null);
			$password = Input::post('password', null);

			$where = [["email", $email],["deleted_at", 0]];

			$gameUser = Model_User::find("all", [
					"where"=> $where,
			]);

			if(count($gameUser)>=1) {
				if($this->auth->login( $email, $password)){
					if(Input::post('remember_me', null) == 1){
						$this->auth->remember_me();
					}
					$type = Input::post('type', 0);

					if(Input::post('pay', 0) != 1 && Input::post('doc', 0) != 1){
						Response::redirect('/students/top');
					}else{
						if(Input::post('pay') != 0 || Input::post('pay') != NULL) {
							if(Input::post('method', 0) == 1) {
								Response::redirect('/coursefee/cash/?g=1#upload');
							}elseif(Input::post('method', 0) == 2) {
								Response::redirect('/coursefee/remit/?g=2#done');
							}elseif(Input::post('method', 0) == 3){
								Response::redirect('/students/courses');
							}elseif(Input::post('method', 0) == 4) {
								Response::redirect('/coursefee/cash/?g=4#upload');
							}
						}

						if(Input::post('doc', 0) != 0 || Input::post('doc') != NULL) {
							$user = Model_User::query()->where('email', $email)->where('deleted_at', 0)->limit(1)->get_one();
							$query = Model_User::find($user->id);

							$place = $query->place;

							if($place == 1) {
								Response::redirect('/join/?open=2');

							}else {
								Response::redirect('/join/?open=1');

							}
						}

					}
				}else{
					Response::redirect('/students/signin?e=1');
				}
			}else {
				Response::redirect('/students/signin?e=1');
			}
		}

		$view = View::forge("students/signin");
		$this->template->content = $view;
		$this->template->title = "Signin";
		$this->template->auth_status = false;
	}
}
