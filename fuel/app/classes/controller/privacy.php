<?php

class Controller_Privacy extends Controller_Base
{

	public function action_index()
	{
		$this->template->title = "Privacy Policy";
		$this->template->sub = "";
		$view = View::forge("privacy");
		$this->template->content = $view;
	}
}