<?php

class Controller_Course extends Controller_Base
{

	public function action_index()
	{

		if($this->user != null && $this->user->group_id == 1){
			$data["id"] = $this->user->id;
		}else{
			$data["id"] = null;
		}

		$this->template->title = "Course";
		$this->template->sub = "Let us help you learn programming";
		$view = View::forge("course", $data);
		$this->template->content = $view;
	}
}