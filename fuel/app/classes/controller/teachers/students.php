<?php

class Controller_Teachers_Students extends Controller_Teachers
{

	public function before(){

		parent::before();

	}

	public function action_detail($id = 0)
	{
		$student = Model_User::find($id);

		if($student == null){
			Response::redirect("_404_");
		}

		$data["user"] = $student;

		$view = View::forge("teachers/students/detail",$data);
		$this->template->content = $view;
	}
}