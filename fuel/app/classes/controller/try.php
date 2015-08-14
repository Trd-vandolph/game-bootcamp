<?php

class Controller_Try extends Controller_Base
{

	public function action_index()
	{
		$this->template->title = "Try It Yourself";
		$view = View::forge("try");
		$this->template->content = $view;
	}
}