<div id="contents-wrap">
	<div id="main">
		<h3><?= $user->firstname; ?> <?= $user->middlename; ?> <?= $user->lastname; ?></h3>
		<p class="link-more"><? echo Html::anchor("admin/students/add?id={$user->id}", '<i class="fa fa-plus-circle"></i>Edit'); ?></p>
		<section class="content-wrap">
				<ul class="forms">
					<li><h4>Name</h4>
						<div>
							<?= $user->firstname; ?> <?= $user->middlename; ?> <?= $user->lastname; ?>
						</div>
					</li>
					<li><h4>Email address</h4>
						<div>
							<? echo $user->email ?>
						</div>
					</li>
					<li><h4>Image</h4>
						<div>
							<? if($user->img_path != "") echo '<img src="/assets/img/pictures/s_'.$user->img_path.'">';?>
						</div>
					</li>
					<li><h4>Nationality</h4>
						<div>
							<? echo $user->nationality; ?>
						</div>
					</li>
					<li><h4>Gender</h4>
						<div>
							<? echo Config::get("statics.sex", [])[$user->sex]; ?>
						</div>
					</li>
					<li><h4>Birthday</h4>
						<div>
							<? echo date("M d, Y.", strtotime($user->birthday)); ?>
						</div>
					</li>
					<li><h4>Gmail address</h4>
						<div>
							<? echo $user->google_account ?>
						</div>
					</li>
					<li><h4>Reservation email</h4>
						<div>
							<? echo Config::get("statics.on_off", [])[$user->need_reservation_email]; ?>
						</div>
					</li>
					<li><h4>News email</h4>
						<div>
							<? echo Config::get("statics.on_off", [])[$user->need_news_email]; ?>
						</div>
					</li>
					<li><h4>Timezone</h4>
						<div>
							<? echo $user->timezone; ?>
						</div>
					</li>
					<li><h4>Place of Learning</h4>
						<div>
							<? echo ($user->place == 1) ? "Grameen Course" : "Online School"; ?>
						</div>
					</li>
					<p class="button-area">
						<? echo Html::anchor("admin/students/changepassword/{$user->id}", 'Change password', ["class" => "button"]); ?>
					</p>
				</ul>
		</section>
		<ul class="histories">
			<? if($reservations != null): ?>
				<? foreach($reservations as $reservation): ?>
					<li id="reservation_<? echo $reservation->id; ?>" class="course<?= ($reservation->language + 1); ?>">
						<div class="clearfix">
							<h4><?php echo Model_Lessontime::getCourse($reservation->language); ?> <span>Lesson <? echo $reservation->number; ?></span></h4>
							<p class="date"><? echo date("M d, Y. H:i:s", $reservation->freetime_at); ?></p>
						</div>
						<p class="teacher">Teacher : <? if($reservation->teacher != null) echo Html::anchor("students/teachers/detail/{$reservation->teacher_id}", $reservation->teacher->firstname); ?></p>
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
	</div>
	<? echo View::forge("admin/_menu"); ?>
</div>
