<?php

class Controller_OperatingCompany extends Controller_Base
{

	public function action_index()
	{
		$this->template->title = "Operating Company";
		$view = View::forge("operatingcompany");
		$this->template->content = $view;
	}
}