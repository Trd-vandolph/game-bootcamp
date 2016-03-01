<?php

class Controller_Schools_Classroom extends Controller_Schools
{

	public function action_index()
	{
        $data['classroom'] = Model_Classroom::find('all', [
            "where" => [
                ["deleted_at", 0],
                ["school_id", $this->user->id],
            ],
            "order_by" => [
                ["created_at", "desc"],
            ]
        ]);
        
        $config=array(
			'pagination_url'=>"?",
			'uri_segment'=>"p",
			'num_links'=>9,
			'per_page'=>20,
			'total_items'=>count($data["classroom"]),
		);

		$data["pager"] = Pagination::forge('mypagination', $config);

		$data["classroom"] = array_slice($data["classroom"], $data["pager"]->offset, $data["pager"]->per_page);

        
        $data["user"] = $this->user;
		$view = View::forge("schools/classroom/index", $data);
		$this->template->content = $view;
	}
    public function action_add() 
    {
        $id = Input::get("id", 0);
		$classroom = Model_Classroom::find($id);
        
        $school_id = $this->user->id;
        
        $data['students']= Model_User::find('all', [
           "where" => [
               ['school_admitted', $school_id],
               ['classroom_id', "<", 1]
           ],
            "order_by" => [
                ['id', 'desc']
            ]
        ]);
        
        $data["classroom"] = Model_Classroom::find($id);

        if($data["classroom"] == null){
            $data["classroom"] = Model_Classroom::forge();
        }
        
        if(Input::post("classname", null) != null and Input::post("add", null) != null and Security::check_token()){
            $classname = Input::post("classname", null);
            $students = Input::post("add", null);
            
            $studs = implode(",", $students);
            
            $check_class = Model_Classroom::find("first", [
                "where" => [
                    ["classname", $classname]
                ]
            ]);
            
            if(count($check_class) > 0) {
                $data['error'] = 'This Classroom Name already exist. It must be unique.';
            }
            
            if(!isset($data["error"])){
                $classroom = $data['classroom'];
				$classroom->classname = $classname;
                $classroom->students_id = $studs;
                $classroom->school_id = $this->user->id;
                $classroom->updated_at = time();
				$classroom->save();
                
                $id = $classroom->id;
                
                foreach($students as $stud) {
                    $edit = Model_User::find($stud);
                    $edit->classroom_id = $id;
                    $edit->save();
                }

				Response::redirect("/schools/classroom");
			}
        }
        
        if($classroom == null){
			$classroom = Model_Classroom::forge();
		}

		$data["classroom"] = $classroom;
        
		$view = View::forge("schools/classroom/add", $data);
		$this->template->content = $view;
    }
}
