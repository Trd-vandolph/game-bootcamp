<?php

class Controller_Grameencom_Paying extends Controller_Grameencom
{	
	public function before(){

		parent::before();

	}

	public function action_index($id = 0)
	{
		$user = Model_User::find($id);
		
		$data["user"] = $user;

		$where = [
				["charge_html",">=", 1],
				["deleted_at", 0],
		];
		
		$data["students"] = Model_User::find("all", [
				"where" => $where,
				"order_by" => [
						["last_login", "desc"],
				]
		]);
		
		
		$query = Model_User::query()
		->where('group_id', '=', 1)
		->where('deleted_at', '=', 0)
		->where('charge_html', '>=', 1);
		
		if($search_text = Input::get("search_text", ""))
		{
			$query
			->where_open()
			->where('email', 'like', "%{$search_text}%")
			->or_where('firstname', 'like', "%{$search_text}%")
			->or_where('middlename', 'like', "%{$search_text}%")
			->or_where('lastname', 'like', "%{$search_text}%")
			->or_where('lastname', 'like', "%{$search_text}%")
			->or_where(DB::expr("CONCAT(trim(firstname),' ',trim(middlename))"), 'like', "%{$search_text}%")
			->or_where(DB::expr("CONCAT(trim(middlename),' ',trim(firstname))"), 'like', "%{$search_text}%")
			->or_where(DB::expr("CONCAT(trim(firstname),' ',trim(lastname))"), 'like', "%{$search_text}%")
			->or_where(DB::expr("CONCAT(trim(lastname),' ',trim(firstname))"), 'like', "%{$search_text}%")
			->or_where(DB::expr("CONCAT(trim(middlename),' ',trim(lastname))"), 'like', "%{$search_text}%")
			->or_where(DB::expr("CONCAT(trim(lastname),' ',trim(middlename))"), 'like', "%{$search_text}%")
			->or_where(DB::expr("CONCAT(trim(firstname),' ',trim(middlename),' ',trim(lastname))"), 'like', "%{$search_text}%")
			->or_where(DB::expr("CONCAT(trim(lastname),' ',trim(middlename),' ',trim(firstname))"), 'like', "%{$search_text}%")
			->or_where(DB::expr("CONCAT(trim(lastname),' ',trim(firstname),' ',trim(middlename))"), 'like', "%{$search_text}%")
			->order_by("id", "desc")
			->where_close();
		}
		
		$data["result"] = $query->get();
		
		
		$config=array(
				'pagination_url'=>"",
				'uri_segment'=>"p",
				'num_links'=>9,
				'per_page'=>10,
				'total_items'=>count($data["students"]),
		);
		
		$data["pager"] = Pagination::forge('mypagination', $config);
		
		$data["students"] = array_slice($data["students"], $data["pager"]->offset, $data["pager"]->per_page);

		$view = View::forge("grameencom/paying", $data);
		$this->template->content = $view;
	}
}
