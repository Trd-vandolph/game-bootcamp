<?php

class Controller_Grameencom_Reservations extends Controller_Grameencom
{
	private $fields = array('title','starttime','endtime','allday','body');

	public function before(){

		parent::before();

	}

	public function action_index()
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
							["history", 1],
					],
					"order_by" => [
							["freetime_at", "asc"],
					]
			]);
		
			if(Input::post('action') == 'draft'){
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
					$events->allday = Session::get_flash("allday");
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


		$view = View::forge("grameencom/reservations/index", $data);
		$this->template->content = $view;
	}

	public function action_view()
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
							["history", 1],
					],
					"order_by" => [
							["freetime_at", "asc"],
					]
			]);
		
			if(Input::post('action') == 'draft'){
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
					$events->allday = Session::get_flash("allday");
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
		
		$data["completed"] = Model_Lessontime::find("all", [
				"where" => [
						["deleted_at", 0],
						["freetime_at", ">=", strtotime($data["ym"] . "-01")],
						["freetime_at", "<", strtotime($data["ym"] . "-01 +1 month")],
						["status", 2],
				],
				"order_by" => [
						["freetime_at", "asc"],
				]
		]);


		$view = View::forge("grameencom/reservations/view", $data);
		$this->template->content = $view;
	}
}