<?php

class Controller_Schools_Teachers extends Controller_Schools
{

	public function before(){

		parent::before();

	}

	public function action_index(){

		$data['pasts'] = Model_Lessontime::find("all", [
				"where" => [
						["student_id", $this->user->id],
						["status", 2],
						["language", Input::get("course", 0)],
						["deleted_at", 0]
				]
		]);

		$data["donetrial"] = Model_Lessontime::find("all", [
				"where" => [
						["student_id", $this->user->id],
						["status", 2],
						["language", Input::get("course", -1)],
						["deleted_at", 0]
				]
		]);
		$data["user"] = $this->user;
		$view = View::forge("schools/teachers/index", $data);
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
						["student_id", $this->user->id],
						["status", 2],
						["language", Input::get("course", 0)],
						["deleted_at", 0]
				]
		]);

		$data["donetrial"] = Model_Lessontime::find("all", [
				"where" => [
						["student_id", $this->user->id],
						["status", 2],
						["language", Input::get("course", -1)],
						["deleted_at", 0]
				]
		]);

		$data["user"] = $teacher;

		$view = View::forge("schools/teachers/detail", $data);
		$this->template->content = $view;
	}
}
