<?php

class Controller_Parents extends Controller_Base
{

	public function action_index()
	{
		require("call.php");

		$this->template->title = "Parents";
		$view = View::forge("parents");
		$this->template->content = $view;
	}
}
