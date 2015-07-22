<?php

class Controller_Join extends Controller_Base
{

	public function action_index()
	{

		if(isset($this->user)) {
			$data["student"] = Model_User::find("first", [
					"where" => [
							["deleted_at", 0],
							["id", $this->user->id],
					]
			]);
		}
		
		$this->template->title = "How to Join";
		$this->template->sub = "Guide for joining OliveCode";
		if(isset($this->user)) {
			$view = View::forge("join", $data);
		}else {
			$view = View::forge("join");
		}
		$this->template->content = $view;
	}
}

