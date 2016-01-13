<?php
	//$feed_1 = 'https://www.google.com/calendar/feeds/grameencompany%40gmail.com/public/basic';
	//$rss_1 = simplexml_load_file($feed_1);

	//$feed_2 = 'https://www.google.com/calendar/feeds/en.bd%23holiday%40group.v.calendar.google.com/public/basic';
	//$rss_2 = simplexml_load_file($feed_2);
?>
<div id="loading">
  <p><?php echo Html::anchor('/students/',Asset::img('logo/icon_b.png', array('width'=> '200','alt'=> 'Game-bootcamp'))); ?></p>
  <img src="/assets/img/loading.gif"></div>
<div id="contents-wrap">
<div id="main">
<? if(($user->place == 1)): ?>
	<h3>Lesson Schedule (Grameen)</h3>
<? else: ?>
	<h3>Lesson Schedule (Home)</h3>
<? endif; ?>
<?
$minutes = '00';
if ($user->timezone == 'India'):
    $minutes = '30';
endif;
	/*$id = $user->id;
	if($user->charge_html != 0 && $user->place == 0):
		DB::query("UPDATE `users` SET `grameen_student` = 0 WHERE `id` = $id")->execute();
	endif;*/
?>
<form action="" method="post" enctype="multipart/form-data">
	<? if($user->place == 1): ?>
		<input name="place" type="radio" value="0" checked hidden>
		<button href="" class="switch" title="Want to study at Home? Then, click this button."><i class="fa fa-undo"></i> Switch to Home Course Calendar</button>
	<? endif; ?>
	<? if($user->place == 0 && $user->grameen_student == 1): ?>
		<input name="place" type="radio" value="1" checked hidden>
		<button href="" class="switch" title="Want to study at Grameen Communications? Then, click this button."><i class="fa fa-undo"></i> Switch to Grameen Course Calendar</button>
	<? endif; ?>
	<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
</form>
<ul class="curriculum">
	<li class="course0 <? if($course == "-1") echo "selected"; ?>"><a href="./add?course=-1">Trial</a></li>
	<li class="course1 <? if($course == "0") echo "selected"; ?>"><a href="./add?course=0">HTML/CSS</a></li>
	<li class="course2 <? if($course == "1") echo "selected"; ?>"><a href="./add?course=1">JavaScript</a></li>
	<?php /* <li class="course3 <? if($course == "2") echo "selected"; ?>"><a href="./add?course=2">PHP</a></li> */?>
</ul>
<? if($user->place == 0): ?>
	<div class="schedule course1"> <!-- calendar for online students starts-->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<?
				$my = "";
				$count = 0;

				$days = "";
				if($my == "") $my = Date("F Y");
				for($i = 0; $i < 10; $i++){

					if($my != Date("F Y", strtotime("+{$i} days"))){
						echo "<th colspan=\"{$count}\">{$my}</th>";
						$my = Date("F Y", strtotime("+{$i} days"));
					}
					$count++;
					$days .= "<th class=\"we\">". Date("D", strtotime("+{$i} days")) . "</th>";
				}
				if($count != 0){
					echo "<th colspan=\"{$count}\">{$my}</th>";
				}
				?>
			</tr>
			</thead>
			<tbody>
			<tr>
				<?= $days; ?>
				<? if($days == 'Fri' OR $days == 'Sat'):?>
					<? continue; ?>
				<? endif; ?>
			</tr>
			<tr>
				<? for($i = 0; $i < 10; $i++): ?>
					<td><?= Date("d", strtotime("+{$i} days")); ?>
						<ul>
							<? for($j = 8; $j < 24; $j++): ?>
								<div  class="remodal" data-remodal-id="<?= "{$i}_{$j}"; ?>">
									<div class="content select-teacher">
										<ul>
											<? foreach($lessons as $lesson): ?>
												<? if(($lesson->teacher->html5 == 1 and $course == "0") or ($lesson->teacher->javascript == 1 and $course == "1")  or ($lesson->teacher->php == 1 and $course == "2") or  ($lesson->teacher->trial == 1 and $course == "-1")): ?>
													<?
													$unixtime = strtotime(Date("Y-m-d {$j}:{$minutes}:00", strtotime("+{$i} days")));

													$currentDay = strtotime(Date("Y-m-d {$j}:{$minutes}:00"));
													$scheduleDay = strtotime(Date("Y-m-d {$j}:{$minutes}:00", $lesson->freetime_at));

													(count($status) == 1 || count($status) > 1) ? $ex_reserve = 1 : $ex_reserve = 0;


													if($lesson->freetime_at == $unixtime):
														?>
														<li class="clearfix">
															<p class="date"><?= Date("M d Y(D)", $lesson->freetime_at); ?> <?= Date("H", $lesson->freetime_at); ?>:00 - <?= Date("H", $lesson->freetime_at); ?>:45</p>
															<? if($scheduleDay == $currentDay): ?>
																<span class="forbid-reservation" style="color: red;"><i>You cannot book a class on this day. Book a class before your reservation day.</i></span>
																<br>
															<? endif; ?>
															<? if($ex_reserve == 1): ?>
																<span style="color: red;"><i>You still have existing reservation or your tutor did not give you feedback yet.</i></span>
																<br>
															<? endif; ?>
															<div class="photo"><img src="/assets/img/pictures/m_<?= $lesson->teacher->getImage(); ?>" width="200" alt=""></div>
															<div class="profile">
																<h3><?= $lesson->teacher->firstname;?> <?= $lesson->teacher->middlename;?> <?= $lesson->teacher->lastname;?></h3>
																<p><?= $lesson->teacher->pr;?></p>
																<? if($reserved == null and ($user->charge_html == 1 or $course == "-1")): ?>
																	<? if(Model_Lessontime::courseNumber_1(Input::get("course", 0)) > count($pasts) && $scheduleDay != $currentDay && $ex_reserve != 1): ?>
																		<p class="button-area"><a class="button right" href="#confirm<?= "{$i}_{$j}"; ?>_<?= $lesson->id; ?>">Booking</a></p>
																		<div  class="remodal" data-remodal-id="confirm<?= "{$i}_{$j}"; ?>_<?= $lesson->id; ?>">
																			<div class="content confirm">
																				<p>Do you want to book this lesson?</p>
																				<div class="button-area">
																					<a href="#<?= "{$i}_{$j}"; ?>" class="button gray">Cancel <i class="fa fa-times"></i></a>
																					<a href="add?course=<?= $course; ?>&id=<?= $lesson->id; ?>" class="button center">Done <i class="fa fa-check"></i></a>
																				</div>
																			</div>
																		</div>
																	<? endif; ?>
																<?php elseif($user->charge_html == 11/* && $course == "0"*/): ?>
																	<? if(Model_Lessontime::courseNumber_2(Input::get("course", 0)) > count($pasts) && $scheduleDay != $currentDay && $ex_reserve != 1): ?>
																		<p class="button-area"><a class="button right" href="#confirm<?= "{$i}_{$j}"; ?>_<?= $lesson->id; ?>">Booking</a></p>
																		<div  class="remodal" data-remodal-id="confirm<?= "{$i}_{$j}"; ?>_<?= $lesson->id; ?>">
																			<div class="content confirm">
																				<p>Do you want to book this lesson?</p>
																				<div class="button-area">
																					<a href="#<?= "{$i}_{$j}"; ?>" class="button gray">Cancel <i class="fa fa-times"></i></a>
																					<a href="add?course=<?= $course; ?>&id=<?= $lesson->id; ?>" class="button center">Done <i class="fa fa-check"></i></a>
																				</div>
																			</div>
																		</div>
																	<? endif; ?>
																<?php elseif($user->charge_html == 111 && $course == "0"): ?>
																	<? if(Model_Lessontime::courseNumber_3(Input::get("course", 0)) > count($pasts) && $scheduleDay != $currentDay && $ex_reserve != 1): ?>
																		<p class="button-area"><a class="button right" href="#confirm<?= "{$i}_{$j}"; ?>_<?= $lesson->id; ?>">Booking</a></p>
																		<div  class="remodal" data-remodal-id="confirm<?= "{$i}_{$j}"; ?>_<?= $lesson->id; ?>">
																			<div class="content confirm">
																				<p>Do you want to book this lesson?</p>
																				<div class="button-area">
																					<a href="#<?= "{$i}_{$j}"; ?>" class="button gray">Cancel <i class="fa fa-times"></i></a>
																					<a href="add?course=<?= $course; ?>&id=<?= $lesson->id; ?>" class="button center">Done <i class="fa fa-check"></i></a>
																				</div>
																			</div>
																		</div>
																	<? endif; ?>
																<?php elseif($user->charge_html == 1111/* && $course == "1"*/): ?>
																	<? if($model_courseNumber > count($pasts) && $scheduleDay != $currentDay && $ex_reserve != 1): ?>
																		<p class="button-area"><a class="button right" href="#confirm<?= "{$i}_{$j}"; ?>_<?= $lesson->id; ?>">Booking</a></p>
																		<div  class="remodal" data-remodal-id="confirm<?= "{$i}_{$j}"; ?>_<?= $lesson->id; ?>">
																			<div class="content confirm">
																				<p>Do you want to book this lesson?</p>
																				<div class="button-area">
																					<a href="#<?= "{$i}_{$j}"; ?>" class="button gray">Cancel <i class="fa fa-times"></i></a>
																					<a href="add?course=<?= $course; ?>&id=<?= $lesson->id; ?>" class="button center">Done <i class="fa fa-check"></i></a>
																				</div>
																			</div>
																		</div>
																	<? endif; ?>
																<? endif; ?>
															</div>
														</li>

													<? endif; ?>
												<? endif; ?>
											<? endforeach; ?>
										</ul>
									</div>
								</div>
								<?
								$class = "unavailable";
								$href = "#";
								$unixtime = strtotime(Date("Y-m-d {$j}:{$minutes}:00", strtotime("+{$i} days")));

								if($reserved != null and $reserved->freetime_at == $unixtime): ?>
									<?
									$href = "#reserved";
									$class = "reserved";
									?>
								<? else: ?>
									<? foreach($lessons as $lesson): ?>
										<? if(($lesson->teacher->html5 == 1 and $course == "0") or ($lesson->teacher->javascript == 1 and $course == "1")  or ($lesson->teacher->php == 1 and $course == "2") or  ($lesson->teacher->trial == 1 and $course == "-1")): ?>
										<? if($lesson->freetime_at == $unixtime){
											$class = "";
											$href = "#{$i}_{$j}";
											break;
										} ?>
										<? endif; ?>
									<? endforeach; ?>
								<? endif; ?>
								<li class="<?= $class; ?>"><a href="<?= $href; ?>" class="boxer"><?= $j; ?>:<?= $minutes; ?></a></li>
							<? endfor; ?>
						</ul>
					</td>

				<? endfor; ?>
			</tr>
			</tbody>
		</table>
		<? if($reserved != null): ?>
			<div  class="remodal" data-remodal-id="reserved">
				<div class="content select-teacher">
					<div class="confirm">
						<p>Your booking is as follows:</p>
						<p class="time"><?= Date("M d Y(D)", $reserved->freetime_at); ?> <?= Date("H", $reserved->freetime_at); ?>:00 - <?= Date("H", $reserved->freetime_at); ?>:45</p>
					</div>
					<ul>
						<li class="clearfix">
							<div class="photo"><img src="/assets/img/pictures/m_<?= $reserved->teacher->getImage(); ?>"
													width="200" alt=""></div>
							<div class="profile">
								<h3><?= $reserved->teacher->firstname;?> <?= $reserved->teacher->middlename;?> <?=
									$reserved->teacher->lastname;?></h3>
								<p><?= $reserved->teacher->pr;?></p>
								<p class="button-area"><a class="button" href="#confirm">Cancel</a></p>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div  class="remodal" data-remodal-id="confirm">
				<div class="content confirm">
					<p>Do you want to cancel this booking?</p>
					<div class="button-area">
						<a href="#reserved" class="button gray">Cancel <i class="fa fa-times"></i></a>
						<a href="add?course=<?= $course; ?>&del_id=<?= $reserved->id; ?>" class="button center">Done <i class="fa fa-check"></i></a>
					</div>
				</div>
			</div>
		<? endif; ?>
	</div> <!-- calendar for online students end -->
<? else: ?>
	<div class="schedule course1"> <!-- calendar for grameen students starts -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<?
				$my = "";
				$count = 0;

				$days = "";
				if($my == "") $my = Date("F Y");
				for($i = 0; $i < 10; $i++){
					if($my != Date("F Y", strtotime("+{$i} days"))){
						echo "<th colspan=\"{$count}\">{$my}</th>";
						$my = Date("F Y", strtotime("+{$i} days"));
						if($my == 'Fri'){
							break;
						}
					}
					$count++;
					$D = Date('D', strtotime("+{$i} days"));
					$days .= "<th class='we " . $D . "'>". $D . "</th>";
				}
				if($count != 0){
					echo "<th colspan=\"{$count}\">{$my}</th>";
				}
				?>
			</tr>
			</thead>
			<tbody>
			<tr>
				<?= $days; ?>
			</tr>
			<tr>
				<? for($i = 0; $i < 10; $i++): ?>
				<td class="<?= Date("D", strtotime("+{$i} days")); ?>"><?= Date("d", strtotime("+{$i} days")); ?>
					<p id="odate"><?= Date("m-j", strtotime("+{$i} days")); ?></p>
					<ul>
						<? for($j = 10; $j < 18; $j++): ?>
							<div  class="remodal" data-remodal-id="<?= "{$i}_{$j}"; ?>">
								<div class="content select-teacher">
									<ul>
										<? foreach($lessons as $lesson): ?>
											<? if(($lesson->teacher->html5 == 1 and $course == "0") or ($lesson->teacher->javascript == 1 and $course == "1")  or ($lesson->teacher->php == 1 and $course == "2") or  ($lesson->teacher->trial == 1 and $course == "-1")): ?>
												<?
												$unixtime = strtotime(Date("Y-m-d {$j}:{$minutes}:00", strtotime("+{$i} days")));

												$currentDay = strtotime(Date("Y-m-d {$j}:{$minutes}:00"));
												$scheduleDay = strtotime(Date("Y-m-d {$j}:{$minutes}:00", $lesson->freetime_at));

												(count($status) == 1 || count($status) > 1) ? $ex_reserve = 1 : $ex_reserve = 0;

												if($lesson->freetime_at == $unixtime):
													?>
													<li class="clearfix">
														<p class="date"><?= Date("M d Y(D)", $lesson->freetime_at); ?> <?= Date("H", $lesson->freetime_at); ?>:00 - <?= Date("H", $lesson->freetime_at); ?>:45</p>
														<? if($scheduleDay == $currentDay): ?>
																<span class="forbid-reservation" style="color: red;"><i>You cannot book a class on this day. Book a class before your reservation day.</i></span>
																<br>
														<? endif; ?>
														<? if($ex_reserve == 1): ?>
																<span style="color: red;"><i>You still have existing reservation or your tutor did not give you feedback yet.</i></span>
																<br>
														<? endif; ?>
														<div class="photo"><img src="/assets/img/pictures/m_<?= $lesson->teacher->getImage(); ?>" width="200" alt=""></div>
														<div class="profile">
															<h3><?= $lesson->teacher->firstname;?> <?= $lesson->teacher->middlename;?> <?= $lesson->teacher->lastname;?></h3>
															<p><?= $lesson->teacher->pr;?></p>
															<? if($reserved == null and ($user->charge_html == 1 or $course == "-1")): ?>
																<? if(Model_Lessontime::courseNumber_1(Input::get("course", 0)) > count($pasts) && $currentDay != $scheduleDay && $ex_reserve != 1): ?>
																	<p class="button-area"><a class="button right" href="#confirm<?= "{$i}_{$j}"; ?>_<?= $lesson->id; ?>">Booking</a></p>
																	<div  class="remodal" data-remodal-id="confirm<?= "{$i}_{$j}"; ?>_<?= $lesson->id; ?>">
																		<div class="content confirm">
																			<p>Do you want to book this lesson?</p>
																			<div class="button-area">
																				<a href="#<?= "{$i}_{$j}"; ?>" class="button gray">Cancel <i class="fa fa-times"></i></a>
																				<a href="add?course=<?= $course; ?>&id=<?= $lesson->id; ?>" class="button center">Done <i class="fa fa-check"></i></a>
																			</div>
																		</div>
																	</div>
																<? endif; ?>
															<?php elseif($user->charge_html == 11/* && $course == "0"*/): ?>
																<? if(Model_Lessontime::courseNumber_2(Input::get("course", 0)) > count($pasts) && $scheduleDay != $currentDay && $ex_reserve != 1): ?>
																	<p class="button-area"><a class="button right" href="#confirm<?= "{$i}_{$j}"; ?>_<?= $lesson->id; ?>">Booking</a></p>
																	<div  class="remodal" data-remodal-id="confirm<?= "{$i}_{$j}"; ?>_<?= $lesson->id; ?>">
																		<div class="content confirm">
																			<p>Do you want to book this lesson?</p>
																			<div class="button-area">
																				<a href="#<?= "{$i}_{$j}"; ?>" class="button gray">Cancel <i class="fa fa-times"></i></a>
																				<a href="add?course=<?= $course; ?>&id=<?= $lesson->id; ?>" class="button center">Done <i class="fa fa-check"></i></a>
																			</div>
																		</div>
																	</div>
																<? endif; ?>
															<?php elseif($user->charge_html == 111/* && $course == "0"*/): ?>
																<? if(Model_Lessontime::courseNumber_3(Input::get("course", 0)) > count($pasts) && $scheduleDay != $currentDay && $ex_reserve != 1): ?>
																	<p class="button-area"><a class="button right" href="#confirm<?= "{$i}_{$j}"; ?>_<?= $lesson->id; ?>">Booking</a></p>
																	<div  class="remodal" data-remodal-id="confirm<?= "{$i}_{$j}"; ?>_<?= $lesson->id; ?>">
																		<div class="content confirm">
																			<p>Do you want to book this lesson?</p>
																			<div class="button-area">
																				<a href="#<?= "{$i}_{$j}"; ?>" class="button gray">Cancel <i class="fa fa-times"></i></a>
																				<a href="add?course=<?= $course; ?>&id=<?= $lesson->id; ?>" class="button center">Done <i class="fa fa-check"></i></a>
																			</div>
																		</div>
																	</div>
																<? endif; ?>
															<?php elseif($user->charge_html == 1111/* && $course == "1"*/): ?>
																<? if($model_courseNumber > count($pasts) && $scheduleDay != $currentDay && $ex_reserve != 1): ?>
																	<p class="button-area"><a class="button right" href="#confirm<?= "{$i}_{$j}"; ?>_<?= $lesson->id; ?>">Booking</a></p>
																	<div  class="remodal" data-remodal-id="confirm<?= "{$i}_{$j}"; ?>_<?= $lesson->id; ?>">
																		<div class="content confirm">
																			<p>Do you want to book this lesson?</p>
																			<div class="button-area">
																				<a href="#<?= "{$i}_{$j}"; ?>" class="button gray">Cancel <i class="fa fa-times"></i></a>
																				<a href="add?course=<?= $course; ?>&id=<?= $lesson->id; ?>" class="button center">Done <i class="fa fa-check"></i></a>
																			</div>
																		</div>
																	</div>
																<? endif; ?>
															<? endif; ?>
														</div>
													</li>
												<? endif; ?>
											<? endif; ?>
										<? endforeach; ?>
									</ul>
								</div>
							</div>
							<?
							$class = "unavailable";
							$href = "#";
							$unixtime = strtotime(Date("Y-m-d {$j}:{$minutes}:00", strtotime("+{$i} days")));

							if($reserved != null and $reserved->freetime_at == $unixtime):
								$href = "#reserved";
								$class = "reserved";
							else: ?>
								<? foreach($lessons as $lesson): ?>
									<? if(($lesson->teacher->html5 == 1 and $course == "0") or ($lesson->teacher->javascript == 1 and $course == "1")  or ($lesson->teacher->php == 1 and $course == "2") or  ($lesson->teacher->trial == 1 and $course == "-1")): ?>
									<? if($lesson->freetime_at == $unixtime){
										$class = "";
										$href = "#{$i}_{$j}";
										break;
									} ?>
									<? endif; ?>
								<? endforeach; ?>
							<? endif;

							//view events on the calendar
							if ($eventdetails != null):
					 			foreach ($eventdetails as $eventdetail):
									if ($eventdetail->start_time == $unixtime || $unixtime < $eventdetail->end_time && $unixtime > $eventdetail->start_time) {
										$href = "#{$eventdetail->id}";
										$class = "events";
							 		}
								endforeach;
							endif; ?>

							<li class="<?= $class; ?>"><a href="<?= $href; ?>" class="boxer"><?= $j; ?>:<?= $minutes; ?></a></li>
						<? endfor; ?>
					</ul>
				</td>
				<? endfor; ?>
			</tr>
			</tbody>
		</table>
		<? if($reserved != null): ?>
			<div  class="remodal" data-remodal-id="reserved">
				<div class="content select-teacher">
					<div class="confirm">
						<p>Your booking is as follows:</p>
						<p class="time"><?= Date("M d Y(D)", $reserved->freetime_at); ?> <?= Date("H", $reserved->freetime_at); ?>:00 - <?= Date("H", $reserved->freetime_at); ?>:45</p>
					</div>
					<ul>
						<li class="clearfix">
							<div class="photo"><img src="/assets/img/pictures/m_<?= $reserved->teacher->getImage(); ?>"
													width="200" alt=""></div>
							<div class="profile">
								<h3><?= $reserved->teacher->firstname;?> <?= $reserved->teacher->middlename;?> <?=
									$reserved->teacher->lastname;?></h3>
								<p><?= $reserved->teacher->pr;?></p>
								<p class="button-area"><a class="button" href="#confirm">Cancel</a></p>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div  class="remodal" data-remodal-id="confirm">
				<div class="content confirm">
					<p>Do you want to cancel this booking?</p>
					<div class="button-area">
						<a href="#reserved" class="button gray">Cancel <i class="fa fa-times"></i></a>
						<a href="add?course=<?= $course; ?>&del_id=<?= $reserved->id; ?>" class="button center">Done <i class="fa fa-check"></i></a>
					</div>
				</div>
			</div>
		<? endif; ?>
		<? if($eventdetails != null): ?>
			<? foreach($eventdetails as $eventdetail): ?>
				<div class="remodal" data-remodal-id="<?= "{$eventdetail->id}"; ?>">
					<div class="modal-event">
						<section class="content-wrap" style="text-align: center;">
							The selected Time and Date will not be available <br>for Booking due to the following details: <br>
							<strong><?= date("H:i A", $eventdetail->start_time); ?> ~ <?= date("H:i A",$eventdetail->end_time); ?></strong>
						</section>
						Event Name: <strong><?= $eventdetail->title; ?></strong><br><br>
						Start Time: <strong><?= date("H:i A", $eventdetail->start_time); ?></strong>
						End Time: <strong><?= date("H:i A",$eventdetail->end_time); ?></strong><br><br>
						Event Details: <br><strong><?= $eventdetail->body; ?></strong>
					</div>
				</div>
			<? endforeach; ?>
		<? endif; ?>
	</div> <!-- calendar for grameen students ends -->
<? endif; ?>
</div>
<? echo View::forge("students/_menu")->set($this->get()); ?>
</div>

<?= Asset::js("base.js"); ?>
<?= Asset::js("jquery.remodal.js"); ?>
<script type="text/javascript">
	$(function(){
		$("ul.curriculum li").click(function () {
			$("ul.curriculum li").removeClass('selected');
			$(this).toggleClass("selected");
		});

		$('.tiles').tiles(4,'div'); //.tilesの中のdiv
		$('ul.tiles').tiles(4); //ul.tilesの中のli
		$(".boxer").boxer();
	});
	$(window).load(function(){
	    $("#loading").fadeOut();
	    $("#contents-wrap").fadeIn();
	});

	//disable friday and saturday
	//$('.Fri').add('.Sat').on('click', function(){ return false; });
	$('.Fri a').add('.Sat a').css({
		'background':'#fff',
		'color':'#ccc',
		'cursor':'default'
	});
	$('.Fri a').add('.Sat a').on('mouseover', function(){
		$(this).css({
			'background':'#ccc',
			'color':'#fff',
			'cursor':'default'
		});
	}, function(){
		$(this).css({
			'background':'#fff',
			'color':'#ccc'
		});
	});
	//switch calendar
	$('.switch').css({
		'float': 'right',
		'position': 'relative',
		'top': '-10px',
		'background': '#9A9492',
		'padding': '10px 15px',
		'borderRadius': '10px',
		'color': 'white',
		'border':'none',
		'fontSize': '14px'
	});
	$('.switch').on('mouseover', function(){
		$(this).css('textDecoration','underline');
	});
	$('.switch').on('mouseout', function(){
		$(this).css('textDecoration','none');
	});

	//modal for Google Calendar Events/Holidays
	//delete for a while
</script>
