<?php
	$feed_1 = 'https://www.google.com/calendar/feeds/grameencompany%40gmail.com/public/basic';
	$rss_1 = simplexml_load_file($feed_1);

	$feed_2 = 'https://www.google.com/calendar/feeds/en.bd%23holiday%40group.v.calendar.google.com/public/basic';
	$rss_2 = simplexml_load_file($feed_2);
?>
<div id="loading">
  <p><?php echo Html::anchor('/students/',Asset::img('logo/icon_b.png', array('width'=> '200','alt'=> 'OliveCode'))); ?></p>
  <img src="/assets/img/loading.gif"></div>
<div id="contents-wrap">
<div id="main">

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
	<li class="course1 <? if($course == "0") echo "selected"; ?>"><a href="./add?course=0">enchant.js</a></li>
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
							<? for($j = 8; $j <= 24; $j++): ?>
								<div  class="remodal" data-remodal-id="<?= "{$i}_{$j}"; ?>">
									<div class="content select-teacher">
										<ul>
											<? foreach($lessons as $lesson): ?>
												<? if(($lesson->teacher->enchantJS == 1 and $course == "0") or ($lesson->teacher->trial == 1 and $course == "-1")): ?>
													<?
													$unixtime = strtotime(Date("Y-m-d {$j}:00:00", strtotime("+{$i} days")));

													$currentDay = strtotime(Date("Y-m-d {$j}:00:00"));
													$scheduleDay = strtotime(Date("Y-m-d {$j}:00:00", $lesson->freetime_at));

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
																	<? if(Model_Lessontime::courseNumber_1($course) > count($pasts) && $currentDay != $scheduleDay && $ex_reserve != 1):?>
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
																<?php elseif($user->charge_html == 11 && $course == "0"): ?>
																	<? if(Model_Lessontime::courseNumber_2($course) > count($pasts) && $currentDay != $scheduleDay && $ex_reserve != 1): ?>
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
																	<? if(Model_Lessontime::courseNumber_3($course) > count($pasts) && $currentDay != $scheduleDay && $ex_reserve != 1): ?>
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
								$id = '';
								$class = "unavailable";
								$href = "#";
								$unixtime = strtotime(Date("Y-m-d {$j}:00:00", strtotime("+{$i} days")));

								// check if time is reserved from any website
								//reserved from shared start
								$reserved_from_shared = DB::select()
															->from('reservation')
															->where('deleted_at', 0)
															->execute('shared');
								foreach ($reserved_from_shared as $shared) {
									if ($shared['freetime_at'] == $unixtime):
										$href = "#reserved";
										$id = "shared-reserved";
									endif;
								}

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
								<li id="<?= $id; ?>" class="<?= $class; ?>"><a href="<?= $href; ?>" class="boxer"><?= $j; ?>:00</a></li>
							<? endfor; ?>
						</ul>
					</td>

				<? endfor; ?>
			</tr>
			</tbody>
		</table>

		<?

		$reserved_from_shared = DB::select()
									->from('reservation')
									->where('deleted_at', 0)
									->execute('shared');
		foreach ($reserved_from_shared as $shared) {
			//echo $shared['tutor_account']. '<br>';
			echo $shared['freetime_at']. '<br>';
		}

		?>
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
	$("#main table tr:nth-child(2) td p").each(function(){
		<? foreach ($rss_1->entry as $item) {
				$t1 = (string) $item->title;
				$t2 = str_replace(array('&#39;',';',':'), array('_'), $t1);
				$title = str_replace(array(' '), array('-'), $t2);
				$summary = (string) $item->summary;
				$summary2 = explode("\n", $summary);
				$summary = $summary2[0];
				$calendar['event'] = array('title'=>$title,'summary'=>$summary);
				$old = array('Ene','Jan','Peb','Feb','Mar','Mar','Abr','Apr','May','May','Hun','Jun','Hul','Jul','Ago','Aug','Set','Sep','Okt','Oct','Nob','Nov','Dis','Dec');
				$new = array('01','01','02','02','03','03','04','04','05','05','06','06','07','07','08','08','09','09','10','10','11','11','12','12');
				$text = $calendar['event']['summary'];
				$newtext = str_replace($old, $new, $text);
				list($when, $dayWord, $dayNum, $month, $year) = explode(" ", $newtext);
				/*$remove_br = $dayNum . '-' . $month;*/ //online
				 $remove_br = $month . '-' . $dayNum ;  //local
				$ono_br = str_replace('<br>', '', $remove_br);
				$no_br = str_replace(',', '', $ono_br); ?>

				if($(this).text() == '<?= $no_br; ?>'){
					$("#main table tr:nth-child(2) td:contains('<?= $no_br; ?>')").addClass('holiday');
					$('#main table tr:nth-child(2) td.holiday ul li').attr('class','gocal');
					$(this).append("<div class='remodal' data-remodal-id='<?= $title; ?>'><div><section class='content-wrap' style='text-align: center;'>The selected Time and Date will not be available <br>for Booking due to the following details:<br><br><strong>Today is Holiday: <?= str_replace(array('-','_'), array(' '), $title); ?></strong></section><div></div>");
					$("#main table tr:nth-child(2) td:contains('<?= $no_br; ?>')").find('li a').attr('href','#<?= $title; ?>');
				}
		<? } ?>

		<? foreach ($rss_2->entry as $item) {
				$t1 = (string) $item->title;
				$t2 = str_replace(array('&#39;',';',':'), array('_'), $t1);
				$title = str_replace(array(' '), array('-'), $t2);
				$summary = (string) $item->summary;
				$summary2 = explode("\n", $summary);
				$summary = $summary2[0];
				$calendar['event'] = array('title'=>$title,'summary'=>$summary);
				$old = array('Ene','Jan','Peb','Feb','Mar','Mar','Abr','Apr','May','May','Hun','Jun','Hul','Jul','Ago','Aug','Set','Sep','Okt','Oct','Nob','Nov','Dis','Dec');
				$new = array('01','01','02','02','03','03','04','04','05','05','06','06','07','07','08','08','09','09','10','10','11','11','12','12');
				$text = $calendar['event']['summary'];
				$newtext = str_replace($old, $new, $text);
				list($when, $dayWord, $dayNum, $month, $year) = explode(" ", $newtext);
				/* $remove_br = $dayNum . '-' . $month; */ //dev site
				$remove_br = $month . '-' . $dayNum ; //local / real site
				$ono_br = str_replace('<br>', '', $remove_br);
				$no_br = str_replace(',', '', $ono_br);

				//changing Shab e-Barat 06-2 to 06-3 and removing USELESS Google Generated Holidays -.-
				$search = array('06-2','07-26','07-28','07-29','07-30','10-31','05-10');
				$replace = array('06-3','','','','','','');
				$result = str_replace($search, $replace, $no_br); ?>

				if($(this).text() == '<?= $result; ?>'){
					$("#main table tr:nth-child(2) td:contains('<?= $result; ?>')").addClass('holiday');
					$('#main table tr:nth-child(2) td.holiday ul li').attr('class','gocal');
					$(this).append("<div class='remodal' data-remodal-id='<?= $title; ?>'><div><section class='content-wrap' style='text-align: center;'>The selected Time and Date will not be available <br>for Booking due to the following details:<br><br><strong>Today is Holiday: <?= str_replace(array('-','_'), array(' '), $title); ?></strong></section><div></div>");
					$("#main table tr:nth-child(2) td:contains('<?= $result; ?>')").find('li a').attr('href','#<?= $title; ?>');
				}

				//adding Bank Holiday 07-1
				if($(this).text() == '07-1'){
					$("#main table tr:nth-child(2) td:contains('07-1')").addClass('holiday');
					$('#main table tr:nth-child(2) td.holiday ul li').attr('class','gocal');
					$(this).append("<div class='remodal' data-remodal-id='Bank_Holiday'><div><section class='content-wrap' style='text-align: center;'>The selected Time and Date will not be available <br>for Booking due to the following details:<br><br><strong>Today is Holiday: Bank Holiday </strong></section><div></div>");
					$("#main table tr:nth-child(2) td:contains('07-1')").find('li a').attr('href','#Bank_Holiday');
				}

				//adding Eid ul-Adha Day 1 09-24
				if($(this).text() == '09-24'){
					$("#main table tr:nth-child(2) td:contains('09-24')").addClass('holiday');
					$('#main table tr:nth-child(2) td.holiday ul li').attr('class','gocal');
					$(this).append("<div class='remodal' data-remodal-id='Eid_ul_Adha_Day_1'><div><section class='content-wrap' style='text-align: center;'>The selected Time and Date will not be available <br>for Booking due to the following details:<br><br><strong>Today is Holiday: Eid ul-Adha Day 1 </strong></section><div></div>");
					$("#main table tr:nth-child(2) td:contains('09-24')").find('li a').attr('href','#Eid_ul_Adha_Day_1');
				}

				//adding Eid ul-Adha Day 2 09-25
				if($(this).text() == '09-25'){
					$("#main table tr:nth-child(2) td:contains('09-25')").addClass('holiday');
					$('#main table tr:nth-child(2) td.holiday ul li').attr('class','gocal');
					$(this).append("<div class='remodal' data-remodal-id='Eid_ul_Adha_Day_2'><div><section class='content-wrap' style='text-align: center;'>The selected Time and Date will not be available <br>for Booking due to the following details:<br><br><strong>Today is Holiday: Eid ul-Adha Day 2 </strong></section><div></div>");
					$("#main table tr:nth-child(2) td:contains('09-25')").find('li a').attr('href','#Eid_ul_Adha_Day_2');
				}

				//adding Durga Puja (Vijaya Dasami) 10-23
				if($(this).text() == '10-23'){
					$("#main table tr:nth-child(2) td:contains('10-23')").addClass('holiday');
					$('#main table tr:nth-child(2) td.holiday ul li').attr('class','gocal');
					$(this).append("<div class='remodal' data-remodal-id='Durga'><div><section class='content-wrap' style='text-align: center;'>The selected Time and Date will not be available <br>for Booking due to the following details:<br><br><strong>Today is Holiday: Durga Puja (Vijaya Dasami) </strong></section><div></div>");
					$("#main table tr:nth-child(2) td:contains('10-23')").find('li a').attr('href','#Durga');
				}

				//adding Muharram (Ashura) 10-24
				if($(this).text() == '10-24'){
					$("#main table tr:nth-child(2) td:contains('10-24')").addClass('holiday');
					$('#main table tr:nth-child(2) td.holiday ul li').attr('class','gocal');
					$(this).append("<div class='remodal' data-remodal-id='Muharram'><div><section class='content-wrap' style='text-align: center;'>The selected Time and Date will not be available <br>for Booking due to the following details:<br><br><strong>Today is Holiday: Muharram (Ashura) </strong></section><div></div>");
					$("#main table tr:nth-child(2) td:contains('10-24')").find('li a').attr('href','#Muharram');
				}

				//adding Christmas 12-25
				if($(this).text() == '12-25'){
					$("#main table tr:nth-child(2) td:contains('12-25')").addClass('holiday');
					$('#main table tr:nth-child(2) td.holiday ul li').attr('class','gocal');
					$(this).append("<div class='remodal' data-remodal-id='Christmas'><div><section class='content-wrap' style='text-align: center;'>The selected Time and Date will not be available <br>for Booking due to the following details:<br><br><strong>Today is Holiday: Christmas </strong></section><div></div>");
					$("#main table tr:nth-child(2) td:contains('12-25')").find('li a').attr('href','#Christmas');
				}

				//adding Bank Holiday 12-31
				if($(this).text() == '12-31'){
					$("#main table tr:nth-child(2) td:contains('12-31')").addClass('holiday');
					$('#main table tr:nth-child(2) td.holiday ul li').attr('class','gocal');
					$(this).append("<div class='remodal' data-remodal-id='Bank'><div><section class='content-wrap' style='text-align: center;'>The selected Time and Date will not be available <br>for Booking due to the following details:<br><br><strong>Today is Holiday: Bank Holiday </strong></section><div></div>");
					$("#main table tr:nth-child(2) td:contains('12-31')").find('li a').attr('href','#Bank');
				}

				//adding Bangla New Year's Day 04-14
				if($(this).text() == '07-4'){
					$("#main table tr:nth-child(2) td:contains('07-4')").addClass('holiday');
					$('#main table tr:nth-child(2) td.holiday ul li').attr('class','gocal');
					$(this).append("<div class='remodal' data-remodal-id='New_year'><div><section class='content-wrap' style='text-align: center;'>The selected Time and Date will not be available <br>for Booking due to the following details:<br><br><strong>Today is Holiday: Bangla New Year's Day </strong></section><div></div>");
					$("#main table tr:nth-child(2) td:contains('07-4')").find('li a').attr('href','#New_year');
				}
		<? } ?>
	});
</script>
