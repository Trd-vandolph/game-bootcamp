<?php

class Controller_grameencom extends Controller_Base
{

	public function before(){

		parent::before();

		$this->template = View::forge("grameencom/template");

		$this->auth = Auth::instance();

		// logout
		if((int)Input::get("logout", 0) == 1){
			$this->auth->logout();
			Response::redirect('grameencom/signin');
		}

		// check login
		if($this->auth_status){
			if($this->user->group_id != 0){

				Response::redirect('grameencom/signin');
			}
		}else{
			Response::redirect('grameencom/signin');
		}

		$this->template->auth_status = $this->auth_status;
		$this->template->title = "grameencom";
	}

	public function action_index()
	{
		Response::redirect('grameencom/top');
	}

}
