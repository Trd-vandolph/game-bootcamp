<?php

class Controller_Schools_Signup extends Controller_Base
{

	private $fields = array('school_name','nickname','email','need_reservation_email','need_news_email', 'timezone');

	public function before(){
		$this->template = View::forge("schools/template");
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
        $val->add('school_name','School Name')->add_rule('required');
		$val->add('email','Email address')->add_rule('required')->add_rule('valid_email');
		$val->add('password','password')->add_rule('required')->add_rule('password')->add_rule('min_length', 8);

		if(Security::check_token()){
			if($val->run()){
				$user = Model_User::find("first", [
					"where" => [
						["email", Input::post("email", "")]
					]
				]);

				if($user == null){
					Response::redirect("schools/signup/confirm");
				}else{
					$errors = ["This email is already in use."];
				}
			}else{
				$errors = $val->error();
			}
		}

		$data["errors"] = $errors;
		$view = View::forge("schools/signup/index", $data);
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

		$this->template->content = View::forge('schools/signup/confirm',$data);
	}

	public function action_submit()
	{

		if(!Security::check_token()){
			Response::redirect('_404_');
		}

		if(Session::get_flash('email')){

			$email = Session::get_flash("email");


				Auth::create_user($email, Session::get_flash("password"), $email, 50);
				$user = Model_User::find("first", [
					"where" => [
						["email", $email]
					]
				]);

				if($user != null){
					$user->sex = Session::get_flash("school_name");
					$user->email= Session::get_flash("email");
					$user->need_reservation_email = Session::get_flash("need_reservation_email");
					$user->need_news_email = Session::get_flash("need_news_email");
					$user->timezone = Session::get_flash("timezone");
					$user->save();

					// send mail
					$body = View::forge("email/schools/signup");
					$body->set("name", $user->school_name);
					$body->set("user", $user);
					$sendmail = Email::forge("JIS");
					$sendmail->from(Config::get("statics.info_email"),Config::get("statics.info_name"));
					$sendmail->to($user->email);
					$sendmail->subject("Welcome Aboard! / Game-BootCamp");
					$sendmail->html_body(htmlspecialchars_decode($body));

					$documents = Model_Document::query()->where('type', 50)->where('deleted_at', 0)->limit(1)->get_one();
					if(count($documents)>0){
						$query = Model_Document::find($documents->id);
						$sendmail->attach(DOCROOT.'/contents/'.$query->path);
					}

					$sendmail->send();

				}else{
					Response::redirect('_404_/?hehe');
				}
		}else{
			Response::redirect('_404_');
		}


		$this->template->content = View::forge('schools/signup/finish');
	}
}
