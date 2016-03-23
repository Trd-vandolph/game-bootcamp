<?php

class Controller_GroupStudent_Top extends Controller_Groupstudent
{

	public function before(){

		parent::before();

	}

	public function action_index()
	{
		if($this->user->birthday == "0000-00-00"){
			Response::redirect("students/setting/new");
		}

		$data["reservations"] = Model_Lessontime::find("all", [
			"where" => [
				["deleted_at", 0],
				["student_id", $this->user->classroom_id],
				["status", 1],
				["freetime_at", ">=", time()]
			],
			"order_by" => [
				["id", "desc"],
			]
		]);

		$data["lastClass"] = Model_Lessontime::find("last", [
			"where" => [
				["student_id", $this->user->classroom_id],
				["status", 2],
				["language", Input::get("course", 0)],
				["deleted_at", 0]
			]
		]);

		$data["lesson"] = Model_Lessontime::find("first", [
			"where" => [
				["deleted_at", 0],
				//["url", "<>", ""],
				["student_id", $this->user->classroom_id],
				["status", 1],
				["freetime_at", "<=", time() + 1800],
				["freetime_at", ">=", time() - 1800],
			]
		]);

		$data["news"] = Model_News::find("all", [
			"where" => [
				["deleted_at", 0],
				["for_students", 1]
			],
			"order_by" => [
				["id", "desc"],
			],
			"limit" => 5
		]);

		$data["pasts"] = Model_Lessontime::find("all", [
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

		$view = View::forge("groupstudent/top", $data);
		$this->template->content = $view;
	}
}
