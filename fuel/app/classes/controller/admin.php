<?php

class Controller_Admin extends Controller_Base
{

	public function before(){

		parent::before();

		$this->template = View::forge("admin/template");

		$this->auth = Auth::instance();

		// logout
		if((int)Input::get("logout", 0) == 1){
			$this->auth->logout();
			Response::redirect('admin/signin');
		}

		// check login
		if($this->auth_status){
			if($this->user->group_id != 100){

				Response::redirect('admin/signin');
			}
		}else{
			Response::redirect('admin/signin');
		}

		$this->template->auth_status = $this->auth_status;
		$this->template->title = "Admin";
	}

	public function action_index()
	{
		Response::redirect('admin/top');
	}

}
