<?php

class Controller_Schools_Classroom extends Controller_Schools
{

	public function before(){

		parent::before();

	}

	public function action_index()
	{

		$data["user"] = $this->user;

		$view = View::forge("schools/classroom/index", $data);
		$this->template->content = $view;
	}
}
