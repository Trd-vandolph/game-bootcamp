<?php

class Controller_Faq extends Controller_Base
{

	public function action_index()
	{
		$this->template->title = "FAQ";
		$this->template->sub = "Frequentry Asked Question";
		$view = View::forge("faq");
		$this->template->content = $view;
	}
}