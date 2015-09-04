<?php

class Controller_Admin_Top extends Controller_Admin
{

	public function before(){

		parent::before();

	}

	public function action_index()
	{
		$year = date("Y");
		$month = date("m");

		$price = Model_Grade::find("first",[
			"where" => [
				["year", $year],
				["month", $month]
			]
		]);

		if($price == null){
			$price = Model_Grade::forge();
			$price->year = $year;
			$price->month = $month;
			$price->grade_1 = Config::get("prices")[0];
			$price->grade_2 = Config::get("prices")[1];
			$price->grade_3 = Config::get("prices")[2];
			$price->grade_4 = Config::get("prices")[3];
			$price->grade_5 = Config::get("prices")[4];
			$price->save();
		}

		$data["ym"] = Input::get("ym", date("Y-m"));

		$data["contacts"] = Model_Contactforum::find("all", [
			"where" => [
				["deleted_at", 0]
			],
			"order_by" => [
				["id", "desc"],
			],
			"limit" => 5,
		]);
		
		$data["payment"] = Model_Payment::find("all", [
				"where" => [
						["status", 0]
				],
				"order_by" => [
						["id", "desc"],
				],
				"limit" => 5,
		]);

		$data["reservations"] = Model_Lessontime::find("all", [
			"where" => [
				["deleted_at", 0],
				["freetime_at", ">=", strtotime($data["ym"] . "-01")],
				["freetime_at", "<", strtotime($data["ym"] . "-01 +1 month")],
				["status", ">", 0],
			],
			"order_by" => [
				["freetime_at", "asc"],
			]
		]);

		$view = View::forge("admin/top", $data);
		$this->template->content = $view;
	}
}