<div id="contents-wrap">
	<div id="main">
		<section class="notice content-wrap" style="display: none" id="reservation_area"></section>
		<? if($feedbacks != null): ?>
		<h3>Feedback Notification</h3>
			<section class="feedback-notification">
				<div class="content-wrap">
					<? foreach($feedbacks as $feedback): ?>
						<? if(time() > $feedback->freetime_at+3600): ?>
							<div class="non-feedback">
								<div class="feedback-message">
									<i class="fa fa-exclamation-circle"></i>
									Please provide feedback on <b><? echo $feedback->student->firstname; ?>'s</b> class that was scheduled on <b><? echo date("G:i ~ G:45, j M Y", $feedback->freetime_at); ?></b>.
								</div>
								<p><? echo Html::anchor("/teachers/lesson/feedback/{$feedback->id}", '<i class="fa fa-pencil-square-o"></i> Add feedback now', array('class' => 'feedback-button')); ?></p>
							</div>
						<? endif; ?>
					<? endforeach; ?>
				</div>
			</section>
		<? endif; ?>
		<h3>Lesson Schedule</h3>
		<section class="schedule">
			<? if($reservations == null): ?>
				<div class="content-wrap">
					You don’t have reservation of classes.
				</div>
			<? else: ?>
			<ul>
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
					->where('status', 1)
					->execute('shared');

				//if(count($check_shared) > 0) {
				?>
					<li class="course1">
						<p class="date"><? echo date("d ", $reservation->freetime_at); echo Config::get("statics.months", [])[(int)date("m ", $reservation->freetime_at) - 1];?><span><? echo date("H:i", $reservation->freetime_at); ?></span></p>
						<div class="detail">
							Student：<? if($reservation->student != null) echo $reservation->student->firstname; ?><br />
							<? /* if($reservation->student != null) echo Html::anchor("teachers/students/detail/{$reservation->student_id}", $reservation->student->firstname); */ ?>
							<span class="icon-course1"><?php echo Model_Lessontime::getCourse($reservation->language); ?></span><? if($reservation->language != -1) { ?><?= $reservation->number; ?> / 24 Lessons <? } ?>
						</div>
						<?
						$text = Model_Content::find("first", [
							"where" => [
								["number", $reservation->number],
								["type_id", $reservation->language],
								["text_type_id", 0],
								["deleted_at", 0]
							]
						]);
						if($text != null):
						?>
						<p class="textbook"><?= Html::anchor("contents/{$text->path}", '<i class="fa fa-fw fa-book"></i> ', ["target" => "_blank"]); ?></p>
						<? endif;?>
					</li>
				<? } endforeach; ?>
			</ul>
			<? //endif;?>
		</section>
		<h3>Information</h3>
		<p class="link-more"><a href="/teachers/news">See More <i class="fa fa-angle-right"></i></a></p>
		<section class="feedback">
			<ul class="list-base">
				<? foreach($news as $new): ?>
				<li><a href="/teachers/news/detail/<?= $new->id; ?>">
				<? $is_read = Model_Readnews::find("first", [
						"where" => [
							["user_id" => $user->id],
							["news_id" => $new->id]
						]
					]);
					if($is_read == null): ?><span class="icon-new">NEW</span>
					<? endif; ?><strong><?= $new->title; ?></strong></a>
				</li>
				<? endforeach; ?>
			</ul>
		</section>
	</div>
	<? echo View::forge("teachers/_menu"); ?>
</div>
<script type="text/javascript">
	$(function(){
		getReservation();
		setInterval("getReservation()",10000);
	});
	function getReservation(){
		$.ajax({
			url: '/teachers/api/getreservation.json',
			type: 'POST',
			data: {
			},
			success: function(res) {
				$("#reservation_area").empty();
				$("#reservation_area").hide();
				if(res.reservation != ""){
					if(res.reservation.url != ""){
						$("#reservation_area").append('<p><i class="fa fa-exclamation-circle"></i>Your lesson is already.</p><a class="button yellow right" href="' + res.reservation.url + '" target="_blank" id="lesson_btn"><i class="fa fa-pencil"></i> Go To Lesson Room</a>');
						setInterval(function(){
							$('#lesson_btn').fadeOut(500,function(){$(this).fadeIn(500)});
						},500);
					}else{
						$("#reservation_area").append('<p><i class="fa fa-exclamation-circle"></i>Please set hangout url now</p><a class="button yellow right" href="/teachers/lesson/reserved" id="lesson_btn"><i class="fa fa-pencil"></i>Set hangout url</a>');
					}
					$("#reservation_area").show();
				}
			}
		});
	}
</script>
