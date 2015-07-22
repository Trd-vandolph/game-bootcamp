<?php

class Controller_Terms extends Controller_Base
{

	public function action_index()
	{
		$this->template->title = "Terms of Use";
		$this->template->sub = "";
		$view = View::forge("terms");
		$this->template->content = $view;
	}
}