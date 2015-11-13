<?php

class Controller_Admin_Mail extends Controller_Admin
{
	private $fields = array('for_all','for_students','for_teachers','title','body','status');

	public function before(){

		parent::before();

	}

	public function action_index()
	{

		$is_chenged = false;

		$where = [["deleted_at", 0]];

		$data["mail"] = Model_Mail::find("all", [
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
				'total_items'=>count($data["mail"]),
		);

		$data["pager"] = Pagination::forge('mypagination', $config);

		$data["mail"] = array_slice($data["mail"], $data["pager"]->offset, $data["pager"]->per_page);

		$view = View::forge("admin/mail/index", $data);
		$this->template->content = $view;


	}

	public function action_edit($id = 0)
	{
		//saving draft
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

			$data["mail"] = Model_Mail::find($id);

			if($data["mail"] == null){
				$data["mail"] = Model_mail::forge();
			}

			// add
			if(Session::get_flash('title') != null and Security::check_token()){

				// save
				$mail = $data["mail"];
				$mail->for_all = Session::get_flash("for_all", 0);
				$mail->for_teachers = Session::get_flash("for_teachers", 0);
				$mail->for_students = Session::get_flash("for_students", 0);
				$mail->title = Session::get_flash("title");
				$mail->body = Session::get_flash("body");
				$mail->status = Session::get_flash("status");

				if($mail->for_all == null){
					$mail->for_all = 0;
				}

				if($mail->for_students == null){
					$mail->for_students = 0;
				}

				if($mail->for_teachers == null){
					$mail->for_teachers = 0;
				}

				$mail->save();

				$body = View::forge("email/mail");
				$body->set("title", $mail->title);
				$body->set("body", $mail->body);

				//saving draft all start
				if($mail->for_all == 1){
					$teachers = Model_User::find("all", [
							"where" => [
									["group_id", 10],
									["deleted_at", 0],
							],
							"order_by" => [
									["id", "desc"]
							]

					]);

					$students = Model_User::find("all", [
							"where" => [
									["group_id", 1],
									["deleted_at", 0],
							],
							"order_by" => [
									["id", "desc"]
							]

					]);

					Response::redirect("/admin/mail");

				}//saving draft all end

				//saving draft to enabled teachers start
				if($mail->for_teachers == 1){
					$teachers = Model_User::find("all", [
							"where" => [
									["group_id", 10],
									["deleted_at", 0],
									["need_news_email", 1]
							],
							"order_by" => [
									["id", "desc"]
							]

					]);

				}//saving draft to enabled teachers end

				//saving draft to enabled students start
				if($mail->for_students == 1){
					$students = Model_User::find("all", [
							"where" => [
									["group_id", 1],
									["deleted_at", 0],
									["need_news_email", 1]
							],
							"order_by" => [
									["id", "desc"]
							]

					]);

				}//saving draft to enabled students end

				Response::redirect("/admin/mail");
			}

			$view = View::forge("admin/mail/edit", $data);
			$this->template->content = $view;
		}

		//sending email
		if(Input::post('action') == 'confirm'){
			foreach($this->fields as $field){
				Session::set_flash($field, Input::post($field));
			}

			$data = array();
			foreach ($this->fields as $field)
			{
				$data[$field] = Session::get_flash($field);
				Session::keep_flash($field);
			}

			$this->template->content = View::forge('admin/mail/confirm',$data);
		}else{

			$data["mail"] = Model_Mail::find($id);

			if($data["mail"] == null){
				$data["mail"] = Model_mail::forge();
			}

			// add
			if(Session::get_flash('title') != null and Security::check_token()){

				// save
				$mail = $data["mail"];
				$mail->for_all = Session::get_flash("for_all", 0);
				$mail->for_teachers = Session::get_flash("for_teachers", 0);
				$mail->for_students = Session::get_flash("for_students", 0);
				$mail->title = Session::get_flash("title");
				$mail->body = Session::get_flash("body");
				$mail->status = Session::get_flash("status");

				if($mail->for_all == null){
					$mail->for_all = 0;
				}

				if($mail->for_students == null){
					$mail->for_students = 0;
				}

				if($mail->for_teachers == null){
					$mail->for_teachers = 0;
				}

				$mail->save();

				$body = View::forge("email/mail");
				$body->set("title", $mail->title);
				$body->set("body", $mail->body);

				//sending all start
				if($mail->for_all == 1){
					$teachers = Model_User::find("all", [
							"where" => [
									["group_id", 10],
									["deleted_at", 0],
							],
							"order_by" => [
									["id", "desc"]
							]

					]);
					foreach($teachers as $teacher){
						$sendmail = Email::forge("JIS");
						$sendmail->from(Config::get("statics.info_email"),Config::get("statics.info_name"));
						$sendmail->to($teacher->email);
						$sendmail->subject("{$mail->title} / Game-bootcamp");
						$sendmail->html_body("Dear {$teacher->firstname},<br><br>". htmlspecialchars_decode($body) . "If you are no longer interested, you can " . "<a href=". Uri::base() ."?" . md5('id') . "={$teacher->id}/unsubscribe=" . md5($teacher->email) .">Unsubscribe.</a>");

						$sendmail->send();
					}

					$students = Model_User::find("all", [
							"where" => [
									["group_id", 1],
									["deleted_at", 0],
							],
							"order_by" => [
									["id", "desc"]
							]

					]);
					foreach($students as $student){
						$sendmail = Email::forge("JIS");
						$sendmail->from(Config::get("statics.info_email"),Config::get("statics.info_name"));
						$sendmail->to($student->email);
						$sendmail->subject("{$mail->title} / Game-bootcamp");
						$sendmail->html_body("Dear {$student->firstname},<br><br>". htmlspecialchars_decode($body) . "If you are no longer interested, you can " . "<a href=". Uri::base() . "?" . md5('id') . "={$student->id}/unsubscribe=" . md5($student->email) .">Unsubscribe.</a>");

						$sendmail->send();
					}

					Response::redirect("/admin/mail/sent");

				}//sending all end

				//sending to enabled teachers start
				if($mail->for_teachers == 1){
					$teachers = Model_User::find("all", [
						"where" => [
							["group_id", 10],
							["deleted_at", 0],
							["need_news_email", 1]
						],
						"order_by" => [
							["id", "desc"]
						]

					]);
					foreach($teachers as $teacher){
						$sendmail = Email::forge("JIS");
						$sendmail->from(Config::get("statics.info_email"),Config::get("statics.info_name"));
						$sendmail->to($teacher->email);
						$sendmail->subject("{$mail->title} / Game-bootcamp");
						$sendmail->html_body("Dear {$teacher->firstname},<br><br>". htmlspecialchars_decode($body) . "If you are no longer interested, you can " . "<a href=". Uri::base() . "?" . md5('id') . "={$teacher->id}/unsubscribe=" . md5($teacher->email) .">Unsubscribe.</a>");

						$sendmail->send();
					}
				}//sending to enabled teachers end

				//sending to enabled students start
				if($mail->for_students == 1){
					$students = Model_User::find("all", [
						"where" => [
							["group_id", 1],
							["deleted_at", 0],
							["need_news_email", 1]
						],
						"order_by" => [
							["id", "desc"]
						]

					]);
					foreach($students as $student){
						$sendmail = Email::forge("JIS");
						$sendmail->from(Config::get("statics.info_email"),Config::get("statics.info_name"));
						$sendmail->to($student->email);
						$sendmail->subject("{$mail->title} / Game-bootcamp");
						$sendmail->html_body("Dear {$student->firstname},<br><br>". htmlspecialchars_decode($body) . "If you are no longer interested, you can " . "<a href=". Uri::base() . "?" . md5('id') . "={$student->id}/unsubscribe=" . md5($student->email) .">Unsubscribe.</a>");

						$sendmail->send();
					}
				}//sending to enabled students end

				Response::redirect("/admin/mail/sent");

			}

			$view = View::forge("admin/mail/edit", $data);
			$this->template->content = $view;
		}
	}

	public function action_message($id){
		$data["mail"] = Model_mail::find($id, [
			"where" => [
							[
								["deleted_at", 0],
								["for_teachers", 1]
							]
						],
		]);

		$data["mail"] = Model_mail::find($id, [
			"where" => [
							[
								["deleted_at", 0],
								["for_students", 1]
							]
			],
		]);

		$data["mail"] = Model_mail::find($id, [
				"where" => [
						[
								["deleted_at", 0],
								["for_all", 1]
						]
				],
		]);

		if($data["mail"] == null){
			Response::redirect("admin/mail");
		}

		$is_read = Model_Readmail::find("first", [
			"where" => [
				["user_id" => $this->user->id],
				["mail_id" => $id]
			]
		]);

		if($is_read == null){
			$is_read = Model_Readmail::forge();
			$is_read->user_id = $this->user->id;
			$is_read->mail_id = $id;
			$is_read->save();
		}

		$data["user"] = $this->user;

		$view = View::forge("admin/mail/message", $data);
		$this->template->content = $view;
	}

	public function action_sent()
	{
		$view = View::forge("admin/mail/sent");
		$this->template->content = $view;
	}
}
