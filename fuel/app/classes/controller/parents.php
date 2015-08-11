<?php

class Controller_Parents extends Controller_Base
{

	public function action_index()
	{
		$data['memSettings1'] = $memSettings1;
		
		$this->template->title = "For Parents";
		$view = View::forge("parents");
		$this->template->content = $view;
	}
}