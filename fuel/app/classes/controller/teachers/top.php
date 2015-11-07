<?php

class Controller_Teachers_Top extends Controller_Teachers
{

	public function before(){

		parent::before();

	}

	public function action_index()
	{
		if($this->user->birthday == "0000-00-00"){
			Response::redirect("teachers/setting/new");
		}

		$data["reservations"] = Model_Lessontime::find("all", [
			"where" => [
				["deleted_at", 0],
				["teacher_id", $this->user->id],
				["status", 1],
				["freetime_at", ">=", time()]
			],
			"order_by" => [
				["id", "desc"],
			]
		]);

		$data["news"] = Model_News::find("all", [
			"where" => [
				["deleted_at", 0],
				["for_teachers", 1]
			],
			"order_by" => [
				["id", "desc"],
			],
			"limit" => 5
		]);

		$data["user"] = $this->user;

		$view = View::forge("teachers/top", $data);
		$this->template->content = $view;
	}
}
