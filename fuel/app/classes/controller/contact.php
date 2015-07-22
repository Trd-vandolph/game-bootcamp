<?php

class Controller_Contact extends Controller_Base
{
	private $fields = array('name','email','body');

	public function action_index()
	{
		$this->template->title = "Contact";
		$this->template->sub = "How can we help you?";

		if(Input::post('confirm')){
			foreach($this->fields as $field){
				Session::set_flash($field, Input::post($field));
			}
		}
		$val = Validation::forge();
		$val->add('name', 'name')
			->add_rule('required');
		$val->add('email', 'email')
			->add_rule('required');
		$val->add('body', 'body')
			->add_rule('required');

		if(Security::check_token()){
			if($val->run()){
				Response::redirect("contact/confirm");
			}
		}
		$view = View::forge("contacts/index");
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

		$this->template->title = "Contact";
		$this->template->sub = "How can we help you?";
		$view = View::forge("contacts/confirm", $data);
		$this->template->content = $view;
	}

	public function action_submit()
	{
		if(!Security::check_token()){
			Response::redirect('_404_');
		}

		if(Session::get_flash('name')){
			$contact = Model_Contact::forge();
			$contact->title = Session::get_flash("title");
			$contact->body = Session::get_flash("body");
			$body = View::forge("email/contact");
			$body->set("name", Session::get_flash('name'));
			$body->set("email", Session::get_flash('email'));
			$body->set("body", Session::get_flash('body'));
			$sendmail = Email::forge("JIS");
			$sendmail->from(Config::get("statics.info_email"),Config::get("statics.info_name"));
			$sendmail->to(Config::get("statics.info_email"));
			$sendmail->subject("We got contact/ OliveCode");
			$sendmail->body($body);

			$sendmail->send();
		}

		$this->template->title = "Contact";
		$this->template->sub = "How can we help you?";
		$view = View::forge("contacts/send");
		$this->template->content = $view;
	}
}