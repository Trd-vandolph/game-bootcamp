<?php

class Controller_withdraw extends Controller_Base
{
	public function before()
	{
		parent::before();
		if($this->auth_status)
		{
		}
		else
		{
			Response::redirect('students/signin');
		}
	}

	public function action_index()
	{
		$this->template->title = "Withdraw";
		$this->template->sub = "";
		$view = View::forge("withdraw/index");
		$this->template->content = $view;
	}

	public function action_done()
	{
		$this->auth->logout();
		$this->user->email = sha1($this->user->email . time());
		$this->user->username = sha1($this->user->username . time());
		$this->user->deleted_at = time();
		$this->user->save();

		$this->template->title = "Withdraw";
		$this->template->sub = "";
		$view = View::forge("withdraw/done");
		$this->template->content = $view;
	}
}
