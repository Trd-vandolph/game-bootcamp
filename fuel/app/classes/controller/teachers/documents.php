<?php

class Controller_Teachers_Documents extends Controller_Teachers
{

	public function action_index()
	{
		$data["documents"] = Model_Document::find("all", [
			"where" => [
				["deleted_at", 0],
				["category", 1]
			],
			"order_by" => [
				["created_at", "desc"],
			]
		]);


		$view = View::forge("teachers/documents", $data);
		$this->template->content = $view;
	}
}