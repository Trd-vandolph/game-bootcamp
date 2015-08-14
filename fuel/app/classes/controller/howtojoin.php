<?php

class Controller_HowToJoin extends Controller_Base
{

	public function action_index()
	{
		$this->template->title = "How To Join";
		$view = View::forge("howtojoin");
		$this->template->content = $view;
	}
}