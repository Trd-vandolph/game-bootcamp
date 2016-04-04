<?
    $e= Input::get("e", "");
    if($student_past != NULL) {
        $st_pt = $student_past;
    }else {
        $st_pt = array();
    }
    if($find_past != NULL) {
        $p = $find_past->number;
    }else {
        $p = 0;
    }
?>
<div id="contents-wrap">
	<div id="main">
		<h3><? if(Input::get("id", 0) == 0){
				echo "Add";
			}else{
				echo "Edit";
			} ?> Classroom</h3>
        <section class="content-wrap">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" id="id" value="<? echo Input::get("id", ""); ?>" />
                <ul class="forms">
                    <li>
                        <h4>Classroom Name</h4>
                        <input placeholder="Classroom Name" name="classname" type="text" required pattern=".{2,50}" title="must be less than 50 chars" value="<? echo Security::htmlentities(Input::post("classname", $classroom->classname)); ?>">
                        <span class="message" style="color: red"><? if($e>0){echo "This Classroom Name already exist. It must be unique.";} ?></span>
                    </li>
                    <li>
                        <h4>Students</h4>
                    </li>
                    <li style="padding-bottom: 0">
                        <strong>Note: </strong><span style="color: #DC2323; font-style: italic">If there's a message beside the student name. Please click it to view.</span>
                    </li>
                    <li>
                        <table class="table-base" width="100%" border="0" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Enrolled Date</th>
                                    <th>Age</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                               <? 
                                if(Input::get("id", 0) != 0):
                                    getStudent(Input::get("id", 0));
                                endif; 
                                ?>
                                <? foreach($students as $stud): ?>
                                    <tr>
                                        <td><? echo $stud->id; ?></td>
                                        <td><a href="detail/?id=<?= $stud->id; ?>"><? echo $stud->firstname." ".$stud->lastname; ?></a><? thisStudent($stud->id,$st_pt,$p);  ?></td>
                                        <td><? echo date("M. d, Y", $stud->created_at); ?></td>
                                        <td><? getAge($stud->birthday); ?></td>
                                        <td style="text-align: center; ">
                                            <input id="class<?=$stud->id; ?>" class="classroom-add-student" type="checkbox" value="<?=$stud->id; ?>" name="add[]"/>
                                            <label for="class<?=$stud->id; ?>" class="classroom-add-student-label">Add</label>
                                        </td>
                                    </tr>

                                    <div class="remodal" data-remodal-id="choose_action_<?=$stud->id; ?>" class="choose-action-remodal">
                                        <div class="classroom-remodal-header"><h3>Available action to consider. Please choose.</h3></div>
                                        <div class="classroom-remodal-body">
                                            <ol>
                                            <?php getChoices($stud->id,Input::get("id", 0), $school_id); ?>
                                            </ol>
                                        </div>
                                    </div>
                                <? endforeach; ?>                                
                            </tbody>
                        </table>
                    </li>
                    <li>
                        <button class="button">Save</button>
                        <button class="button">Delete Classroom</button>
                    </li>
                </ul>
                <? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
            </form>
        </section>
	</div>
	<? echo View::forge("schools/_menu"); ?>
</div>
<!-- Remodal Libraries-->
<?= Asset::js("base.js"); ?>
<?= Asset::js("jquery.remodal.js"); ?>

<!-- PHP Functions here -->
<?
    function getStudent($id) {
        $st = Model_Classroom::find($id)->students_id;
        $each = explode(",", $st);
        

        foreach($each as $ind) {
            $student = Model_User::find("first", [
                "where" => [
                    ["id", $ind],
                   
                ]       
            ]);
            
            echo "<tr>";
            echo "<td>".$student->id."</td>";
            echo "<td><a href=detail/?id='".$student->id."'>".$student->firstname." ".$student->lastname."</a></td>";
            echo "<td>".date("M. d, Y", $student->created_at)."</td>";
            echo "<td>".floor((time() - strtotime($student->birthday)) / 31556926)."</td>";
            echo "<td style='text-align: center;'>";
            echo "<input id='class".$student->id."' class='classroom-add-student' type='checkbox' value=".$student->id." name='add[]' checked />";
            echo "<label for='class".$student->id."' class='classroom-add-student-label'>Add</label>";
            echo "</td>";
            echo "</tr>";
        }
    }
    function getAge($bd) {
        $age = floor((time() - strtotime($bd)) / 31556926);        
        echo $age;
    }
    function thisStudent($id,$arr,$past){
        if(in_array($id, $arr)) {
            $st = Model_User::find("first", [
                "where" => [
                    ["id", $id]
                ]
            ]);
            if($past != $st->progress) {
                if($st->progress == 0) {
                    if($past == -1) {
                        echo "<a data-remodal-target='choose_action_".$id."'><span id='find-past'>This student did not take trial class.</span></a>";
                    } else {
                        echo "<a data-remodal-target='choose_action_".$id."'><span id='find-past'>This student is behind ".$past." class</span></a>";
                    }
                } else {

                    $behind = $past - $st->progress;
                    if($behind < 0) {
                        echo "<a data-remodal-target='choose_action_".$id."'><span id='find-past'>This student is ahead ". $behind *-1 ." class</span></a>";
                    }else {
                        echo "<a data-remodal-target='choose_action_".$id."'><span id='find-past'>This student is behind ". $behind ." class</span></a>";
                    }

                }
            }
        }
    }
    function getChoices($id,$cl,$sID) {
        $mess = '';
        
        $studInfo = Model_User::find($id);
        
        $classes = Model_Classroom::find("all", [
            "where" => [
                ["deleted_at", 0],
                ["school_id", $sID]
            ]
        ]);
        
        foreach($classes as $class) {
            $less = Model_Lessontime::find("all", [
                "where" => [
                    ["deleted_at", 0],
                    ["student_id", $class->id],
                    ["for_group", 1],
                ]
            ]);
            
            if($studInfo->progress != 0) {
                if($studInfo->progress == (count($less) - 1)) {
                    echo "<li><a href='/schools/classroom/add/?id=".$class->id."'><p>Add this student to ".$class->classname." where they have the same lesson progress(Chapter ".$studInfo->progress.").</p></a></li>";
                }
            }else {
                if(count($less) == 0) {
                    echo "<li><a href='/schools/classroom/add/?id=".$class->id."'><p>Add this student to ".$class->classname." where they haven't started their class.</p></a></li>";
                }               
            }  
        }
        
        echo "<li><a href='/schools/classroom/add/'><p>Add this student to a new classroom.</p></a></li>";
        echo "<li><p>It's okay. Force to add this student to this class. (Close this window then check the checkbox)</p></li>";
    }
?>