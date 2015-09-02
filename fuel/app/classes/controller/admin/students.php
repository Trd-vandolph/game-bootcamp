<?php

class Controller_Admin_Students extends Controller_Admin
{

	public function before(){

		parent::before();

	}

	public function action_index()
	{

		$where = [["group_id", 1],["deleted_at", 0],["category", 1]];

		$query = Model_User::query()
	    ->where('group_id', '=', 1)
	    ->where('deleted_at', '=', 0)
		->where('category', '=', 1);

		if($search_text = Input::get("search_text", ""))
		{
			$query
				->where_open()
					->where('email', 'like', "%{$search_text}%")
					->or_where('firstname', 'like', "%{$search_text}%")
					->or_where('middlename', 'like', "%{$search_text}%")
					->or_where('lastname', 'like', "%{$search_text}%")
					->or_where('lastname', 'like', "%{$search_text}%")
					->or_where(DB::expr("CONCAT(trim(firstname),' ',trim(middlename))"), 'like', "%{$search_text}%")
					->or_where(DB::expr("CONCAT(trim(middlename),' ',trim(firstname))"), 'like', "%{$search_text}%")
					->or_where(DB::expr("CONCAT(trim(firstname),' ',trim(lastname))"), 'like', "%{$search_text}%")
					->or_where(DB::expr("CONCAT(trim(lastname),' ',trim(firstname))"), 'like', "%{$search_text}%")
					->or_where(DB::expr("CONCAT(trim(middlename),' ',trim(lastname))"), 'like', "%{$search_text}%")
					->or_where(DB::expr("CONCAT(trim(lastname),' ',trim(middlename))"), 'like', "%{$search_text}%")
					->or_where(DB::expr("CONCAT(trim(firstname),' ',trim(middlename),' ',trim(lastname))"), 'like', "%{$search_text}%")
					->or_where(DB::expr("CONCAT(trim(lastname),' ',trim(middlename),' ',trim(firstname))"), 'like', "%{$search_text}%")
					->or_where(DB::expr("CONCAT(trim(lastname),' ',trim(firstname),' ',trim(middlename))"), 'like', "%{$search_text}%")
					->order_by("id", "desc")
				->where_close();
		}

		$data["result"] = $query->get();

		$data["users"] = Model_User::find("all", [
			"where" => $where,
			"order_by" => [
				["id", "desc"]
			]

		]);

		Input::get("search_text", "") ? $pages = 'result' : $pages = 'users';

		$config=array(
			'pagination_url'=>"?search_text=".Input::get("search_text", ""),
			'uri_segment'=>"p",
			'num_links'=>9,
			'per_page'=>20,
			'total_items'=>count($data[$pages]),
		);

		$data["pager"] = Pagination::forge('mypagination', $config);

		$data[$pages] = array_slice($data[$pages], $data["pager"]->offset, $data["pager"]->per_page);

		$view = View::forge("admin/students/index", $data);
		$this->template->content = $view;
	}

	public function action_grameen()
	{

		$where = [["group_id", 1],["deleted_at", 0],["place", 1]];

		$data["users"] = Model_User::find("all", [
				"where" => $where,
				"order_by" => [
						["id", "desc"]
				]

		]);

		$config=array(
				'pagination_url'=>"?search_text=".Input::get("search_text", ""),
				'uri_segment'=>"p",
				'num_links'=>9,
				'per_page'=>20,
				'total_items'=>count($data["users"]),
		);

		$data["pager"] = Pagination::forge('mypagination', $config);

		$data["users"] = array_slice($data["users"], $data["pager"]->offset, $data["pager"]->per_page);

		$view = View::forge("admin/students/grameen", $data);
		$this->template->content = $view;
	}

	public function action_paid()
	{

		$where = [["group_id", 1],["deleted_at", 0],["charge_html", "!=", 0]];

		$data["users"] = Model_User::find("all", [
				"where" => $where,
				"order_by" => [
						["id", "desc"]
				]

		]);

		$config=array(
				'pagination_url'=>"?search_text=".Input::get("search_text", ""),
				'uri_segment'=>"p",
				'num_links'=>9,
				'per_page'=>20,
				'total_items'=>count($data["users"]),
		);

		$data["pager"] = Pagination::forge('mypagination', $config);

		$data["users"] = array_slice($data["users"], $data["pager"]->offset, $data["pager"]->per_page);

		$view = View::forge("admin/students/paid", $data);
		$this->template->content = $view;
	}
	public function action_trial()
	{

		$where = [["group_id", 1],["deleted_at", 0],["charge_html", 0]];
		$trial_where = [["status", 2],["deleted_at",0], ["language", -1],["number", 1]];

		$data["users"] = Model_User::find("all", [
				"where" => $where,
				"order_by" => [
						["id", "desc"]
				]
		]);

		$data["lessons"] = Model_Lessontime::find("all", [
				"where" => $trial_where,
				"order_by" => [
						["id", "desc"]
				]
		]);

		$config=array(
				'pagination_url'=>"?search_text=".Input::get("search_text", ""),
				'uri_segment'=>"p",
				'num_links'=>9,
				'per_page'=>10,
				'total_items'=>count($data["lessons"]),
		);

		$data["pager"] = Pagination::forge('mypagination', $config);

		$data["lessons"] = array_slice($data["lessons"], $data["pager"]->offset, $data["pager"]->per_page);

		$view = View::forge("admin/students/trial", $data);
		$this->template->content = $view;
	}

	public function action_add()
	{
		$id = Input::get("id", 0);

		$user = Model_User::find($id);


		//add or edit
		if(Input::post("firstname", null) != null and Security::check_token()){
			if($user == null){
				$email = Input::post("email", null);
				$password = Input::post("password", null);

				try{
					Auth::create_user($email, $password, $email,1);

					$user = Model_User::find("first", [
						"where" => [
							["email" => $email]
						]
					]);

				}catch(Exception $e){
					$data["error"] = "This email is already in use.";
				}

			}else{
				$email = Input::post("email", null);

				if($email != $user->email){
					$check_user = Model_User::find("first", [
						"where" => [
							["email" => $email]
						]
					]);

					if($check_user == null){
						$user->email = $email;
					}else{
						$data["error"] = "This email is already in use.";
					}
				}
			}

			$config = [
				"path" => DOCROOT."assets/img/pictures/",
				'randomize' => true,
				'auto_rename'    => true,
				'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
			];
			Upload::process($config);

			if (Upload::is_valid())
			{
				Upload::save();
				$saved_result = Upload::get_files();
				$file_name = $saved_result[0]['saved_as'];

				$image = Image::load($config["path"].$file_name);
				$image->crop_resize(200,200)->save($config["path"]."m_".$file_name);
				$image->crop_resize(86,86)->save($config["path"]."s_".$file_name);

				$user->img_path = $file_name;
			}else{
				$error = Upload::get_errors();
			}

			if(!isset($data["error"])){

				$user->firstname = Input::post("firstname", "");
				$user->middlename = Input::post("middlename", "");
				$user->lastname = Input::post("lastname", "");
				$user->google_account = Input::post("google_account", "");
				$user->sex = Input::post("sex", 0);
				$user->need_reservation_email = Input::post("need_reservation_email", 1);
				$user->need_news_email = Input::post("need_news_email", 1);
				$user->birthday = Input::post("year", 0) . "-" . Input::post("month", 0) . "-" . Input::post("day", 0);
				$user->timezone = Input::post("timezone", "");
				$user->place = Input::post("place", "");
				$user->grameen_student = Input::post("grameen_student", "");
				$user->save();

				Response::redirect("/admin/students");
			}
		}

		if($user == null){
			$user = Model_User::forge();
		}

		$data["user"] = $user;

		$view = View::forge("admin/students/add", $data);
		$this->template->content = $view;
	}

	public function action_detail($id = 0)
	{
		$user = Model_User::find($id);

		if($user == null){
			Response::redirect("/admin/students");
		}

		$data["user"] = $user;

		$data["reservations"] = Model_Lessontime::find("all", [
			"where" => [
				["deleted_at", 0],
				["student_id", $user->id],
				["status", "<>", 0],
				["freetime_at", "<", time()],
			],
			"order_by" => [
				["updated_at", "desc"],
			]
		]);

		$view = View::forge("admin/students/detail", $data);
		$this->template->content = $view;
	}

	public function action_changepassword($id = 0)
	{
		$user = Model_User::find($id);

		if($user == null){
			Response::redirect("/admin/students");
		}

		if(Input::post("password", null) != null and Security::check_token()){
			$user->password = Auth::instance()->hash_password(Input::post('password', ""));
			$user->save();
			Response::redirect("/admin/students");
		}

		$view = View::forge("admin/students/changepassword");
		$this->template->content = $view;
	}
}
