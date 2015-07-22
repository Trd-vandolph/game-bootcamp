<?php

class Controller_Admin_Contacts extends Controller_Admin
{

	public function before(){

		parent::before();

	}

	public function action_index()
	{

		$where = [["deleted_at", 0]];


		$data["contacts"] = Model_Contact::find("all", [
			"where" => $where,
			"order_by" => [
				["id", "desc"]
			]

		]);

		$config=array(
			'pagination_url'=>"",
			'uri_segment'=>"p",
			'num_links'=>9,
			'per_page'=>20,
			'total_items'=>count($data["contacts"]),
		);

		$data["pager"] = Pagination::forge('mypagination', $config);

		$data["contacts"] = array_slice($data["contacts"], $data["pager"]->offset, $data["pager"]->per_page);

		$view = View::forge("admin/contacts", $data);
		$this->template->content = $view;
	}
}