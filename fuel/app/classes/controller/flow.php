<?php

class Controller_Flow extends Controller_Base
{

	public function action_index()
	{
		$this->template->title = "Course Flow";
		$this->template->sub = "Registration & Study Flow";
		$view = View::forge("flow");
		$this->template->content = $view;
	}
}