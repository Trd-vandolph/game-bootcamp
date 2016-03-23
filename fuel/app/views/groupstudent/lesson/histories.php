<div id="contents-wrap">
	<div id="main">
		<h3>Histories</h3>
		<ul class="histories">
			<? if($reservations != null): ?>
			<? foreach($reservations as $reservation): ?>
			<li id="reservation_<? echo $reservation->id; ?>" class="course<?= ($reservation->language + 1); ?>">
				<div class="clearfix">
					<h4><?php echo Model_Lessontime::getCourse($reservation->language); ?> <span>Lesson <? echo $reservation->number; ?></span></h4>
					<p class="date"><? echo date("M d, Y. H:i:s", $reservation->freetime_at); ?></p>
				</div>
				<p class="teacher">Tutor : <? if($reservation->teacher != null) echo Html::anchor("groupstudent/teachers/detail/{$reservation->teacher_id}", $reservation->teacher->firstname); ?></p>
				<div class="feedback clearfix">
					<? if($reservation->status == 1){
						echo ('<p>You have not received a feedback from your tutor.</p>');
						}else{
							echo nl2br($reservation->feedback);
						}?>
				</div>
			</li>
			<? endforeach; ?>
			<? endif; ?>
		</ul>
		<? echo $pager ?>
	</div>
	<? echo View::forge("groupstudent/_menu")->set($this->get()); ?>
</div>
