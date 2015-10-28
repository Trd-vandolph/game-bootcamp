<?php

class Controller_Students_Lesson extends Controller_Students
{

	public function action_add()
	{
		if(Input::get("del_id", 0) != 0){
			$del_reserve = Model_Lessontime::find(Input::get("del_id", 0));
			if($del_reserve != null){
				if($del_reserve->student_id == $this->user->id){

					// send mail
					$body = View::forge("email/students/cancel_lesson");

					date_default_timezone_set(Config::get("timezone.timezone")[$del_reserve->student->timezone]);

					$body->set("name", $this->user->firstname);
					$body->set("reservation", $del_reserve);
					$sendmail = Email::forge("JIS");
					$sendmail->from(Config::get("statics.info_email"),Config::get("statics.info_name"));
					$sendmail->to($this->user->email);
					$sendmail->subject("Cancellation of Lesson / OliveCode");
					$sendmail->html_body(htmlspecialchars_decode($body));

					$sendmail->send();

					// send mail
					$body = View::forge("email/teachers/cancel_lesson");

					date_default_timezone_set(Config::get("timezone.timezone")[$del_reserve->teacher->timezone]);

					$body->set("name", $del_reserve->teacher->firstname);
					$body->set("reservation", $del_reserve);
					$sendmail = Email::forge("JIS");
					$sendmail->from(Config::get("statics.info_email"),Config::get("statics.info_name"));
					$sendmail->to($del_reserve->teacher->email);
					$sendmail->subject("Cancellation of Lesson / OliveCode");
					$sendmail->html_body(htmlspecialchars_decode($body));

					$sendmail->send();

					date_default_timezone_set(Config::get("timezone.timezone")[$this->user->timezone]);

					$del_reserve->student_id = 0;
					$del_reserve->status = 0;
					$del_reserve->save();
				}
			}
		}

		$reserved = Model_Lessontime::find("first", [
			"where" => [
				["student_id", $this->user->id],
				["status", 1],
				["deleted_at", 0],
			]
		]);

		$pasts = Model_Lessontime::find("all", [
			"where" => [
				["student_id", $this->user->id],
				["status", 2],
				["language", Input::get("course", 0)],
				["deleted_at", 0]
			]
		]);
		$lastClass = Model_Lessontime::find("last", [
			"where" => [
				["student_id", $this->user->id],
				["status", 2],
				["language", Input::get("course", 0)],
				["deleted_at", 0]
			]
		]);
		if($pasts == null){
			$pasts = [];
		}

		$data["studentplace"] = Model_User::find("all");

		$id = Input::get("id", 0);
		if($id != 0 and $reserved == null and($this->user->charge_html == 1 or Input::get("course", 0) == -1)){
			if(Model_Lessontime::courseNumber_1(Input::get("course", 0)) > count($pasts)){
				$reserve = Model_Lessontime::find($id);
				if($reserve != null){

					if($reserve->status == 0 and $reserve->student_id == 0){
						$reserve->student_id = $this->user->id;
						$reserve->language = Input::get("course", 0);
						$reserve->status = 1;
						$reserve->number = count($pasts) + 1;
						$reserve->history = $this->user->place;
						$reserve->save();

						Model_Lessontime::sendReservedEMail($reserve->id);

						$reserved = $reserve;
					}
				}
			}
		} elseif ($this->user->charge_html == 11 or Input::get("course", 0) == 0){
			if(Model_Lessontime::courseNumber_2(Input::get("course", 0)) > count($pasts)){
				$reserve = Model_Lessontime::find($id);
				if($reserve != null){

					if($reserve->status == 0 and $reserve->student_id == 0){
						$reserve->student_id = $this->user->id;
						$reserve->language = Input::get("course", 0);
						$reserve->status = 1;
						$reserve->number = count($pasts) + 1;
						$reserve->history = $this->user->place;
						$reserve->save();

						Model_Lessontime::sendReservedEMail($reserve->id);

						$reserved = $reserve;
					}
				}
			}
		} elseif ($this->user->charge_html == 111 or Input::get("course", 0) == 0){
			if(Model_Lessontime::courseNumber_3(Input::get("course", 0)) > count($pasts)){
				$reserve = Model_Lessontime::find($id);
				if($reserve != null){

					if($reserve->status == 0 and $reserve->student_id == 0){
						$reserve->student_id = $this->user->id;
						$reserve->language = Input::get("course", 0);
						$reserve->status = 1;
						$reserve->number = count($pasts) + 1;
						$reserve->history = $this->user->place;
						$reserve->save();

						Model_Lessontime::sendReservedEMail($reserve->id);

						$reserved = $reserve;
					}
				}
			}
		} elseif ($this->user->charge_html == 1111 or Input::get("course", 0) == 1){
			if(Model_Lessontime::courseNumber_4(Input::get("course", 0)) > count($pasts)){
				$reserve = Model_Lessontime::find($id);
				if($reserve != null){

					if($reserve->status == 0 and $reserve->student_id == 0){
						$reserve->student_id = $this->user->id;
						$reserve->language = Input::get("course", 0);
						$reserve->status = 1;
						$reserve->number = count($pasts) + 1;
						$reserve->history = $this->user->place;
						$reserve->save();

						Model_Lessontime::sendReservedEMail($reserve->id);

						$reserved = $reserve;
					}
				}
			}
		}
		$course_where = null;
		switch(Input::get("course", 0)){
			case -1:
				$course_where = ["trial", 1];
				break;
			default:
				$course_where = ["enchantJS", 1];
		}

		$data["lessons"] = Model_Lessontime::find("all", [
			"where" => [
				["deleted_at", 0],
				["student_id", 0],
				["status", 0],
				["freetime_at", ">=", time()],
				["freetime_at", "<", time() + 864000],
			],
			'related' => [
				'teacher' => [
					'where' => [
						['deleted_at', 0],
						$course_where
					],
				],
			],
			"order_by" => [
				["freetime_at", "asc"],
			]
		]);

		$data['status'] = Model_Lessontime::find("all", [
				"where" => [
						["student_id", $this->user->id],
						["deleted_at", 0],
						["status", 1],
				]
		]);

		$data["donetrial"] = Model_Lessontime::find("all", [
				"where" => [
						["student_id", $this->user->id],
						["status", 2],
						["language", Input::get("course", -1)],
						["deleted_at", 0]
				]
		]);

		$eventdetails = Model_Events::find("all", [
				"where" => [
						["deleted_at", 0],
				]
		]);

		if(Input::post("place", null) !== null and Security::check_token()){

			$this->user->place = Input::post("place", 1);

			$this->user->save();
		}

		$data['eventdetails'] = $eventdetails;
		$data["pasts"] = $pasts;
		$data["lastClass"] = $lastClass;
		$data["reserved"] = $reserved;
		$data["user"] = $this->user;
		$data["course"] = Input::get("course", 0);

		$view = View::forge("students/lesson/add", $data);
		$this->template->content = $view;
	}

	public function action_histories(){

		$data['pasts'] = Model_Lessontime::find("all", [
				"where" => [
						["student_id", $this->user->id],
						["status", 2],
						["language", Input::get("course", 0)],
						["deleted_at", 0]
				]
		]);

		$data["donetrial"] = Model_Lessontime::find("all", [
				"where" => [
						["student_id", $this->user->id],
						["status", 2],
						["language", Input::get("course", -1)],
						["deleted_at", 0]
				]
		]);

		$data["reservations"] = Model_Lessontime::find("all", [
			"where" => [
				["deleted_at", 0],
				["student_id", $this->user->id],
				["status", "<>", 0],
				["freetime_at", "<", time()],
			],
			"order_by" => [
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


		$data["user"] = $this->user;
		$view = View::forge("students/lesson/histories", $data);
		$this->template->content = $view;
	}
}
