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

        if(Input::get("del_reserve", 0) != 0){
            $del_reserve = Model_Lessontime::find(Input::get("del_reserve", 0));
            if($del_reserve != null){
                $del_reserve->student_id = 0;
                $del_reserve->status = 0;
                $del_reserve->save();

                //cancel booking for shared db (set the status to 0) and send data to shared db
                $query = DB::update('reservation')->value('status', 0)->where('student_id', $this->user->id)->where('edoo_tutor', $del_reserve->teacher->email)->where('freetime_at', $del_reserve->freetime_at)->execute('shared');

                Response::redirect("/schools/classroom/");
            }else {
                Response::redirect("/schools/classroom/?error=huhu");
            }
        }
        
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

        //Determine if newly added
        $data["student_past"] = array();

        if(Input::get("id", 0) != NULL and Input::get("id", 0) != '') {
            $find_past = Model_Lessontime::find("last", [
                "where" => [
                    ["student_id", $id],
                    ["for_group", 1],
                    ["deleted_at", 0],
                    ["status", "<>", 0]
                ]
            ]);

            $data["find_past"] = $find_past;

            $look_stud = Model_User::find("all", [
               "where" => [
                   ["deleted_at", 0],
                   ["school_admitted", $this->user->id],
                   ["group_id", 75],
                   ["classroom_id", 0]
               ]
            ]);

            foreach($look_stud as $look) {
                if($find_past != NULL) {
                    if ($find_past->number != $look->progress) {
                        array_push($data["student_past"], $look->id);
                    }
                } else {
                    if ($look->progress != 0) {
                        array_push($data["student_past"], $look->id);
                    }
                }
            }
        } else {
            $data["find_past"] = NULL;
        }

        
        $data["classroom"] = $classroom;

        if($data["classroom"] == null){
            $data["classroom"] = Model_Classroom::forge();
        }
        
        if(Input::post("classname", null) != null and Input::post("add", null) != null and Security::check_token()){
            $classname = Input::post("classname", null);
            $students = Input::post("add", null);
            
            $studs = implode(",", $students);
            
            if(Input::get("id", 0) != 0) {
                
                $find_stud = Model_User::find("all", [
                   "where" => [
                       ["classroom_id", Input::get("id", 0)]
                   ] 
                ]);
                
                $classroom = $data['classroom'];
                $classroom->classname = $classname;
                $classroom->students_id = $studs;
                $classroom->updated_at = time();
                $classroom->save();
                
                foreach($find_stud as $found) {
                    if(!in_array($found->id, $students)) {
                        $found->classroom_id = 0;
                        $found->save();
                    }            
                }
            
                foreach($students as $each_stud) {
                    $edit_stud = Model_User::find($each_stud);
                    $edit_stud->classroom_id = $classroom->id;
                    $edit_stud->save();
                }  
                
                Response::redirect("/schools/classroom/");
                
            } else {
                
               $check_class = Model_Classroom::find("first", [
                    "where" => [
                        ["classname", $classname],
                        ["deleted_at", 0],
                        ["school_id", $this->user->id]
                    ]
                ]);

                if($check_class != NULL) {
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
                    Response::redirect("/schools/classroom/");
                }else {
                     Response::redirect("/schools/classroom/add/?e=1&id=".$id);
                }
            }
        }
        
        if($classroom == null){
			$classroom = Model_Classroom::forge();
		}

		$data["classroom"] = $classroom;
        $data["school_id"] = $this->user->id;
        
		$view = View::forge("schools/classroom/add", $data);
		$this->template->content = $view;
    }
}
