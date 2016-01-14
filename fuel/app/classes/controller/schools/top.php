<?php

class Controller_Schools_Top extends Controller_Schools
{

	private $fields = array('title','starttime','endtime','allday','body');
	
	public function before(){

		parent::before();

	}

	public function action_index($id = 0)
	{
		$user = Model_User::find($id);
		
		$data["user"] = $user;

		$where = [["deleted_at", 0]];
		
		$data["events"] = Model_Events::find("all", [
				"where" => $where,
				"order_by" => [
						["id", "desc"],
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
		}
		
		$year = date("Y");
		$month = date("m");

		$price = Model_Grade::find("first",[
			"where" => [
				["year", $year],
				["month", $month]
			]
		]);

		if($price == null){
			$price = Model_Grade::forge();
			$price->year = $year;
			$price->month = $month;
			$price->grade_1 = Config::get("prices")[0];
			$price->grade_2 = Config::get("prices")[1];
			$price->grade_3 = Config::get("prices")[2];
			$price->grade_4 = Config::get("prices")[3];
			$price->grade_5 = Config::get("prices")[4];
			$price->save();
		}

		$data["ym"] = Input::get("ym", date("Y-m"));

		$data["contacts"] = Model_Contactforum::find("all", [
			"where" => [
				["deleted_at", 0]
			],
			"order_by" => [
				["id", "desc"],
			],
			"limit" => 10,
		]);
		
		$data["reservations"] = Model_Lessontime::find("all", [
				"where" => [
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
		
		$data["completed"] = Model_Lessontime::find("all", [
				"where" => [
						["deleted_at", 0],
						["freetime_at", ">=", strtotime($data["ym"] . "-01")],
						["freetime_at", "<", strtotime($data["ym"] . "-01 +1 month")],
						["status", 2],
						["history", 1],
				],
				"order_by" => [
						["freetime_at", "asc"],
				]
		]);
		$data["readevents"] = Model_Events::find("all", [
				"where" => [
						["deleted_at", 0],
						["allday", NULL],
						["start_time", ">=", strtotime($data["ym"] . "-01")],
						["end_time", "<", strtotime($data["ym"] . "-01 +1 month")],
				],
				"order_by" => [
						["start_time", "asc"],
				]
		]);
		$data["dayevents"] = Model_Events::find("all", [
				"where" => [
						["deleted_at", 0],
						["allday", ">", 0],
						["start_time", ">=", strtotime($data["ym"] . "-01")],
						["end_time", "<", strtotime($data["ym"] . "-01 +1 month")],
				],
				"order_by" => [
						["start_time", "asc"],
				]
		]);
		
		$view = View::forge("schools/top", $data);
		$this->template->content = $view;
	}
}
