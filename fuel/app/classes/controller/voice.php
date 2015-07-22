<?php

class Controller_Voice extends Controller_Base
{

	public function action_index()
	{
		$this->template->title = "Voice of Students";
		$this->template->sub = "Here the Impressions from Graduated Students";
		$view = View::forge("voice");
		$this->template->content = $view;
	}
}