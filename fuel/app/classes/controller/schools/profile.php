<?php

class Controller_Students_Profile extends Controller_Students
{

	public function before(){

		parent::before();

	}

	public function action_index()
	{
		$is_chenged = false;

		if(Input::post("firstname", null) != null and Security::check_token()){

			$email = Input::post("email", null);

			if($email != $this->user->email){
				$check_user = Model_User::find("first", [
					"where" => [
						["email" => $email]
					]
				]);

				if($check_user == null){
					$this->email = $email;
				}else{
					$data["error"] = "This email is already in use.";
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

				$this->user->img_path = $file_name;
			}else{
				$error = Upload::get_errors();
			}

			if(!isset($data["error"])){
				$this->user->firstname = Input::post("firstname", "");
				$this->user->middlename = Input::post("middlename", "");
				$this->user->lastname = Input::post("lastname", "");
				$this->user->google_account = Input::post("google_account", "");

				$this->user->save();

				$is_chenged = true;
			}
		}
		
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

		$data["user"] = $this->user;
		$data["is_chenged"] = $is_chenged;

		$view = View::forge("students/profile",$data);
		$this->template->content = $view;
	}
}