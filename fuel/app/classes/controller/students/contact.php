<?php

class Controller_Students_Contact extends Controller_Students
{
	private $fields = array('title','body');

	public function before(){

		parent::before();

	}

	public function action_index()
	{
		$errors = null;

		if(Input::post('confirm')){
			foreach($this->fields as $field){
				Session::set_flash($field, Input::post($field));
			}
		}

		$val = Model_Contact::validate();

		if(Security::check_token()){
			if($val->run()){
				Response::redirect("students/contact/confirm");
			}else{
				$errors = $val->error();
			}
		}


		$view = View::forge("students/contact/index");
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

		$this->template->content = View::forge('students/contact/confirm',$data);
	}

	public function action_submit()
	{

		if(!Security::check_token()){
			Response::redirect('_404_');
		}

		if(Session::get_flash('title')){
			$contact = Model_Contact::forge();
			$contact->title = Session::get_flash("title");
			$contact->body = Session::get_flash("body");
			$contact->user_id = $this->user->id;
			$contact->save();
		}else{
			Response::redirect('_404_');
		}
		$this->template->content = View::forge('students/contact/finish');
	}
}