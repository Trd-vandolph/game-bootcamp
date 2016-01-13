<?php

class Controller_Students_Payment extends Controller_Students
{

	public function before(){

		parent::before();

	}

	public function action_index(){
		
		$data['student'] = Model_User::find("all", [
				"where" => [
						["id", $this->user->id],
						["deleted_at", 0]
				]
		]);
		
		if(Input::post('action') == 'submit'):
			// add	
			if(Input::post("amount", null) != null){	
				if(is_uploaded_file($_FILES["photo"]["tmp_name"])){	
					$filename = str_replace("/", "", $_FILES["photo"]["name"]);
					$filepath = DOCROOT."/contents/receipt/".$filename;
			
					if(move_uploaded_file($_FILES["photo"]["tmp_name"], $filepath)) {
						chmod($filepath, 0644);
			
						// save
						$payment = Model_Payment::forge();
						$payment->student_id = Input::post("studentId");
						$payment->pay_method = Input::post("type");
						$payment->amount = Input::post("amount");
						$payment->paid_at = Input::post("date");
						$payment->receipt = $filename;
						$payment->status = 0;
						$payment->method = Input::post("method");
						$payment->paid = Input::post("quarter");
						$payment->save();
						
						Response::redirect("/students/top/?m=1");
					}else{
						Response::redirect("/students/payment/?e=1");
					}
				}else{
					Response::redirect("/students/payment/?e=2");
				}
			}else {
				Response::redirect("/students/payment/?e=3");
			}
		endif;
		$view = View::forge("students/payment/index", $data);
		$this->template->content = $view;
	}
}