<?php

class Controller_Course extends Controller_Base
{

	public function action_index()
	{
		$this->template->title = "Course";
		$view = View::forge("course");
		$this->template->content = $view;
	}
}