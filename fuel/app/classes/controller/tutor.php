<?php

class Controller_Tutor extends Controller_Base
{

	public function action_index()
	{
		$this->template->title = "Tutor";
		$view = View::forge("tutor");
		$this->template->content = $view;
	}
}