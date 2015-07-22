<?php

class Controller_Admin_Signin extends Controller_Base
{

	public function action_index()
	{
		$this->template = View::forge("admin/template");

		// login
		if(Input::post("email", null) !== null and Security::check_token()){
			$email = Input::post('email', null);
			$password = Input::post('password', null);
			if($this->auth->login( $email, $password)){
				Response::redirect('/admin/top');
			}else{
				Response::redirect('/admin/signin?e=1');
			}
		}


		$view = View::forge("admin/signin");
		$this->template->content = $view;
		$this->template->title = "Signin";
		$this->template->auth_status = false;
	}
}