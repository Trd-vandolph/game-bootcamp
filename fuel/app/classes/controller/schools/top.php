<?php

class Controller_Schools_Top extends Controller_Schools
{

	public function before(){

		parent::before();

	}

	public function action_index()
	{
		$data["reservations"] = Model_Lessontime::find("all", [
			"where" => [
				["deleted_at", 0],
				["student_id", $this->user->id],
				["status", 1],
				["freetime_at", ">=", time()]
			],
			"order_by" => [
				["id", "desc"],
			]
		]);

		$data["lastClass"] = Model_Lessontime::find("last", [
			"where" => [
				["student_id", $this->user->id],
				["status", 2],
				["language", Input::get("course", 0)],
				["deleted_at", 0]
			]
		]);

		$data["lesson"] = Model_Lessontime::find("first", [
			"where" => [
				["deleted_at", 0],
				//["url", "<>", ""],
				["student_id", $this->user->id],
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

		$data["class"] = Model_Classroom::find("all", [
			"where" => [
				["school_id", $this->user->id],
				["deleted_at", 0]
			]
		]);

		$class = $data["class"];
		$class_arr = array();

		foreach($class as $cl) {
			$data["class_reservation"] = Model_Lessontime::find("all", [
				"where" => [
					["student_id", $cl->id],
					["deleted_at", 0],
					["status", 1],
					["freetime_at", ">=", time()]
				]
			]);

			$class_reservation = $data["class_reservation"];

			foreach($class_reservation as $class_res) {
				array_push($class_arr, $class_res->id);
			}
		}

		$data["class_arr"] = $class_arr;

		$data["user"] = $this->user;

		$view = View::forge("schools/top", $data);
		$this->template->content = $view;
	}
}
