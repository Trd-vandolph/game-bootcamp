<?php

class Controller_Teachers_News extends Controller_Teachers
{

	public function before(){

		parent::before();

	}

	public function action_index()
	{
		$data["news"] = Model_News::find("all", [
			"where" => [
				["deleted_at", 0],
				["for_teachers", 1]
			],
			"order_by" => [
				["id", "desc"],
			],
		]);

		$config=array(
			'pagination_url'=>"",
			'uri_segment'=>"p",
			'num_links'=>9,
			'per_page'=>10,
			'total_items'=>count($data["news"]),
		);

		$data["pager"] = Pagination::forge('mypagination', $config);
		$data["news"] = array_slice($data["news"], $data["pager"]->offset, $data["pager"]->per_page);
		$data["user"] = $this->user;
		$view = View::forge("teachers/news/index", $data);
		$this->template->content = $view;
	}

	public function action_detail($id){
		$data["news"] = Model_News::find($id, [
			"where" => [
				["deleted_at", 0],
				["for_teachers", 1]
			],
		]);

		if($data["news"] == null){
			Response::redirect("teachers/news");
		}

		$is_read = Model_Readnews::find("first", [
			"where" => [
				["user_id" => $this->user->id],
				["news_id" => $id]
			]
		]);

		if($is_read == null){
			$is_read = Model_Readnews::forge();
			$is_read->user_id = $this->user->id;
			$is_read->news_id = $id;
			$is_read->save();
		}

		$data["user"] = $this->user;
		$view = View::forge("teachers/news/detail", $data);
		$this->template->content = $view;
	}
}
