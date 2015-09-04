<?php

class Controller_Teachers_Textbooks extends Controller_Teachers
{

	public function action_index()
	{
		$data["trial"] = Model_Content::find("all", [
			"where" => [
				["type_id", -1],
				["deleted_at", 0],
				["category", 1]
			],
			"order_by" => [
				["number", "asc"],
				["text_type_id", "asc"],
			]
		]);

		$data["enchant"] = Model_Content::find("all", [
			"where" => [
				["type_id", 0],
				["deleted_at", 0],
				["category", 1],
			],
			"order_by" => [
				["number", "asc"],
				["text_type_id", "asc"],
			]
		]);


		$view = View::forge("teachers/textbooks", $data);
		$this->template->content = $view;
	}
}