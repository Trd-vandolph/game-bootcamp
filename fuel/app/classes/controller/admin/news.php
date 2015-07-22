<?php

class Controller_Admin_News extends Controller_Admin
{
	private $fields = array('for_students','for_teachers','title','body');

	public function before(){

		parent::before();

	}

	public function action_index()
	{

		$where = [["deleted_at", 0]];

		$data["news"] = Model_News::find("all", [
			"where" => $where,
			"order_by" => [
				["id", "desc"],
			]
		]);

		$config=array(
			'pagination_url'=>"?",
			'uri_segment'=>"p",
			'num_links'=>9,
			'per_page'=>20,
			'total_items'=>count($data["news"]),
		);

		$data["pager"] = Pagination::forge('mypagination', $config);

		$data["news"] = array_slice($data["news"], $data["pager"]->offset, $data["pager"]->per_page);

		$view = View::forge("admin/news/index", $data);
		$this->template->content = $view;
	}

	public function action_edit($id = 0)
	{
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

			$this->template->content = View::forge('admin/news/confirm',$data);
		}else{

			$data["news"] = Model_News::find($id);

			if($data["news"] == null){
				$data["news"] = Model_News::forge();
			}

			// add
			if(Session::get_flash('title') != null and Security::check_token()){

				// save
				$news = $data["news"];
				$news->for_teachers = Session::get_flash("for_teachers", 0);
				$news->for_students = Session::get_flash("for_students", 0);
				$news->title = Session::get_flash("title");
				$news->body = Session::get_flash("body");

				if($news->for_students == null){
					$news->for_students = 0;
				}

				if($news->for_teachers == null){
					$news->for_teachers = 0;
				}

				$news->save();

				$body = View::forge("email/news");
				$body->set("title", $news->title);
				$body->set("body", $news->body);

				if($news->for_teachers == 1){
					$teachers = Model_User::find("all", [
						"where" => [
							["group_id", 10],
							["deleted_at", 0]
						],
						"order_by" => [
							["id", "desc"]
						]

					]);
					foreach($teachers as $teacher){
						$sendmail = Email::forge("JIS");
						$sendmail->from(Config::get("statics.info_email"),Config::get("statics.info_name"));
						$sendmail->to($teacher->email);
						$sendmail->subject("{$news->title} / OliveCode");
						$sendmail->html_body("Dear {$teacher->firstname},<br><br>". htmlspecialchars_decode($body) . "If you are no longer interested, you can " . "<a href=". Uri::base() . "?" . md5('id') . "={$teacher->id}/unsubscribe=" . md5($teacher->email) .">Unsubscribe.</a>");

						$sendmail->send();
					}
				}

				if($news->for_students == 1){
					$students = Model_User::find("all", [
						"where" => [
							["group_id", 1],
							["deleted_at", 0]
						],
						"order_by" => [
							["id", "desc"]
						]

					]);
					foreach($students as $student){
						$sendmail = Email::forge("JIS");
						$sendmail->from(Config::get("statics.info_email"),Config::get("statics.info_name"));
						$sendmail->to($student->email);
						$sendmail->subject("{$news->title} / OliveCode");
						$sendmail->html_body("Dear {$student->firstname},<br><br>". htmlspecialchars_decode($body) . "If you are no longer interested, you can " . "<a href=". Uri::base() . "?" . md5('id') . "={$student->id}/unsubscribe=" . md5($student->email) .">Unsubscribe.</a>");

						$sendmail->send();
					}
				}

				Response::redirect("/admin/news/");
			}


			$view = View::forge("admin/news/edit", $data);
			$this->template->content = $view;
		}
	}
}