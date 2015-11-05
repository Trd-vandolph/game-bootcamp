<?php

class Controller_Teachers_Signin extends Controller_Base
{

	public function action_index()
	{
		$this->template = View::forge("teachers/template");

		// login
		if(Input::post("email", null) !== null and Security::check_token()){
			$email = Input::post('email', null);
			$password = Input::post('password', null);
			if($this->auth->login( $email, $password)){
				if(Input::post('remember_me', null) == 1){
					$this->auth->remember_me();
				}
				Response::redirect('/teachers/top');
			}else{
				Response::redirect('/teachers/signin?e=1');
			}
		}
		$view = View::forge("teachers/signin");
		$this->template->title = "Signin";
		$this->template->auth_status = false;
		$this->template->content = $view;
	}
}
