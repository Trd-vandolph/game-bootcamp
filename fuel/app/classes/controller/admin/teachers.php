<?php

class Controller_Admin_Teachers extends Controller_Admin
{

	public function before(){

		parent::before();

	}

	public function action_index()
	{

		$where = [["group_id", 10],["deleted_at", 0]];

		$search_text = Input::get("search_text", "");
		if($search_text != ""){
			array_push($where, ["email", "like", "%{$search_text}%"]);
		}

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

		$view = View::forge("admin/teachers/index", $data);
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
					Auth::create_user($email, $password, $email,10);

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
				$user->pr = Input::post("pr", "");
				$user->educational_background = Input::post("educational_background", "");

				$user->php = Input::post("php", 0);
				$user->html5 = Input::post("html5", 0);
				$user->javascript = Input::post("javascript", 0);
				$user->trial = Input::post("trial", 0);

				$user->type = Input::post("type", 0);
				$user->save();

				$user->bank->name = Input::post("bank_name", "");
				$user->bank->branch = Input::post("bank_branch", "");
				$user->bank->account = Input::post("bank_account", "");
				$user->bank->number = Input::post("bank_number", "");
				$user->bank->etc = Input::post("bank_etc", "");
				$user->bank->type = Input::post("bank_type", 0);
				$user->bank->save();

				Response::redirect("/admin/teachers");
			}
		}

		if($user == null){
			$user = Model_User::forge();
		}

		$data["user"] = $user;

		$view = View::forge("admin/teachers/add", $data);
		$this->template->content = $view;
	}

	public function action_detail($id = 0)
	{
		$user = Model_User::find($id);

		if($user == null){
			Response::redirect("/admin/teachers");
		}

		$data["user"] = $user;
		if($user->bank == null){
			$user->bank = Model_Bank::forge();
			$user->bank->user_id = $user->id;
			$user->bank->save();
		}

		$view = View::forge("admin/teachers/detail", $data);
		$this->template->content = $view;
	}

	public function action_changepassword($id = 0)
	{
		$user = Model_User::find($id);

		if($user == null){
			Response::redirect("/admin/teachers");
		}

		if(Input::post("password", null) != null and Security::check_token()){
			$user->password = Auth::instance()->hash_password(Input::post('password', ""));
			$user->save();
			Response::redirect("/admin/teachers");
		}

		$view = View::forge("admin/teachers/changepassword");
		$this->template->content = $view;
	}
}