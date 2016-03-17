<div id="contents-wrap">
	<div id="main">
		<h3>Histories</h3>
		<ul class="histories">
			<? if($class != null): ?>
				<? foreach($class as $cl): ?>
					<?
						$reservations = Model_Lessontime::find("all", [
							"where" => [
								["deleted_at", 0],
								["student_id", $cl->id],
								["status", "<>", 0],
								["freetime_at", "<", time()],
							],
							"order_by" => [
								["updated_at", "desc"],
							]
						]);
					?>
					<? foreach($reservations as $reservation): ?>
						<?
						$classInfo = Model_Classroom::find($reservation->student_id);
						?>
						<li id="reservation_<? echo $reservation->id; ?>" class="course<?= ($reservation->language + 1); ?>">
							<div class="clearfix">
								<h4><?php echo Model_Lessontime::getCourse($reservation->language); ?> <span>Lesson <? echo $reservation->number; ?></span></h4>
								<p class="date"><? echo date("M d, Y. H:i:s", $reservation->freetime_at); ?></p>
							</div>
							<p class="teacher">Tutor : <? if($reservation->teacher != null) echo Html::anchor("schools/teachers/detail/{$reservation->teacher_id}", $reservation->teacher->firstname); ?></p>
							<p class="teacher">Class : <a href="/schools/classroom/add/?id=<?=$reservation->student_id; ?>" target="_blank" /><?= $classInfo->classname; ?></a></p>
							<div class="feedback clearfix">
								<? if($reservation->status == 1 && $reservation->freetime_at <= time()){
										echo ('<p>You have not received a feedback from your tutor.</p>');
									}else if($reservation->status == 2){
										echo nl2br($reservation->feedback);
									}?>
							</div>
						</li>
					<? endforeach; ?>
				<? endforeach; ?>
			<? endif; ?>
		</ul>
		<? echo $pager ?>
	</div>
	<? echo View::forge("schools/_menu")->set($this->get()); ?>
</div>
