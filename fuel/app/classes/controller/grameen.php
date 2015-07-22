<?php

class Controller_Grameen extends Controller_Base
{

	public function action_index()
	{
		$this->template->title = "Grameen Communications";
		$this->template->sub = "Supports your passion for changing your life";
		$view = View::forge("grameen");
		$this->template->content = $view;
	}
}

