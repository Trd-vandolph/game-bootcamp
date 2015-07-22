<?php

class Controller_About extends Controller_Base
{

	public function action_index()
	{
		$this->template->title = "About";
		$this->template->sub = "Let us know you about Olivecode";
		$view = View::forge("about");
		$this->template->content = $view;
	}
}