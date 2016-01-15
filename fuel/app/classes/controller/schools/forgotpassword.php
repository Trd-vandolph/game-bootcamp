<?php

class Controller_School_Forgotpassword extends Controller_Base
{

	public function action_index()
	{
		$this->template = View::forge("schools/template");
		$this->template->title = "Forgotpassword";
		$this->template->auth_status = false;

		// login
		if(Input::post("email", null) !== null and Security::check_token()){

			$email = Input::post('email', null);

			$user = Model_User::find("first", [
				"where" => [
					["email", $email]
				]
			]);

			if($user != null){

				$token = Model_Forgotpasswordtoken::forge();
				$token->user_id = $user->id;
				$token->token = sha1("asadsada23424{$user->email}".time());
				$token->save();

				$url = Uri::base()."schools/forgotpassword/form/{$token->token}";

				$body = View::forge("email/forgotpassword",["url" => $url]);
				$sendmail = Email::forge("JIS");
				$sendmail->from(Config::get("statics.info_email"),Config::get("statics.info_name"));
				$sendmail->to($email);
				$sendmail->subject("forgot password");
				$sendmail->html_body(htmlspecialchars_decode($body));

				$sendmail->send();

			}

			$view = View::forge("schools/forgotpassword/sent");
			$this->template->content = $view;

		}else{
			$view = View::forge("schools/forgotpassword/index");
			$this->template->content = $view;
		}
	}

	public function action_form($token = null)
	{
		$this->template = View::forge("schools/template");
		$this->template->title = "Forgotpassword";
		$this->template->auth_status = false;

		$token = Model_Forgotpasswordtoken::find("first", [
			"where" => [
				["token", $token],
			]
		]);

		if($token != null){
			if($token->user->group_id == 1 and time() - $token->created_at < 3600){
				if(Input::post("password", null) != null and Security::check_token()){
					$token->user->password = Auth::instance()->hash_password(Input::post('password', ""));
					$token->user->save();

					$token->delete();

					$view = View::forge("schools/forgotpassword/finish");
				}else{
					$view = View::forge("schools/forgotpassword/form");
				}

			}else{
				$view = View::forge("schools/forgotpassword/token_failed");
			}

		}else{
			$view = View::forge("schools/forgotpassword/token_failed");
		}

		$this->template->content = $view;
	}
}
