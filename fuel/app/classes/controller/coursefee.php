<?php

class Controller_CourseFee extends Controller_Base
{

	public function action_index()
	{
		$this->template->title = "Course Fee";
		$this->template->sub = "Complete information of payment processing";
		$view = View::forge("coursefee");
		$this->template->content = $view;
	}
}

