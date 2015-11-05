<?php

class Controller_Teachers_Profile extends Controller_Teachers
{

	public function before(){

		parent::before();

	}

	public function action_index()
	{
		$is_chenged = false;

		if($this->user->bank == null){
			$this->user->bank = Model_Bank::forge();
			$this->user->bank->user_id = $this->user->id;
			$this->user->bank->save();
		}

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
				$this->user->pr = Input::post("pr", "");
				$this->user->educational_background = Input::post("educational_background", "");
				$this->user->enchantJS = Input::post("enchantJS", 0);
				$this->user->trial = Input::post("trial", 0);
				$this->user->save();
				$this->user->bank->name = Input::post("bank_name", "");
				$this->user->bank->branch = Input::post("bank_branch", "");
				$this->user->bank->account = Input::post("bank_account", "");
				$this->user->bank->number = Input::post("bank_number", "");
				$this->user->bank->etc = Input::post("bank_etc", "");
				$this->user->bank->type = Input::post("bank_type", 0);
				$this->user->bank->save();
				$is_chenged = true;
			}
		}

		$data["user"] = $this->user;
		$data["is_chenged"] = $is_chenged;
		$view = View::forge("teachers/profile",$data);
		$this->template->content = $view;
	}
}
