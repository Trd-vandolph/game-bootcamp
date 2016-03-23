<?php

class Controller_Groupstudent_Teachers extends Controller_Groupstudent
{

	public function before(){

		parent::before();

	}

	public function action_index(){
		
		$data['pasts'] = Model_Lessontime::find("all", [
				"where" => [
						["student_id", $this->user->classroom_id],
						["status", 2],
						["language", Input::get("course", 0)],
						["deleted_at", 0]
				]
		]);
		
		$data["donetrial"] = Model_Lessontime::find("all", [
				"where" => [
						["student_id", $this->user->classroom_id],
						["status", 2],
						["language", Input::get("course", -1)],
						["deleted_at", 0]
				]
		]);
		$data["user"] = $this->user;
		$view = View::forge("groupstudent/teachers/index", $data);
		$this->template->content = $view;
	}

	public function action_detail($id = 0)
	{
		$teacher = Model_User::find($id);

		if($teacher == null){
			Response::redirect("_404_");
		}
		
		$data['pasts'] = Model_Lessontime::find("all", [
				"where" => [
						["student_id", $this->user->classroom_id],
						["status", 2],
						["language", Input::get("course", 0)],
						["deleted_at", 0]
				]
		]);
		
		$data["donetrial"] = Model_Lessontime::find("all", [
				"where" => [
						["student_id", $this->user->classroom_id],
						["status", 2],
						["language", Input::get("course", -1)],
						["deleted_at", 0]
				]
		]);

		$data["user"] = $teacher;

		$view = View::forge("groupstudent/teachers/detail", $data);
		$this->template->content = $view;
	}
}