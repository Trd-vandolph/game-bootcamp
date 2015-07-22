<?php

class Controller_Teachers extends Controller_Base
{

	public function before(){

		parent::before();

		$this->template = View::forge("teachers/template");

		$this->auth = Auth::instance();

		// logout
		if((int)Input::get("logout", 0) == 1){
			$this->auth->logout();
			Response::redirect('teachers/signin');
		}

		// check login
		if($this->auth_status){
			if($this->user->group_id == 100){
				Response::redirect('admin/');
			}else if($this->user->group_id == 1){
				Response::redirect('students/');
			}else{
				$this->template->name = $this->user->firstname;
			}
		}else{
			Response::redirect('teachers/signin');
		}
		$this->template->user = $this->user;
		$this->template->auth_status = $this->auth_status;
		$this->template->title = "Teachers";
	}

	public function action_index()
	{
		Response::redirect('teachers/top');
	}

}
