<div id="contents-wrap">
	<div id="main">
		<h3>Histories</h3>
		<ul class="histories">
			<? if($reservations != null): ?>
			<? foreach($reservations as $reservation): ?>
				<?
				$stud = Model_User::find($reservation->student_id);

				if(count($stud) == NULL ) {
					$stud_mail = "N/A";
				}else{
					$stud_mail = $stud->email;
				}

				$check_shared = DB::select()->from('reservation')
					->where('edoo_tutor', $reservation->edoo_tutor)
					->where('freetime_at', $reservation->freetime_at)
					->where('student_id', $reservation->student_id)
					->where('student_email', $stud_mail)
					->where('status', 2)
					->execute('shared');

				if(count($check_shared) > 0) {
				?>
					<li id="reservation_<? echo $reservation->id; ?>" class="course<?= ($reservation->language + 1); ?>">
						<div class="clearfix">
							<h4><?php echo Model_Lessontime::getCourse($reservation->language); ?> <span>Lesson <? echo $reservation->number; ?></span></h4>
							<p class="date"><? echo date("M d, Y. H:i:s", $reservation->freetime_at); ?></p>
						</div>
						<p class="teacher">Student : <? if($reservation->student != null) echo Html::anchor("teachers/students/detail/{$reservation->student_id}", $reservation->student->firstname); ?></p>
						<div class="feedback clearfix">
							<? if($reservation->status == 1){
								echo ('<p class="fbtext">You have not sent a feedback to your student.<br>Click on the button to send feedback.</p>');
								echo Html::anchor("teachers/lesson/feedback/{$reservation->id}", 'Feedback', [ "class" => "button green right"]);
								echo Html::anchor("teachers/lesson/histories/?del_id={$reservation->id}", 'Delete',[ "class" => "button right"]);
								}else{
									echo nl2br($reservation->feedback);
								}?>
						</div>
					</li>
			<? } endforeach; ?>
			<? endif; ?>
		</ul>
		<? echo $pager ?>
	</div>
	<? echo View::forge("teachers/_menu"); ?>
</div>
