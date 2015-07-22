<?php

class Controller_Admin_Grameencom_Events extends Controller_Admin
{
	private $fields = array('title','starttime','endtime','allday','body');

	public function before(){

		parent::before();

	}

	public function action_index()
	{
		
		$is_chenged = false;
		
		$where = [["deleted_at", 0]];
		
		$data["events"] = Model_events::find("all", [
				"where" => $where,
				"order_by" => [
						["id", "desc"],
				]
		]);
		
		$data["contacts"] = Model_Contactforum::find("all", [
				"where" => [
						["deleted_at", 0]
				],
				"order_by" => [
						["id", "desc"],
				],
				"limit" => 10,
		]);
		
		$config=array(
				'pagination_url'=>"",
				'uri_segment'=>"p",
				'num_links'=>9,
				'per_page'=>10,
				'total_items'=>count($data["events"]),
		);
		
		$data["pager"] = Pagination::forge('mypagination', $config);
		
		$data["events"] = array_slice($data["events"], $data["pager"]->offset, $data["pager"]->per_page);
		
		$view = View::forge("admin/grameencom/events/index", $data);
		$this->template->content = $view;
	}
	
	public function action_edit($id = 0)
	{
		//saving edits
		if(Input::post('action') == 'save'){
			foreach($this->fields as $field){
				Session::set_flash($field, Input::post($field));
			}
		
			$data = array();
			foreach ($this->fields as $field)
			{
				$data[$field] = Session::get_flash($field);
				Session::keep_flash($field);
			}
		
			$data["events"] = Model_Events::find($id);
		
			if($data["events"] == null){
				$data["events"] = Model_Events::forge();
			}
		
			if(Session::get_flash('title') != null and Security::check_token()){
				$events = $data["events"];
				$events->title = Session::get_flash("title", 0);
				$events->start_time = Session::get_flash("starttime", 0);
				$events->end_time = Session::get_flash("endtime", 0);
				$events->allday = Session::get_flash("allday");
				$events->body = Session::get_flash("body");
				
				$events->save();
		
				$body = View::forge("email/email");
				$body->set("title", $events->title);
				$body->set("body", $events->body);
				
				Response::redirect("/admin/grameencom/top");
			}
			
			$view = View::forge("admin/grameencom/events/edit", $data);
			$this->template->content = $view;
		}
		
		$data["events"] = Model_Events::find($id);

		if($data["events"] == null){
			$data["events"] = Model_Events::forge();
		}

		if(Session::get_flash('title') != null and Security::check_token()){

			$events = $data["events"];
			$events->title = Session::get_flash("title", 0);
			$events->start_time = Session::get_flash("starttime", 0);
			$events->end_time = Session::get_flash("endtime", 0);
			$events->allday = Session::get_flash("allday");
			$events->body = Session::get_flash("body");
			
			if($events->for_all == null){
				$events->for_all = 0;
			}
			
			if($events->for_students == null){
				$events->for_students = 0;
			}

			if($mail->for_teachers == null){
				$events->for_teachers = 0;
			}

			$events->save();

			$body = View::forge("email/events");
			$body->set("title", $events->title);
			$body->set("body", $events->body);
		}
		$data["ym"] = Input::get("ym", date("Y-m"));
		$data["view"] = Model_Lessontime::find("all", [
				"where" => [
						["student_id", ">", 0],
						["deleted_at", 0],
						["freetime_at", ">=", strtotime($data["ym"] . "-01")],
						["freetime_at", "<", strtotime($data["ym"] . "-01 +1 month")],
						["status", 1],
				],
				"order_by" => [
						["freetime_at", "asc"],
				]
		]);
		
		$data["contacts"] = Model_Contactforum::find("all", [
				"where" => [
						["deleted_at", 0]
				],
				"order_by" => [
						["id", "desc"],
				],
				"limit" => 10,
		]);
		
		$view = View::forge("admin/grameencom/events/edit", $data);
		$this->template->content = $view;
	}
	
	public function action_message($id){
		$data["events"] = Model_events::find($id, [
			"where" => [
							[
								["deleted_at", 0]
							]
						],
		]);
		
		if($data["events"] == null){
			Response::redirect("admin/grameencom/events");
		}

		$is_read = Model_Readevents::find("first", [
			"where" => [
				["user_id" => $this->user->id],
				["event_title" => $id]
			]
		]);
		
		if($is_read == null){
			$is_read = Model_Readevents::forge();
			$is_read->user_id = $this->user->id;
			$is_read->event_title = $id;
			$is_read->save();
		}
		
		$data["contacts"] = Model_Contactforum::find("all", [
				"where" => [
						["deleted_at", 0]
				],
				"order_by" => [
						["id", "desc"],
				],
				"limit" => 10,
		]);
		
		$data["user"] = $this->user;

		$view = View::forge("admin/grameencom/events/message", $data);
		$this->template->content = $view;
	}
	
	public function action_view()
	{
	
		$is_chenged = false;
	
		$where = [["deleted_at", 0]];
	
		$data["events"] = Model_events::find("all", [
				"where" => $where,
				"order_by" => [
						["id", "desc"],
				]
		]);
	
		$config=array(
				'pagination_url'=>"",
				'uri_segment'=>"p",
				'num_links'=>9,
				'per_page'=>10,
				'total_items'=>count($data["events"]),
		);
	
		$data["pager"] = Pagination::forge('mypagination', $config);
	
		$data["events"] = array_slice($data["events"], $data["pager"]->offset, $data["pager"]->per_page);
	
		$view = View::forge("admin/grameencom/events/view", $data);
		$this->template->content = $view;
	}
	
	public function action_all()
	{
		$is_chenged = false;
	
		$where = [["deleted_at", 0]];
	
		$data["events"] = Model_events::find("all", [
				"where" => $where,
				"order_by" => [
						["id", "desc"],
				]
		]);
		
		$data["contacts"] = Model_Contactforum::find("all", [
			"where" => [
				["deleted_at", 0]
			],
			"order_by" => [
				["id", "desc"],
			],
			"limit" => 10,
		]);
	
		$config=array(
				'pagination_url'=>"",
				'uri_segment'=>"p",
				'num_links'=>9,
				'per_page'=>10,
				'total_items'=>count($data["events"]),
		);
	
		$data["pager"] = Pagination::forge('mypagination', $config);
		$data["contacts"] = array_slice($data["contacts"], $data["pager"]->offset, $data["pager"]->per_page);
		$data["events"] = array_slice($data["events"], $data["pager"]->offset, $data["pager"]->per_page);
	
		$view = View::forge("admin/grameencom/events/all", $data);
		$this->template->content = $view;
	}
}
