<?php

class Controller_Teachers_Signup extends Controller_Base
{

	private $fields = array('firstname','middlename','lastname','email','password','sex','year','month','day','nickname','google_account','need_reservation_email','timezone','need_news_email','pr','educational_background','trial','enchantJS');

	public function before(){
		$this->template = View::forge("teachers/template");
		$this->template->title = "signup";
		$this->template->auth_status = null;
	}

	public function action_index()
	{
		$errors = null;

		if(Input::post('confirm')){
			foreach($this->fields as $field){
				Session::set_flash($field, Input::post($field));
			}
		}

		$val = Validation::forge();
		$val->add_callable('passwordvalidation');

		$val->add('firstname','Firstname')->add_rule('required');
		$val->add('lastname','Lastname')->add_rule('required');
		$val->add('email','Email address')->add_rule('required')->add_rule('valid_email');
		$val->add('sex','Gender')->add_rule('required');
		$val->add('password','password')->add_rule('required')->add_rule('password')->add_rule('min_length', 8);
		$val->add('google_account','Gmail address')->add_rule('required');
		$val->add('pr','PR')->add_rule('required');
		$val->add('educational_background','Educational background')->add_rule('required');

		if(Security::check_token()){
			if($val->run()){
				$user = Model_User::find("first", [
					"where" => [
						["email", Input::post("email", "")]
					]
				]);

				if($user == null){
					Response::redirect("teachers/signup/confirm");
				}else{
					$errors = ["This email is already in use."];
				}
			}else{
				$errors = $val->error();
			}
		}

		$data["errors"] = $errors;
		$view = View::forge("teachers/signup/index", $data);
		$this->template->content = $view;
	}

	public function action_confirm()
	{

		$data = array();
		foreach ($this->fields as $field)
		{
			$data[$field] = Session::get_flash($field);
			Session::keep_flash($field);
		}

		$this->template->content = View::forge('teachers/signup/confirm',$data);
	}

	public function action_submit()
	{

		if(!Security::check_token()){
			Response::redirect('_404_');
		}

		if(Session::get_flash('email')){

			$email = Session::get_flash("email");

			try{
				Auth::create_user($email, Session::get_flash("password"), $email, 10);
				$user = Model_User::find("first", [
					"where" => [
						["email", $email]
					]
				]);

				if($user != null){
					$user->sex = Session::get_flash("sex");
					$user->firstname = Session::get_flash("firstname");
					$user->middlename = Session::get_flash("middlename");
					$user->lastname = Session::get_flash("lastname");
					$user->birthday = Session::get_flash("year")."-".Session::get_flash("month")."-".Session::get_flash("day");
					$user->google_account = Session::get_flash("google_account");
					$user->need_reservation_email = Session::get_flash("need_reservation_email");
					$user->need_news_email = Session::get_flash("need_news_email");
					$user->timezone = Session::get_flash("timezone");
					$user->pr = Session::get_flash("pr");
					$user->educational_background = Session::get_flash("educational_background");

					$user->trial = Session::get_flash("trial");
					$user->enchantJS = Session::get_flash("enchantJS");

					$user->save();

					// send mail
					$body = View::forge("email/teachers/signup");
					$body->set("name", $user->firstname);
					$body->set("user", $user);
					$body->set("ymd", explode("-", $user->birthday));
					$sendmail = Email::forge("JIS");
					$sendmail->from(Config::get("statics.info_email"),Config::get("statics.info_name"));
					$sendmail->to($user->email);
					$sendmail->subject("Welcome Aboard! / OliveCode");
					$sendmail->html_body(htmlspecialchars_decode($body));

					$sendmail->send();
				}else{
					Response::redirect('_404_');
				}
			}catch(Exception $e){
				Response::redirect('_404_');
			}
		}else{
			Response::redirect('_404_');
		}
		$this->template->content = View::forge('teachers/signup/finish');
	}
}
