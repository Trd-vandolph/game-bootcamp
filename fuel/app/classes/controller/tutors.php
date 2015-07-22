<?php

class Controller_Tutors extends Controller_Base
{

	public function action_index()
	{
		$this->template->title = "Tutors";
		$this->template->sub = "They grow your ability and bring out the best in you";
		$view = View::forge("tutors");
		$this->template->content = $view;
	}
}