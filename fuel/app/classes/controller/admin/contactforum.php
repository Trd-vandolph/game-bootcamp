<?php

class Controller_Admin_contactforum extends Controller_Admin
{

	public function before(){
		parent::before();
	}

	public function action_index()
	{

		$where = [["deleted_at", 0]];

		$data["forum"] = Model_Contactforum::find("all", [
			"where" => $where,
			"order_by" => [
				["id", "desc"],
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

		$view = View::forge("admin/contacts/forum/index", $data);
		$this->template->content = $view;
	}

	public function action_edit($id = 0)
	{
		$data["forum"] = Model_Contactforum::find($id);

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
			Response::redirect("/admin/contactforum/");
		}
		$view = View::forge("admin/contacts/forum/edit", $data);
		$this->template->content = $view;
	}

	public function action_comment($id = 0)
	{
		$data["comment"] = Model_Contactcomment::find($id);

		if($data["comment"] == null){
			Response::redirect("/admin/contactforum/");
		}

		// add
		if(Input::post("body", "") != "" and Security::check_token()){

			// save
			$data["comment"]->body = Input::post("body", "");
			$data["comment"]->save();
			Response::redirect("/admin/contactforum/detail/{$data["comment"]->contactforum_id}");
		}
		$view = View::forge("admin/contacts/forum/comment", $data);
		$this->template->content = $view;
	}

	public function action_detail($id = 0)
	{
		$data["forum"] = Model_Contactforum::find($id);

		if($data["forum"] == null){
			Response::redirect("/admin/contactforum/");
		}

		if($data["forum"]->is_read == 0){
			$data["forum"]->is_read = 1;
			$data["forum"]->save();
		}
		if(Input::get("del_id", null) != null){
			$del_comment = Model_Contactcomment::find(Input::get("del_id", 0));
			$del_comment->deleted_at = time();
			$del_comment->save();
		}

		// add
		if(Input::post("body", "") != "" and Security::check_token()){
			// save
			$comment = Model_Contactcomment::forge();
			$comment->body = Input::post("body", "");
			$comment->contactforum_id = $id;
			$comment->user_id = $this->user->id;
			$comment->save();
		}

		$view = View::forge("admin/contacts/forum/detail", $data);
		$this->template->content = $view;
	}
}