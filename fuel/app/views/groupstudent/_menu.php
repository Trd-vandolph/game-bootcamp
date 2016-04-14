<div id="side">
	<nav>
		<ul>
			<li><? echo Html::anchor('/groupstudent/', '<i class="fa fa-fw fa-newspaper-o"></i> Dashboard'); ?></li>
		</ul>
	</nav>
	<h3>LESSON</h3>
	<nav>
		<ul>
			<li><? echo Html::anchor('/groupstudent/lesson/histories', '<i class="fa fa-fw fa-history"></i> Learning History'); ?></li>
			<li><? echo Html::anchor('/groupstudent/textbooks', '<i class="fa fa-fw fa-book"></i> Textbooks'); ?></li>
			<?php /* <li><a href="#"><i class="fa fa-fw fa-graduation-cap"></i> How to Take Lesson</a></li> */ ?>
		</ul>
	</nav>
	<h3> MENU</h3>
	<nav>
		<ul>
			<?php /* <li><a href="#"><i class="fa fa-fw fa-credit-card"></i> New Course</a></li> */ ?>
			<li><? echo Html::anchor('/groupstudent/teachers', '<i class="fa fa-fw fa-search"></i> Tutors'); ?></li>
			<li><? echo Html::anchor('/groupstudent/documents', '<i class="fa fa-fw fa-file"></i> Documents'); ?></li>
			<li><? echo Html::anchor('/groupstudent/news', '<i class="fa fa-fw fa-info-circle"></i> Information'); ?></li>
			<!-- li><? echo Html::anchor('/groupstudent/forum', '<i class="fa fa-fw fa-users"></i> Forum'); ?></li-->
			<li><? echo Html::anchor('/groupstudent/contactforum', '<i class="fa fa-fw fa-envelope"></i> Contact'); ?></li>
			<li><? echo Html::anchor('/faq', '<i class="fa fa-fw fa-question-circle"></i> FAQ', array('class' => 'blank')); ?></li>
		</ul>
	</nav>
</div>
<?
	$reserved_from_lessontimes = DB::select()->from('lessontimes')->where('status', 0)->where('deleted_at', 0)->execute(); //select from lessontimes
	$reserved_from_shared = DB::select()->from('reservation')->where('status', 1)->execute('shared'); //select from shared database
	$check_all_student = DB::select('*')->from('reservation')->where('status', 1)->execute('shared'); //check all student
	foreach ($check_all_student as $student) {
		$check_student = DB::select()->from('users')->where('id', $student['student_id'])->where('email', $student['student_email'])->execute();
		if (!count($check_student) == 1) {
			foreach ($reserved_from_lessontimes as $lessontimes) {
				foreach ($reserved_from_shared as $shared) {
					if ($lessontimes['freetime_at'] == $shared['freetime_at'] && $lessontimes['edoo_tutor'] == $shared['edoo_tutor']) {
						$query = DB::update('lessontimes')->set(array(
							'status' => 3,
							'student_id' => -$student['student_id'],
						))->where('freetime_at', $lessontimes['freetime_at'])->where('edoo_tutor', $lessontimes['edoo_tutor'])->execute();
					}
				}
			}
		}
	}

	//cancel booking for all website's database
	$reserved_from_lessontimes = DB::select()->from('lessontimes')->where('status', 3)->where('deleted_at', 0)->execute(); //select from lessontimes
	$reserved_from_shared = DB::select()->from('reservation')->where('status', 0)->execute('shared'); //select from shared database
	$check_all_student = DB::select('*')->from('reservation')->where('status', 0)->execute('shared'); //check all student
	foreach ($check_all_student as $student) {
		$check_student = DB::select()->from('users')->where('id', $student['student_id'])->where('email', $student['student_email'])->execute();
		if (!count($check_student) == 1) {
			foreach ($reserved_from_lessontimes as $lessontimes) {
				foreach ($reserved_from_shared as $shared) {
					if ($lessontimes['freetime_at'] == $shared['freetime_at'] && $lessontimes['edoo_tutor'] == $shared['edoo_tutor']) {
						$query = DB::update('lessontimes')->set(array(
							'status' => 0,
							'student_id' => 0,
						))->where('freetime_at', $lessontimes['freetime_at'])->where('edoo_tutor', $lessontimes['edoo_tutor'])->execute();
					}
				}
			}
		}
	}
?>
<script>
	$(function(){ $('#side > nav:nth-child(3) > ul > li:nth-child(1) a > span:eq(1)').css('marginLeft','22px'); });
</script>