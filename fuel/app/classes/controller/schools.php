<?php

class Controller_schools extends Controller_Base
{

	public function before(){

		parent::before();

		$this->template = View::forge("schools/template");

		$this->auth = Auth::instance();

		// logout
		if((int)Input::get("logout", 0) == 1){
			$this->auth->logout();
			Response::redirect('schools/signin');
		}

		// check login
		if($this->auth_status){
			if($this->user->group_id == 50){

				Response::redirect('schools/signin');
			}
		}else{
			Response::redirect('schools/signin');
		}

		$this->template->auth_status = $this->auth_status;
		$this->template->title = "schools";
	}

	public function action_index()
	{
		Response::redirect('schools/top');
	}

}
