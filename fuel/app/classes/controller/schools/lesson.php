<?php

class Controller_Schools_Lesson extends Controller_Schools
{

	public function action_add()
	{
		//Cancellation ************************************************************************************************
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
					$sendmail->subject("Cancellation of Lesson / Game-bootcamp");
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
					$sendmail->subject("Cancellation of Lesson / Game-bootcamp");
					$sendmail->html_body(htmlspecialchars_decode($body));

					$sendmail->send();

					date_default_timezone_set(Config::get("timezone.timezone")[$this->user->timezone]);

					$del_reserve->student_id = 0;
					$del_reserve->status = 0;
					$del_reserve->save();

					//cancel booking for shared db (set the status to 0) and send data to shared db
					$query = DB::update('reservation')->value('status', 0)->where('student_id', $this->user->id)->where('edoo_tutor', $del_reserve->teacher->email)->where('freetime_at', $del_reserve->freetime_at)->execute('shared');
				}
			}

		}
		//End Cancellation ********************************************************************************************

		//Booking *****************************************************************************************************

		$class_id = Input::get("class", 0);

//		$stID = Model_Classroom::find($class_id);
//		$studID = $stID->students_id;
//
//		$studIDS = explode(",", $studID);
//
//		$countStud = count($studIDS);

		$reserved = Model_Lessontime::find("first", [
			"where" => [
				["student_id", $class_id],
				["status", 1],
				["deleted_at", 0],
			]
		]);
		$pasts = Model_Lessontime::find("all", [
			"where" => [
				["student_id", $class_id],
				["status", 2],
				["language", Input::get("course", 0)],
				["deleted_at", 0]
			]
		]);
		$lastClass = Model_Lessontime::find("last", [
			"where" => [
				["student_id", $class_id],
				["status", 2],
				["language", Input::get("course", 0)],
				["deleted_at", 0]
			]
		]);

		$id = Input::get("id", 0);

		if($id !=0 and $reserved == null){
			if(Model_Lessontime::courseNumber_1(Input::get("course", 0)) > count($pasts)){
				$reserve = Model_Lessontime::find($id);
				if($reserve != null) {
					if($reserve->status == 0 and $reserve->student_id == 0){
						$reserve->student_id = $class_id;
						$reserve->language = Input::get("course", 0);
						$reserve->status = 1;
						$reserve->for_group = 1;
						$reserve->number = count($pasts) + 1;
						$reserve->save();

						$check_exist = DB::select()->from('reservation')->where('student_email', $this->user->email)->where('edoo_tutor', $reserve->teacher->email)->execute('shared'); //select from shared database
						if (count($check_exist) == 1) {
							$query = DB::update('reservation')->set(array(
								'student_id' => $this->user->id,
								'status' => 1,
								'freetime_at' => $reserve->freetime_at,
							))->where('student_email', $this->user->email)->where('edoo_tutor', $reserve->teacher->email)->execute('shared');
						} else {
							$query = DB::insert('reservation')->columns(array('student_id', 'student_email', 'edoo_tutor', 'freetime_at', 'status', ));
							$query->values(array( $this->user->id, $this->user->email, $reserve->teacher->email, $reserve->freetime_at, 1, ))->execute('shared');
						}
					}
				}
			}
		}

		//End Booking *************************************************************************************************

		$course_where = null;
		switch(Input::get("course", 0)){
			case -1:
				$course_where = ["trial", 1];
				break;
			default:
				$course_where = ["enchantJS", 1];
		}

		//Data Needed *************************************************************************************************

		$data["studentplace"] = Model_User::find("all");
		$data["user"] = $this->user;
		$data["reserved"] = $reserved;
		$data["pasts"] = $pasts;
		$data["lastClass"] = $lastClass;

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

		$data["eventdetails"] = Model_Events::find("all", [
			"where" => [
				["deleted_at", 0],
			]
		]);

		//End Data Needed *********************************************************************************************


		$view = View::forge("schools/lesson/add", $data);
		$this->template->content = $view;
	}

	public function action_histories()
	{
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

		$data["class"] = Model_Classroom::find("all", [
			"where" => [
				["deleted_at", 0],
				["school_id", $this->user->id]
			]
		]);

		$count = array();

		foreach($data["class"] as $class) {
			$reservations = Model_Lessontime::find("all", [
				"where" => [
					["deleted_at", 0],
					["student_id", $class->id],
					["status", "<>", 0],
					["freetime_at", "<", time()],
				],
				"order_by" => [
					["updated_at", "desc"],
				]
			]);
			foreach($reservations as $reserve) {
				array_push($count, $reserve->student_id);
			}
		}

		$config=array(
			'pagination_url'=>"",
			'uri_segment'=>"p",
			'num_links'=>9,
			'per_page'=>20,
			'total_items'=>count($count),
		);

		$data["pager"] = Pagination::forge('mypagination', $config);

		$data["user"] = $this->user;
		$view = View::forge("schools/lesson/histories", $data);
		$this->template->content = $view;

	}

}
