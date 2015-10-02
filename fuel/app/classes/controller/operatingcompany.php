<?php

class Controller_OperatingCompany extends Controller_Base
{

	public function action_index()
	{
		require("call.php");

		$this->template->title = "Operating Company";
		$view = View::forge("operatingcompany");
		$this->template->content = $view;
	}
}
