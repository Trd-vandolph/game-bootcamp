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
                    </li>
                    <li>
                        <h4>Students</h4>
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
                                <? foreach($students as $stud): ?>
                                    <tr>
                                        <td><? echo $stud->id; ?></td>
                                        <td><a href="detail/?id=<?= $stud->id; ?>"><? echo $stud->firstname." ".$stud->lastname; ?></a></td>
                                        <td><? echo date("M. d, Y", $stud->created_at); ?></td>
                                        <td><? getAge($stud->birthday); ?></td>
                                        <td style="text-align: center; ">
                                            <input id="class<?=$stud->id; ?>" class="classroom-add-student" type="checkbox" value="<?=$stud->id; ?>" name="add[]"/>
                                            <label for="class<?=$stud->id; ?>" class="classroom-add-student-label">Add</label>
                                        </td>
                                    </tr>
                                <? endforeach; ?>
                            </tbody>
                        </table>
                    </li>
                    <li>
                        <button class="button">Save</button>
                    </li>
                </ul>
                <? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
            </form>
        </section>
	</div>
	<? echo View::forge("schools/_menu"); ?>
</div>
<!-- PHP Functions here -->
<?
    function getAge($bd) {
        $age = floor((time() - strtotime($bd)) / 31556926);
        
        echo $age;
    }
?>