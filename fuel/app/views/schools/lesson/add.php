<?php
	$class_id = Input::get('class', 0);

	$classInfo = Model_Classroom::find($class_id);

	$course = Input::get("course", '');
?>
<div id="loading">
	<p><?php echo Html::anchor('/schools/',Asset::img('logo/icon_b.png', array('width'=> '200','alt'=> 'Game-bootcamp'))); ?></p>
	<img src="/assets/img/loading.gif">
</div>
<div id="contents-wrap">
	<div id="main">
        <h3>Lesson Schedule</h3>
		<ul class="curriculum">
			<li class="course0 <? if($course == "-1") echo "selected"; ?>"><a href="./add?course=-1">Trial</a></li>
			<li class="course1 <? if($course == "0") echo "selected"; ?>"><a href="./add?course=0">enchant.js</a></li>
		</ul>
        <?
            $minutes = '00';
            if($user->timezone == 'India' ||
                $user->timezone == 'Afganistan' ||
                $user->timezone == 'Iran' ||
                $user->timezone == 'North Korea' ||
                $user->timezone == 'Myanmar' ||
                $user->timezone == 'Sri Lanka' ||
                $user->timezone == 'Venezuela'):

                $minutes = '30';

            elseif($user->timezone == 'Nepal'):

                $minutes = '45';

            endif;
        ?>

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
								<? for($j = 8; $j <= 24; $j++): ?>
									<div  class="remodal" data-remodal-id="<?= "{$i}_{$j}"; ?>">
										<div class="content select-teacher">
											<!-- Area for deleted codes -->
											<ul>
												<? foreach($lessons as $lesson): ?>
													<? if(($lesson->teacher->enchantJS == 1 and $course == "0") or ($lesson->teacher->trial == 1 and $course == "-1")): ?>
														<? $unixtime = strtotime(Date("Y-m-d {$j}:{$minutes}:00", strtotime("+{$i} days")));
														$currentDay = strtotime(Date("Y-m-d {$j}:{$minutes}:00"));
														$scheduleDay = strtotime(Date("Y-m-d {$j}:{$minutes}:00", $lesson->freetime_at));
														(count($status) == 1 || count($status) > 1) ? $ex_reserve = 1 : $ex_reserve = 0;
														if($lesson->freetime_at == $unixtime): ?>
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
																	<h3>Tutor: <span><?= $lesson->teacher->firstname;?> <?= $lesson->teacher->middlename;?> <?= $lesson->teacher->lastname;?></span></h3>
																	<h3>Class: <span><?= $classInfo->classname; ?></span></h3>

																	<? if($currentDay != $scheduleDay && $ex_reserve != 1): ?>
																		<p class="button-area"><a class="button right" href="#confirm<?= "{$i}_{$j}"; ?>_<?= $lesson->id; ?>">Booking</a></p>
																		<div  class="remodal" data-remodal-id="confirm<?= "{$i}_{$j}"; ?>_<?= $lesson->id; ?>">
																			<div class="content confirm">
																				<p>Do you want to book this lesson?</p>
																				<div class="button-area">
																					<a href="#<?= "{$i}_{$j}"; ?>" class="button gray">Cancel <i class="fa fa-times"></i></a>
																					<a href="add?course=<?= $course; ?>&id=<?= $lesson->id; ?>&class=<?=$class_id; ?>" class="button center">Done <i class="fa fa-check"></i></a>
																				</div>
																			</div>
																		</div>
																	<? endif; ?>
																</div>
															</li>

														<? endif; ?>
													<? endif; ?>
												<? endforeach; ?>
											</ul>

											<!-- Area for deleted codes -->
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
											<? if($lesson->freetime_at == $unixtime){
												$class = "";
												$href = "#{$i}_{$j}";
												break;
											} ?>
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
								<div class="photo"><img src="/assets/img/pictures/m_<?= $reserved->teacher->getImage(); ?>" width="200" alt=""></div>
								<div class="profile">
									<h3><?= $reserved->teacher->firstname;?> <?= $reserved->teacher->middlename;?> <?= $reserved->teacher->lastname;?></h3>
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
		<? endif; ?>
	</div>
	<div  class="remodal" data-remodal-id="unpaid">
		<div class="content unpaid">
			<p id="title-unpaid-message">Some or all student/s on this class has pending payment.</p>
			<div id="title-unpaid-body">
				<span>Unpaid students:</span>
				<ul>
				<? foreach($unpaid as $un): ?>
					<? $stud = Model_User::find($un);
						echo "<li>".$stud->firstname." ".$stud->lastname."</li>";
					?>
				<? endforeach; ?>
				</ul>
				<span>These are the following possible action you can do. Please choose.</span>
				<ul id="unpaid-choices">
					<li><a href="/schools/classroom/">Temporary postpone class. Wait for the student/s to pay.</a></li>
					<li><a href="/schools/lesson/add/?class=<?=$class_id; ?>&course=<?=$course; ?>&remove=1">
							Remove the student/s who are not paying.
						</a></li>
				</ul>
			</div>
		</div>
	</div>
	<? echo View::forge("schools/_menu")->set($this->get()); ?>
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
</script>
