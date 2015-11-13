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
			<? endforeach; ?>
			<? endif; ?>
		</ul>
		<? echo $pager ?>
	</div>
	<? echo View::forge("teachers/_menu"); ?>
</div>

<script type="text/javascript">
	$(function(){
		var del = $('.feedback > a:nth-child(3)');
		del.on('click', function(){
			var con = confirm('Are you sure you want to delete this?');
			if(con){ return true; } else { return false; }
		});
	});
</script>
