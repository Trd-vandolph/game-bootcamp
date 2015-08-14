<?php

class Controller_Parents extends Controller_Base
{

	public function action_index()
	{		
		$this->template->title = "For Parents";
		$view = View::forge("parents");
		$this->template->content = $view;
	}
}