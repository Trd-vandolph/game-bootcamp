<div id="contents-wrap">
	<div id="main">
		<h3>Classroom</h3>
		<p class="link-more"><? echo Html::anchor("schools/classroom/add", '<i class="fa fa-plus-circle"></i> Create new class'); ?></p>
		<table class="table-base" width="100%" border="0" cellpadding="0" cellspacing="0" >
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
                            <td><? echo $class->classname; ?></td>
                            <td><? echo date("F j, Y", $class->created_at)."<br>".date("h:i A", $class->created_at); ?></td>
                            <td><? echo getStudent($class->students_id); ?></td>
                            <td><? echo $class->number; ?>/12</td>
                            <td id="classroom-action">
                                <button class="button classroom"><i class="fa fa-calendar"></i> Book</button>
                                <button class="button classroom blue"><a href="/schools/classroom/add/?id=<?=$class->id; ?>"><i class="fa fa-cog"></i> Edit</a></button>
                                <button class="button classroom gray right"><a id="del_class" href="/schools/classroom/?del=<?=$class->id; ?>"><i class="fa fa-times"></i> Delete</button>
                           </td>
                        </tr>
                    <? endforeach; ?>
                <? endif; ?>
            </tbody>
        </table>
		
		<? echo $pager ?>
	</div>
	<? echo View::forge("schools/_menu"); ?>
</div>
<!--PHP Functions here -->
<?
    $del = Input::get("del", 0);

    if(isset($del)) {
        delStudent($del);
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
                echo "<a href='". $st->id ."'>". $st->firstname ."</a><br>";
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
?>
