<?php

class Controller_Try extends Controller_Base
{

	public function action_index()
	{
		require("call.php");

		$this->template->title = "Try It Yourself";
		$view = View::forge("try");
		$this->template->content = $view;
	}
}
