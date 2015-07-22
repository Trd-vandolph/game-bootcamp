<?php

class Controller_Admin_Fee extends Controller_Admin
{

	public function before(){
		parent::before();

	}

	public function action_index()
	{

		$year = Input::get("year", date("Y"));
		$month = Input::get("month", date("m"));

		$grade = Model_Grade::find("first",[
			"where" => [
				["year", $year],
				["month", $month]
			]
		]);

		if($grade == null){
			$grade = Model_Grade::forge();
			$grade->year = $year;
			$grade->month = $month;
			$grade->grade_1 = Config::get("prices")[0];
			$grade->grade_2 = Config::get("prices")[1];
			$grade->grade_3 = Config::get("prices")[2];
			$grade->grade_4 = Config::get("prices")[3];
			$grade->grade_5 = Config::get("prices")[4];
			$grade->save();
		}

		$data["teachers"] = Model_User::find("all", [
			"where" => [
				["group_id", 10],
				["deleted_at", 0]
			],
			"order_by" => [
				["id", "desc"]
			]

		]);

		foreach($data["teachers"] as $teacher){
			$teacher->count = Model_Lessontime::count([
				"where" => [
					["deleted_at", 0],
					["teacher_id", $teacher->id],
					["feedback", "<>", ""],
					["freetime_at", ">=", strtotime("{$year}-{$month}-01")],
					["freetime_at", "<", strtotime("{$year}-{$month}-01 +1 month")]
				]
			]);
		}

		$data["year"] = $year;
		$data["month"] = $month;
		$data["grade"] = $grade;

		$view = View::forge("admin/fee/index", $data);
		$this->template->content = $view;
	}
}