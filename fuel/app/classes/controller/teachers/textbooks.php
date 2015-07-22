<?php

class Controller_Teachers_Textbooks extends Controller_Teachers
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


		$view = View::forge("teachers/textbooks", $data);
		$this->template->content = $view;
	}
}