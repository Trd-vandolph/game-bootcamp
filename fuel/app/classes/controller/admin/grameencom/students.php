<?php

class Controller_Admin_Grameencom_Students extends Controller_Admin
{

	public function before(){

		parent::before();

	}

	public function action_detail($id = 0)
	{
		$user = Model_User::find($id);

		if($user == null){
			Response::redirect("/grameencom/students");
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
		
		$data["contacts"] = Model_Contactforum::find("all", [
				"where" => [
						["deleted_at", 0]
				],
				"order_by" => [
						["id", "desc"],
				],
				"limit" => 10,
		]);

		$view = View::forge("admin/grameencom/students/detail", $data);
		$this->template->content = $view;
	}

}