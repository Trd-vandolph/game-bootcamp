<?php

class Controller_Grameencom_Holidays extends Controller_Grameencom
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
		
		$config=array(
				'pagination_url'=>"",
				'uri_segment'=>"p",
				'num_links'=>9,
				'per_page'=>10,
				'total_items'=>count($data["events"]),
		);
		
		$data["pager"] = Pagination::forge('mypagination', $config);
		
		$data["events"] = array_slice($data["events"], $data["pager"]->offset, $data["pager"]->per_page);
		
		$view = View::forge("grameencom/events/index", $data);
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
		
				$body = View::forge("email/events");
				$body->set("title", $events->title);
				$body->set("body", $events->body);
				
				Response::redirect("/grameencom/top");
			}
			
			$view = View::forge("grameencom/events/edit", $data);
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
		
		$view = View::forge("grameencom/holidays/edit", $data);
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
			Response::redirect("grameencom/events");
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

		$data["user"] = $this->user;

		$view = View::forge("grameencom/holidays/message", $data);
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
	
		$view = View::forge("grameencom/holidays/view", $data);
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
	
		$config=array(
				'pagination_url'=>"",
				'uri_segment'=>"p",
				'num_links'=>9,
				'per_page'=>10,
				'total_items'=>count($data["events"]),
		);
	
		$data["pager"] = Pagination::forge('mypagination', $config);
	
		$data["events"] = array_slice($data["events"], $data["pager"]->offset, $data["pager"]->per_page);
	
		$view = View::forge("grameencom/holidays/all", $data);
		$this->template->content = $view;
	}
	
	public function action_create()
	{
	
		$data["ym"] = Input::get("ym", date("Y-m"));
		$where = [["deleted_at", 0]];
	
		$data["events"] = Model_Events::find("all", [
				"where" => $where,
				"order_by" => [
						["id", "desc"],
				]
		]);
			
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
	
			$data["events"] = Model_events::find('id');
	
			if($data["events"] == null){
				$data["events"] = Model_events::forge();
			}
	
			// add
			if(Session::get_flash('title') != null and Security::check_token()){
	
				// save
				$events = $data["events"];
				$events->title = Session::get_flash("title", 0);
				$events->start_time = Session::get_flash("starttime", 0);
				$events->end_time = Session::get_flash("endtime", 0);
				$events->allday = Session::get_flash("year")."-".Session::get_flash("month")."-".Session::get_flash("day");
				$events->body = Session::get_flash("body");
	
				$events->save();
	
				$body = View::forge("email/email");
				$body->set("title", $events->title);
				$body->set("body", $events->body);
			}
			Response::redirect("/grameencom/top");
		}
	
		// add
		if(Input::post("teacher_id", null) != null and Security::check_token()){
	
			// save
			$reservation = Model_Lessontime::forge();
			$reservation->teacher_id = Input::post("teacher_id", 0);
			$reservation->student_id = 0;
			$reservation->status = 0;
			$reservation->freetime_at = strtotime(Input::post("year", 0) . "-" . Input::post("month", 0) . "-" . Input::post("day", 0) . " " . Input::post("hour", 0) . ":" . Input::post("min", 0) . ":00");
			$reservation->save();
		}
	
		$where = [["deleted_at", 0]];
	
		if(Input::get("search_teacher", 0) != 0){
			array_push($where, ["teacher_id" => Input::get("search_teacher", 0)]);
		}
	
		if(Input::get("year", 0) != 0 && Input::get("month", 0) != 0 && Input::get("day", 0) != 0){
			$y = Input::get("year", 0);
			$m = Input::get("month", 0);
			$d = Input::get("day", 0);
			array_push($where, ["freetime_at", ">=", strtotime("$y-$m-$d 00:00:00")]);
			array_push($where, ["freetime_at", "<=", strtotime("$y-$m-$d 23:59:59")]);
		}
	
		$data["reservations"] = Model_Lessontime::find("all", [
				"where" => $where,
				"order_by" => [
						["id", "desc"],
				]
		]);
	
		$data["teachers"] = Model_User::find("all", [
				"where" => [
						["group_id", 10],
						["deleted_at", 0]
				],
				"order_by" => [
						["id", "desc"]
				]
	
		]);
	
	
		$view = View::forge("grameencom/holidays/create", $data);
		$this->template->content = $view;
	}
}