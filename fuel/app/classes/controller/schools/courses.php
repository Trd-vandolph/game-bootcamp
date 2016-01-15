<?php

class Controller_Schools_Courses extends Controller_Schools
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

		$data["id"] = $this->user->id;
		$data['user'] = $this->user;
		$view = View::forge("schools/courses/index", $data);
		$this->template->content = $view;
	}
}
