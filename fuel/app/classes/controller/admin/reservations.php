<?php

class Controller_Admin_Reservations extends Controller_Admin
{

	public function before(){

		parent::before();

	}

	public function action_index()
	{

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

		$config=array(
			'pagination_url'=>"?search_teacher=".Input::get("search_teacher", 0),
			'uri_segment'=>"p",
			'num_links'=>9,
			'per_page'=>20,
			'total_items'=>count($data["reservations"]),
		);

		$data["pager"] = Pagination::forge('mypagination', $config);

		$data["reservations"] = array_slice($data["reservations"], $data["pager"]->offset, $data["pager"]->per_page);

		$data["teachers"] = Model_User::find("all", [
			"where" => [
				["group_id", 10],
				["deleted_at", 0]
			],
			"order_by" => [
				["id", "desc"]
			]

		]);


		$view = View::forge("admin/reservations/index", $data);
		$this->template->content = $view;
	}

	public function action_edit($id = 0)
	{
		$data["error"] = "";

		$data["reservation"] = Model_Lessontime::find($id);

		if($data["reservation"] == null){
			Response::redirect("/admin/reservations");
		}

		// add
		if(Input::post("teacher_id", null) != null and Security::check_token()){

			$data["reservation"]->teacher_id = Input::post("teacher_id", 0);
			$data["reservation"]->student_id = Input::post("student_id", 0);;
			$data["reservation"]->freetime_at = strtotime(Input::post("year", 0) . "-" . Input::post("month", 0) . "-" . Input::post("day", 0) . " " . Input::post("hour", 0) . ":00:00");
			$data["reservation"]->language = Input::post("language", 0);

			if($data["reservation"]->student_id == 0){
				$data["reservation"]->status = 0;
			}else{
				$data["reservation"]->status = 1;

				$reserved = Model_Lessontime::find("all", [
					"where" => [
						["id", "<>", $data["reservation"]->id],
						["student_id", $data["reservation"]->student_id],
						["status", 1],
						["deleted_at", 0],
					]
				]);

				if($reserved == null){

				$pasts = Model_Lessontime::find("all", [
					"where" => [
						["id", "<>", $data["reservation"]->id],
						["student_id", $data["reservation"]->student_id],
						["status", 2],
						["language", Input::post("language", 0)]
					]
				]);
				if($pasts == null){
					$pasts = [];
				}

				$data["reservation"]->number = count($pasts) + 1;
				}else{
					$data["error"] = "this user already have lesson.";
				}
			}

			$data["reservation"]->url = Input::post("url", "");

			if($data["error"] == null){
				$data["reservation"]->save();

				if($data["reservation"]->status == 1){
					Model_Lessontime::sendReservedEMail($data["reservation"]->id);
				}

				Response::redirect("/admin/reservations/");
			}
		}

		$data["teachers"] = Model_User::find("all", [
			"where" => [
				["group_id", 10],
				["deleted_at", 0]
			],
			"order_by" => [
				["id", "desc"]
			]

		]);

		$data["students"] = Model_User::find("all", [
			"where" => [
				["group_id", 1],
				["deleted_at", 0]
			],
			"order_by" => [
				["id", "desc"]
			]

		]);


		$view = View::forge("admin/reservations/edit", $data);
		$this->template->content = $view;
	}
}
