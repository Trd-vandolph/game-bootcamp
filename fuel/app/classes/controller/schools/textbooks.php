<?php

class Controller_Students_Textbooks extends Controller_Students
{

	public function action_index()
	{
		$data["trial"] = Model_Content::find("all", [
			"where" => [
				["type_id", -1],
				["deleted_at", 0]
			],
			"order_by" => [
				["number", "asc"],
				["text_type_id", "asc"],
			]
		]);

		$data["basic_javascript"] = Model_Content::find("all", [
			"where" => [
				["type_id", 1],
				["deleted_at", 0]
			],
			"order_by" => [
				["number", "asc"],
				["text_type_id", "asc"],
			]
		]);

		$data["basic_html5"] = Model_Content::find("all", [
			"where" => [
				["type_id", 0],
				["deleted_at", 0]
			],
			"order_by" => [
				["number", "asc"],
				["text_type_id", "asc"],
			]
		]);
		$data["count_text_html5"] = Model_Content::find("all", [
				"where" => [
						["type_id", 0],
						["deleted_at", 0],
						["text_type_id",0],
				],
				"order_by" => [
						["number", "asc"],
						["text_type_id", "asc"],
				]
		]);
		$data["count_text_javascript"] = Model_Content::find("all", [
				"where" => [
						["type_id", 1],
						["deleted_at", 0],
						["text_type_id",0],
				],
				"order_by" => [
						["number", "asc"],
						["text_type_id", "asc"],
				]
		]);
		$data["count_text_php"] = Model_Content::find("all", [
				"where" => [
						["type_id", 2],
						["deleted_at", 0],
						["text_type_id",0],
				],
				"order_by" => [
						["number", "asc"],
						["text_type_id", "asc"],
				]
		]);

		$data["basic_php"] = Model_Content::find("all", [
			"where" => [
				["type_id", 2],
				["deleted_at", 0]
			],
			"order_by" => [
				["number", "asc"],
				["text_type_id", "asc"],
			]
		]);
		$data["final_exam"] = Model_Content::find("all", [
				"where" => [
						["type_id", 3],
						["deleted_at", 0]
				],
				"order_by" => [
						//["number", "asc"],
						//["text_type_id", "asc"],
						["created_at", "desc"],
						["exam", "asc"],
				]
		]);
		$data["user"] = $this->user;

		$data["count_html5"] = Model_Lessontime::count([
			"where" => [
				["language", 0],
				["student_id", $this->user->id],
				["status", 2],
				["deleted_at", 0]
			],
		]);

		$data["count_javascript"] = Model_Lessontime::count([
			"where" => [
				["language", 1],
				["student_id", $this->user->id],
				["status", 2],
				["deleted_at", 0]
			],
		]);

		$data["count_php"] = Model_Lessontime::count([
			"where" => [
				["language", 2],
				["student_id", $this->user->id],
				["status", 2],
				["deleted_at", 0]
			],
		]);
// 		$data["count_exam"] = Model_Lessontime::count([
// 				"where" => [
// 						["student_id", $this->user->id],
// 						["status", 2],
// 						["deleted_at", 0]
// 				],
// 		]);
		$data["done_html"] = Model_Lessontime::count([
				"where" => [
						["student_id", $this->user->id],
						["status", 2],
						["language", 0]
				],
		]);
		$data["done_javascript"] = Model_Lessontime::count([
				"where" => [
						["student_id", $this->user->id],
						["status", 2],
						["language", 1]
				],
		]);
		$data["done_php"] = Model_Lessontime::count([
				"where" => [
						["student_id", $this->user->id],
						["status", 2],
						["language", 2]
				],
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

		$view = View::forge("students/textbooks", $data);
		$this->template->content = $view;
		
	}
}