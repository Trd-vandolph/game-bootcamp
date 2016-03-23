<?php

class Controller_Groupstudent_Contactforum extends Controller_Groupstudent
{

	public function before(){
		parent::before();
	}

	public function action_index()
	{

		if(Input::get("del_id", null) != null){
			$del_forum = Model_Contactforum::find(Input::get("del_id", 0));
			if($del_forum->user_id == $this->user->id){
				$del_forum->deleted_at = time();
				$del_forum->save();
			}
		}

		$where = [["deleted_at", 0], ["user_id", $this->user->id]];

		$data["forum"] = Model_Contactforum::find("all", [
			"where" => $where,
			"order_by" => [
				["id", "desc"],
			]
		]);
		
		$data['pasts'] = Model_Lessontime::find("all", [
				"where" => [
						["student_id", $this->user->classroom_id],
						["status", 2],
						["language", Input::get("course", 0)],
						["deleted_at", 0]
				]
		]);
		
		$data["donetrial"] = Model_Lessontime::find("all", [
				"where" => [
						["student_id", $this->user->classroom_id],
						["status", 2],
						["language", Input::get("course", -1)],
						["deleted_at", 0]
				]
		]);
		
		$config=array(
			'pagination_url'=>"?",
			'uri_segment'=>"p",
			'num_links'=>9,
			'per_page'=>20,
			'total_items'=>count($data["forum"]),
		);

		$data["pager"] = Pagination::forge('mypagination', $config);

		$data["news"] = array_slice($data["forum"], $data["pager"]->offset, $data["pager"]->per_page);
		$data["user"] = $this->user;
		$view = View::forge("groupstudent/contacts/forum/index", $data);
		$this->template->content = $view;
	}

	public function action_edit($id = 0)
	{
		$data["forum"] = Model_Contactforum::find($id);
		
		$data['pasts'] = Model_Lessontime::find("all", [
				"where" => [
						["student_id", $this->user->classroom_id],
						["status", 2],
						["language", Input::get("course", 0)],
						["deleted_at", 0]
				]
		]);
		
		$data["donetrial"] = Model_Lessontime::find("all", [
				"where" => [
						["student_id", $this->user->classroom_id],
						["status", 2],
						["language", Input::get("course", -1)],
						["deleted_at", 0]
				]
		]);
		
		if($data["forum"] == null){
			$data["forum"] = Model_Contactforum::forge();
		}

		// add
		if(Input::post("title", "") != "" and Security::check_token()){

			// save
			$data["forum"]->title = Input::post("title", "");
			$data["forum"]->body = Input::post("body", "");
			if($id == 0){
				$data["forum"]->user_id = $this->user->id;
			}
			$data["forum"]->save();
			Response::redirect("/students/contactforum/");
		}
		$data["user"] = $this->user;
		$view = View::forge("groupstudent/contacts/forum/edit", $data);
		$this->template->content = $view;
	}

	public function action_comment($id = 0)
	{
		$data["comment"] = Model_Contactcomment::find($id);
		
		$data['pasts'] = Model_Lessontime::find("all", [
				"where" => [
						["student_id", $this->user->classroom_id],
						["status", 2],
						["language", Input::get("course", 0)],
						["deleted_at", 0]
				]
		]);
		
		$data["donetrial"] = Model_Lessontime::find("all", [
				"where" => [
						["student_id", $this->user->classroom_id],
						["status", 2],
						["language", Input::get("course", -1)],
						["deleted_at", 0]
				]
		]);
		
		if($data["comment"] == null or $data["comment"]->user_id != $this->user->id){
			Response::redirect("/groupstudent/contactforum/");
		}

		// add
		if(Input::post("body", "") != "" and Security::check_token()){

			// save
			$data["comment"]->body = Input::post("body", "");
			$data["comment"]->save();
			Response::redirect("/groupstudent/contactforum/detail/{$data["comment"]->contactforum_id}");
		}
		$view = View::forge("groupstudent/forum/comment", $data);
		$this->template->content = $view;
	}

	public function action_detail($id = 0)
	{
		$data['pasts'] = Model_Lessontime::find("all", [
				"where" => [
						["student_id", $this->user->classroom_id],
						["status", 2],
						["language", Input::get("course", 0)],
						["deleted_at", 0]
				]
		]);
		
		$data["donetrial"] = Model_Lessontime::find("all", [
				"where" => [
						["student_id", $this->user->classroom_id],
						["status", 2],
						["language", Input::get("course", -1)],
						["deleted_at", 0]
				]
		]);
		
		$data["forum"] = Model_Contactforum::find($id);

		if($data["forum"] == null){
			Response::redirect("/groupstudent/contactforum/");
		}

		if(Input::get("del_id", null) != null){
			$del_comment = Model_Contactcomment::find(Input::get("del_id", 0));
			if($del_comment->user_id == $this->user->id){
				$del_comment->deleted_at = time();
				$del_comment->save();
			}
		}

		// add
		if(Input::post("body", "") != "" and Security::check_token()){
			// save
			$comment = Model_Contactcomment::forge();
			$comment->body = Input::post("body", "");
			$comment->contactforum_id = $id;
			$comment->user_id = $this->user->id;
			$comment->save();

			$data["forum"]->is_read = 0;
			$data["forum"]->save();
		}

		$data["user"] = $this->user;

		$view = View::forge("groupstudent/contacts/forum/detail", $data);
		$this->template->content = $view;
	}
}