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

		$data["enchantJS"] = Model_Content::find("all", [
			"where" => [
				["type_id", 0],
				["deleted_at", 0]
			],
			"order_by" => [
				["number", "asc"],
				["text_type_id", "asc"],
			]
		]);
		$data["count_text_enchant"] = Model_Content::find("all", [
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

		$data["user"] = $this->user;

		$data["count_enchant"] = Model_Lessontime::count([
			"where" => [
				["language", 0],
				["student_id", $this->user->id],
				["status", 2],
				["deleted_at", 0],
			],
		]);
		$data["done_html"] = Model_Lessontime::count([
				"where" => [
						["student_id", $this->user->id],
						["status", 2],
						["language", 0],
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
