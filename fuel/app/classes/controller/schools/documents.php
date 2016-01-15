<?php

class Controller_Schools_Documents extends Controller_Schools
{

	public function action_index()
	{
		$data["documents"] = Model_Document::find("all", [
			"where" => [
				["deleted_at", 0]
			],
			"order_by" => [
				["created_at", "desc"],
			]
		]);

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

		$data['user'] = $this->user;
		$view = View::forge("schools/documents", $data);
		$this->template->content = $view;
	}
}
