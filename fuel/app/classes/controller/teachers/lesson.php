<?php

class Controller_Teachers_Lesson extends Controller_Teachers
{

	public function action_add()
	{

		// add
		if(Input::post("year", null) != null and Security::check_token()){

			// save
			$reservation = Model_Lessontime::forge();
			$reservation->teacher_id = $this->user->id;
			$reservation->edoo_tutor = $this->user->google_account;
			$reservation->student_id = 0;
			$reservation->status = 0;
			$reservation->freetime_at = strtotime(Input::post("year", 0)
				. "-" .Input::post("month", 0)
				. "-" .Input::post("day", 0)
				. " " .Input::post("hour", 0) . ":00:00");
			$reservation->save();
		}


		$data["reservations"] = Model_Lessontime::find("all", [
			"where" => [
				["deleted_at", 0],
				["teacher_id", $this->user->id],
				["freetime_at", ">=", time()],
				//["status", 0],
			],
			"order_by" => [
				["id", "desc"],
			]
		]);

		$view = View::forge("teachers/lesson/add", $data);
		$this->template->content = $view;
	}

	public function action_histories(){

		if(Input::get("del_id", 0) != 0){
			$reservation = Model_Lessontime::find("first", [
				"where" => [
					["teacher_id", $this->user->id],
					["status", 1],
					["deleted_at", 0]
				]
			]);

			if($reservation != null){
				$reservation->deleted_at = time();
				$reservation->save();
			}
		}

		$data["reservations"] = Model_Lessontime::find("all", [
			"where" => [
				["deleted_at", 0],
				["teacher_id", $this->user->id],
				["status", "<>", 0],
				["status", "<>", 3],
				["freetime_at", "<", time()]
			],
			"order_by" => [
				//["id", "desc"],
				["updated_at", "desc"],
			]
		]);

		$config=array(
			'pagination_url'=>"",
			'uri_segment'=>"p",
			'num_links'=>9,
			'per_page'=>20,
			'total_items'=>count($data["reservations"]),
		);

		$data["pager"] = Pagination::forge('mypagination', $config);

		$data["reservations"] = array_slice($data["reservations"], $data["pager"]->offset, $data["pager"]->per_page);

		$view = View::forge("teachers/lesson/histories", $data);
		$this->template->content = $view;
	}

	public function action_reserved(){

		$data["reservations"] = Model_Lessontime::find("all", [
			"where" => [
				["deleted_at", 0],
				["teacher_id", $this->user->id],
				["status", "<>", 0],
				["status", "<>", 3],
				["freetime_at", ">=", time()]
			],
			"order_by" => [
				["id", "desc"],
			]
		]);

		$config=array(
			'pagination_url'=>"",
			'uri_segment'=>"p",
			'num_links'=>9,
			'per_page'=>20,
			'total_items'=>count($data["reservations"]),
		);

		$data["pager"] = Pagination::forge('mypagination', $config);


		$view = View::forge("teachers/lesson/reserved", $data);
		$this->template->content = $view;
	}

	public function action_edit($id = 0)
	{

		$data["reservation"] = Model_Lessontime::find($id);

		if($data["reservation"] == null){
			Response::redirect("_404_");
		}

		// add
		if($data["reservation"]->teacher_id == $this->user->id and Input::post("url", null) != null and Security::check_token()){


			$data["reservation"]->url = Input::post("url", "");

			$data["reservation"]->save();

			Response::redirect("/teachers/lesson/reserved");
		}




		$view = View::forge("teachers/lesson/edit", $data);
		$this->template->content = $view;
	}

	public function action_feedback($id = 0)
	{

		$data["reservation"] = Model_Lessontime::find($id);

		if($data["reservation"] == null){
			Response::redirect("_404_");
		}

		if($data["reservation"]->status != 1){
			Response::redirect("_404_");
		}

		// add
		if($data["reservation"]->teacher_id == $this->user->id and Input::post("feedback", null) != null and Security::check_token()){


			$data["reservation"]->feedback = Input::post("feedback", "");
			$data["reservation"]->status = 2;
			$data["reservation"]->save();

			$query = DB::update('reservation')->set(array(
				'status' => 2,
			))
			->where('edoo_tutor', $data["reservation"]->edoo_tutor)
			->where('freetime_at', $data["reservation"]->freetime_at)
			->where('student_id', $data["reservation"]->student_id)
			->execute('shared');

			Response::redirect("/teachers/lesson/histories");
		}




		$view = View::forge("teachers/lesson/feedback", $data);
		$this->template->content = $view;
	}
}
