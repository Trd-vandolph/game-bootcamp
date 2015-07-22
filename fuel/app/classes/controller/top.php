<?php

class Controller_Top extends Controller_Base
{

	public function action_index()
	{
		$this->template->title = "Top";
		$view = View::forge("top");
		$this->template->content = $view;
	}
}