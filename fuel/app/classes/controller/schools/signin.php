<?php

class Controller_Schools_Signin extends Controller_Base
{

	public function action_index()
	{
		$this->template = View::forge("schools/template");

		// login
		if(Input::post("email", null) !== null and Security::check_token()){
			$email = Input::post('email', null);
			$password = Input::post('password', null);

			$where = [["email", $email],["deleted_at", 0],["school_name", "!=", NULL]];

			$school = Model_User::find("all", [
					"where"=> $where,
			]);

			if(count($school)>=1) {
				if($this->auth->login( $email, $password)){
					if(Input::post('remember_me', null) == 1){
						$this->auth->remember_me();
					}
                    Response::redirect('/schools/top');
				}else{
					Response::redirect('/schools/signin?e=1invaliduser');
				}
			}else {
				Response::redirect('/schools/signin?e=1nofoundglory');
			}
		}

		$view = View::forge("schools/signin");
		$this->template->content = $view;
		$this->template->title = "Signin";
		$this->template->auth_status = false;
	}
}
