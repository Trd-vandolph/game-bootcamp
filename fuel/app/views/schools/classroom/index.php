<div id="contents-wrap">
	<div id="main">
		<h3>Classroom</h3>
		<p class="link-more"><? echo Html::anchor("schools/classroom/add", '<i class="fa fa-plus-circle"></i> Create new class'); ?></p>
		<table class="table-base" width="100%" border="0" cellpadding="0" cellspacing="0" id="classroom-table">
            <thead>
            <tr>
				<th>Classroom Name</th>
				<th>Created at</th>
				<th>Students</th>
				<th>Progress</th>
				<th></th>
			</tr>
            </thead>
            <tbody>
                <? if($classroom != NULL): ?>
                    <? foreach($classroom as $class): ?>
                        <tr id="class_<?=$class->id; ?>">
                            <td><a href="/schools/classroom/add/?id=<?=$class->id; ?>"><? echo $class->classname; ?></td>
                            <td><? echo date("F j, Y", $class->created_at)."<br>".date("h:i A", $class->created_at); ?></td>
                            <td><? echo getStudent($class->students_id); ?></td>
                            <td><? getProgress($class->id); ?></td>
                            <td id="classroom-action">
                                <? getDetail($class->id); ?>
                                <button class="button classroom"><a href="/schools/lesson/add/?class=<?=$class->id; ?><? getLink($class->id); ?><? getUnpaid($class->id); ?>"><i class="fa fa-calendar"></i> Book</a></button>
                                <button class="button classroom blue"><a href="/schools/classroom/add/?id=<?=$class->id; ?>"><i class="fa fa-cog"></i> Edit</a></button>
                                <button class="button classroom gray"><a id="del_class" href="/schools/classroom/?del=<?=$class->id; ?>"><i class="fa fa-times"></i> Delete</button>
                           </td>
                        </tr>
                        <div class="remodal" data-remodal-id="detail_<?=$class->id; ?>" class="detail-remodal">
                            <div class="classroom-remodal-header"><h3>Schedule Details</h3></div>
                            <div class="content classroom-remodal-content">
                                <p><strong>Date/Time: </strong>
                                    <span>
                                        <? getClassTime($class->id); ?>
                                    </span>
                                </p>
                                <p><strong>Lesson: </strong>
                                    <span>
                                        <? getLesson($class->id); ?>
                                    </span>
                                </p>
                                <p><strong>Tutor: </strong>
                                    <span>
                                        <? getTutor($class->id); ?>
                                    </span>
                                </p>
                                <p><strong>Student/s: </strong>
                                    <? getStudents($class->students_id); ?>
                                </p>
                            </div>
                            <div class="classroom-remodal-action">
                                <button class="button" id="cancel-button" data-remodal-target="cancel_<?=$class->id; ?>">Cancel Booking</button>
                            </div>
                        </div>
                        <div class="remodal" data-remodal-id="cancel_<?=$class->id; ?>" class="detail-remodal">
                            <div class="classroom-remodal-header"><h3>Are you sure you want to cancel this class?</h3></div>
                            <button data-remodal-action="cancel" class="button gray" data-remodal-target="detail_<?=$class->id; ?>">No</button>
                            <a href="/schools/classroom/?del_reserve=<? cancelClass($class->id); ?>"><button data-remodal-action="confirm" class="button">Yes</button></a>
                        </div>
                        <div class="remodal" data-remodal-id="cancel_<?=$class->id; ?>" class="detail-remodal">
                            <div class="classroom-remodal-header"><h3>Are you sure you want to cancel this class?</h3></div>
                            <button data-remodal-action="cancel" class="button gray" data-remodal-target="detail_<?=$class->id; ?>">No</button>
                            <a href="/schools/classroom/?del_reserve=<? cancelClass($class->id); ?>"><button data-remodal-action="confirm" class="button">Yes</button></a>
                        </div>
                    <? endforeach; ?>
                <? endif; ?>
            </tbody>
        </table>
		
		<? echo $pager ?>
	</div>
	<? echo View::forge("schools/_menu"); ?>
</div>

<!-- Remodal Libraries-->
<?= Asset::js("base.js"); ?>
<?= Asset::js("jquery.remodal.js"); ?>

<!--PHP Functions here -->
<?
    $del = Input::get("del", 0);

    if(isset($del)) {
        delStudent($del);
    }
    function getDetail($class_id)
    {
        $det = Model_Lessontime::find("last", [
            "where"=> [
                ["student_id", $class_id],
                ["deleted_at", 0],
                ["status", 1]
            ]
        ]);

        if($det != NULL) {
            echo "<button class='button classroom' id='detail_button'><a href='#' data-remodal-target='detail_".$class_id."'><i class='fa fa-info'></i> Details</a></button>";
        }
    }

    function getProgress($class_id)
    {
        $prog = Model_Lessontime::find("last", [
            "where" => [
                ["student_id", $class_id],
                ["deleted_at", 0]
            ]
        ]);


        if(count($prog) > 0) {
            if($prog->language < 0) {
                if($prog->status == 1) {
                    echo $prog->number."/1 Trial<br><span class='pending'>Pending</span>";
                }else {
                    echo $prog->number."/1 Trial<br><span class='pending'>Done</span>";
                }
            }else {
                if($prog->status == 1) {
                    echo $prog->number."/12<br><span class='pending'>Pending</span>";
                }else {
                    echo $prog->number."/12<br><span class='pending'>Done</span>";
                }
            }
        }else {
            echo "0/1<br><span class='pending'>No Reservation</span>";
        }
    }

    function getLink($class_id)
    {
        $link = Model_Lessontime::find("first", [
            "where" => [
                ["student_id", $class_id],
                ["deleted_at", 0]
            ]
        ]);

        if(count($link) < 1) {
            echo "&course=-1";
        }else {
            echo "&course=0";
        }
    }
    function getUnpaid($class_id)
    {
        $class = Model_Classroom::find($class_id);
        $studArr = explode(",",$class->students_id);

        $past = Model_Lessontime::find("all", [
            "where" => [
                ["deleted_at", 0],
                ["for_group", 1],
                ["student_id", $class->id],
                ["status", 2],
                ["language", 0]
            ]
        ]);

        $count = 0;

        foreach($studArr as $stud_id) {
            $studInfo = Model_User::find($stud_id);
            if($studInfo->charge_html == 0 and $studInfo->progress == 1 and count($past) < 1) {
                $count++;
            } elseif ($studInfo->charge_html == 1 and $studInfo->progress == 4 and count($past) < 8) {
                $count++;
            } elseif ($studInfo->charge_html == 11 and $studInfo->progress == 8 and count($past) < 12) {
                $count++;
            }
        }

        if($count>0) {
            echo "#unpaid";
        }
    }

    function getStudent($ar)
    {
        $sp = explode(',', $ar);
        $student = "";
        foreach($sp as $stud) {
            $st = Model_User::find('first', [
                "where" => [
                    ["deleted_at", 0],
                    ["id", $stud],
                ],
            ]);
            $data['student'] = $st;
            echo "<a href='/schools/students/detail/". $st->id ."'>". $st->firstname ."</a><br>";
        }
    }
    function delStudent($del)
    {
        $class = Model_Classroom::find($del);

        if($class != null){
            $class->deleted_at = time();
            $class->save();

            $stud = explode(",", $class->students_id);
            foreach($stud as $student) {
                $stud_info = Model_User::find($student);

                $stud_info->classroom_id = 0;
                $stud_info->save();
            }
            Response::redirect("schools/classroom/");
        }
    }
    function cancelClass($class_id) {
        $les = Model_Lessontime::find("all", [
            "where" => [
                ["student_id", $class_id],
                ["deleted_at", 0],
                ["status", 1],
                ["for_group", 1]
            ]
        ]);

        foreach($les as $l) {
            echo $l->id;
        }
    }
    function getStudents($students) {
        $st = explode(",", $students);
        foreach($st as $stud) {
            $student = Model_User::find("all", [
                "where" => [
                    ["id", $stud],
                    ["deleted_at", 0]
                ]
            ]);

            foreach($student as $studentInfo) {
                echo "<span class='classroom-student-list'> ".$studentInfo->firstname." ".$studentInfo->lastname."</span>";
            }
        }
    }
    function getTutor($class_id) {
        $les = Model_Lessontime::find("all", [
            "where" => [
                ["student_id", $class_id],
                ["deleted_at", 0],
                ["status", 1],
                ["for_group", 1]
            ]
        ]);

        foreach($les as $l) {
            $user = Model_User::find("all", [
                "where" => [
                    ["id", $l->teacher_id],
                    ["deleted_at", 0]
                ]
            ]);
            foreach($user as $u) {
                echo $u->firstname." ".$u->middlename." ".$u->lastname;
            }
        }
    }
    function getLesson($class_id) {
        $les = Model_Lessontime::find("all", [
            "where" => [
                ["student_id", $class_id],
                ["deleted_at", 0],
                ["status", 1],
                ["for_group", 1]
            ]
        ]);

        foreach($les as $l) {
            echo "Chapter ".$l->number." <em>enchant.js</em>";
        }
    }

    function getClassTime($class_id) {
        $time = Model_Lessontime::find("all", [
            "where"=>[
                ["student_id", $class_id],
                ["deleted_at", 0],
                ["status", 1],
                ["for_group", 1]
            ]
        ]);

        foreach($time as $ti) {
            echo date("M d, h:i A", $ti->freetime_at);
        }
    }

?>
