<?php
	$feed_1 = 'https://www.google.com/calendar/feeds/grameencompany%40gmail.com/public/basic';
	$rss_1 = simplexml_load_file($feed_1);
	
	$feed_2 = 'https://www.google.com/calendar/feeds/en.bd%23holiday%40group.v.calendar.google.com/public/basic';
	$rss_2 = simplexml_load_file($feed_2);

?>
<section>
	<div id="contents-wrap">
		<div id="main">
			<p class="view-events"><? echo Html::anchor("grameencom/paying", '<i class="fa fa-money"></i> View Paying Students'); ?></p>
			<p class="view-events"><? echo Html::anchor("grameencom/events/all", '<i class="fa fa-fw fa-calendar"></i> View Created Events'); ?></p>
			
			<h3>Lesson Calender</h3>
			<a name="cal"></a>
			<div id="calendar"></div>
			
			<h3>Students List</h3>
			<table class="table-base course2" width="100%" border="0" cellpadding="0" cellspacing="0">
				<thead>
				<tr>
					<th>Student's Name</th>
					<th>Student's Lesson Chapter</th>
					<th>Student's Lesson Schedule</th>
					<th>Student's Tutor</th>
					<th>Status</th>
				</tr>

				</thead>
				<tbody>
				<? if(count($reservations) != 0): ?>
					<? foreach($reservations as $reservation): ?>
						<tr class="course1">
							<td class="date-width">
								<span class="detail"><? if($reservation->student != null) echo ucwords($reservation->student->firstname . " " . $reservation->student->middlename . " ". $reservation->student->lastname); ?></span>
								<p class="email"><? echo Html::anchor("grameencom/students/detail/{$reservation->student->id}", "View Profile"); ?></p>
							</td>
							<td><span class="icon-course1"><?php echo Model_Lessontime::getCourse($reservation->language); ?></span><?= $reservation->number; ?> / 24 Lessons</td>
							<td><p class="date"><? echo date("A h:i ~ h:45, (D) j M Y ", $reservation->freetime_at); ?></p></td>
							<td>
								<span class="detail"><? if($reservation->teacher != null) echo ucwords($reservation->teacher->firstname . " " . $reservation->teacher->middlename . " ". $reservation->teacher->lastname); ?></span>
								<p class="email"><? echo Html::anchor("#{$reservation->teacher->id}", "View Profile"); ?></p>
							</td>
							<td class="del-width"><span>Reserved</span></td>
						</tr>
					<? endforeach; ?>
				<? endif; ?>
				</tbody>
			</table>
			<h3>Classroom Usage History</h3>
			<table class="table-base course2" width="100%" border="0" cellpadding="0" cellspacing="0">
				<thead>
				<tr>
					<th>Student's Name</th>
					<th>Student's Lesson Chapter</th>
					<th>Student's Lesson Schedule</th>
					<th>Student's Tutor</th>
					<th>Status</th>
				</tr>

				</thead>
				<tbody>
				<? if(count($completed) != 0): ?>
					<? foreach($completed as $complete): ?>
						<tr class="course1">
							<td class="date-width">
								<span class="detail"><? if($complete->student != null) echo ucwords($complete->student->firstname . " " . $complete->student->middlename . " ". $complete->student->lastname); ?></span>
								<p class="email"><? echo Html::anchor("grameencom/students/detail/{$complete->student->id}", "View Profile"); ?></p>
							</td>
							<td><span class="icon-course1"><?php echo Model_Lessontime::getCourse($complete->language); ?></span><?= $complete->number; ?> / 24 Lessons</td>
							<td><p class="date"><? echo date("A h:i ~ h:45, (D) j M Y ", $complete->freetime_at); ?></p></td>
							<td>
								<span class="detail"><? if($complete->teacher != null) echo ucwords($complete->teacher->firstname . " " . $complete->teacher->middlename . " ". $complete->teacher->lastname); ?></span>
								<p class="email"><? echo Html::anchor("#{$complete->teacher->id}", "View Profile"); ?></p>
							</td>
							<td class="del-width"><span>Completed</span></td>
						</tr>
					<? endforeach; ?>
				<? endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</section>
<? foreach($reservations as $reservation): ?>
	<div class="remodal" data-remodal-id="<?= "{$reservation->teacher->id}"; ?>">
		<div id="contents-wrap">
			<div id="main">
				<h3>Profile</h3>
				<div id="contents" class="content-wrap">
					<ul class="tutors_list_l clearfix">
						<li class="<?= ($reservation->teacher->firstname == 'vandolph' || $reservation->teacher->firstname == 'Vandolph') ? 'show' : 'hide'?>">
							<div class="photo">
								<img src="/assets/img/front/tutor_01.png" alt="tutor photo">
							</div>
							<h4>Vandolph C. Reyes</h4>
							<aside>HTML / CSS / JavaScript</aside>
							<div class="text">Van graduated from Southwestern University with a diploma of Bachelor of Science Major in Information Technology. He was awarded as Researcher of the Year, elected as Ambassador President for the whole College of Computer Studies, and consistently on the Dean’s list. After graduation, he became a software engineer specializing in HTML, CSS and JavaScript and has worked on multiple projects of Web application. He is into sports, well rounded, flexible, a good communicator, and a person you can easily get along with.</div>
						</li>
						<li class="<?= ($reservation->teacher->firstname == 'leo alexander' || $reservation->teacher->firstname == 'Leo Alexander') ? 'show' : 'hide'?>">
							<div class="photo">
								<img src="/assets/img/front/tutor_03.jpg" alt="tutor photo">
							</div>
							<h4>Leo Alexander Suganob</h4>
							<aside>HTML / CSS / JavaScript</aside>
							<div class="text">Leo graduated from System Technology Institute with a Diploma in Bachelor of Science in Information Technology. He was once awarded as an Outstanding Senior Programmer of the year by leading a group of programmers during their thesis proposal and was on the Dean's list since his first year of college until he graduated. As a computer enthusiast, he keep seeking and exploring more knowledge about computers, especially in web development. He works as a Web Developer in the Philippines.</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
<? endforeach; ?>
<? foreach($completed as $complete): ?>
	<div class="remodal" data-remodal-id="<?= "{$complete->teacher->id}"; ?>">
		<div id="contents-wrap">
			<div id="main">
				<h3>Profile</h3>
				<div id="contents" class="content-wrap">
					<ul class="tutors_list_l clearfix">
						<li class="<?= ($complete->teacher->firstname == 'vandolph' || $complete->teacher->firstname == 'Vandolph') ? 'show' : 'hide'?>">
							<div class="photo">
								<img src="/assets/img/front/tutor_01.png" alt="tutor photo">
							</div>
							<h4>Vandolph C. Reyes</h4>
							<aside>HTML / CSS / JavaScript</aside>
							<div class="text">Van graduated from Southwestern University with a diploma of Bachelor of Science Major in Information Technology. He was awarded as Researcher of the Year, elected as Ambassador President for the whole College of Computer Studies, and consistently on the Dean’s list. After graduation, he became a software engineer specializing in HTML, CSS and JavaScript and has worked on multiple projects of Web application. He is into sports, well rounded, flexible, a good communicator, and a person you can easily get along with.</div>
						</li>
						<li class="<?= ($complete->teacher->firstname == 'leo alexander' || $complete->teacher->firstname == 'Leo Alexander') ? 'show' : 'hide'?>">
							<div class="photo">
								<img src="/assets/img/front/tutor_03.jpg" alt="tutor photo">
							</div>
							<h4>Leo Alexander Suganob</h4>
							<aside>HTML / CSS / JavaScript</aside>
							<div class="text">Leo graduated from System Technology Institute with a Diploma in Bachelor of Science in Information Technology. He was once awarded as an Outstanding Senior Programmer of the year by leading a group of programmers during their thesis proposal and was on the Dean's list since his first year of college until he graduated. As a computer enthusiast, he keep seeking and exploring more knowledge about computers, especially in web development. He works as a Web Developer in the Philippines.</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
<? endforeach; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
<?= Asset::js("base.js"); ?>
<?= Asset::js("jquery.remodal.js"); ?>
<?= Asset::js("moment-2.8.3.js"); ?>
<?= Asset::js("clndr.js"); ?>
<script type="text/javascript">
$(function(){
	$('#calendar').clndr({
		daysOfTheWeek: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
		startWithMonth: "<?= $ym; ?>-01",
		clickEvents: {
			nextMonth: function(month){
				location.href="/grameencom/top/?ym=<?= date("Y-m", strtotime($ym . "-01 +1 month")); ?>#cal";
			},
			previousMonth: function(month){
				location.href="/grameencom/top/?ym=<?= date("Y-m", strtotime($ym . "-01 -1 month")); ?>#cal";
			},
			click: function(target){
				var ymd = target.date._i.split("-");
				var path = "/grameencom/reservations/?year=" + ymd[0] + "&month=" + ymd[1] + "&day=" + ymd[2];
				location.href = path;
			}
		}
	})
	<?
	$days = [];
	$events = [];
	$dayevt = [];
	for($i = 0; $i <=  date("t", strtotime($ym . "-01")); $i++){
		$days[$i] = 0;
	}
	for($y = 0; $y <=  date("t", strtotime($ym . "-01")); $y++){
		$events[$y] = 0;
	}
	for($z = 0; $z <=  date("t", strtotime($ym . "-01")); $z++){
		$dayevt[$z] = 0;
	}
	$r = 0;
	foreach($reservations as $reservation){
		$days[date("j", $reservation->freetime_at)]++;
		$reserveday[$r] = date("Y-m-d", $reservation->freetime_at);
		$reserveid[$r] = $reservation->id;
		$reserveinfo[$r] = $reserveday[$r]."-".$reserveid[$r];
		$r++;
	}
	$rE = 0;
 	foreach($readevents as $readevent){
 		$events[date("j", $readevent->start_time)]++;
 		$eventday[$rE] = date("Y-m-d", $readevent->start_time);
 		$eventid[$rE] = $readevent->id;
 		$eventinfo[$rE] = $eventday[$rE]."-".$eventid[$rE];
 		$rE++;
 	}
 	$a = 0;
 	foreach($dayevents as $dayevent){
 		$dayevt[date("j", $dayevent->allday)]++;
 		$alldate[$a] = date("Y-m-d", $dayevent->allday);
 		$allid[$a] = $dayevent->id;
 		$info[$a] = $alldate[$a]."-".$allid[$a];
 		$a++;
 	}
	?>
	<? for($i = 1; $i <=  date("t", strtotime($ym . "-01")); $i++): ?>
	
		<? if($i < 10){
			$d = "0{$i}";
		}else{
			$d = $i;
		} ?>

		$(".calendar-day-<?= "{$ym}-$d" ?> > .day-contents").after('<div class="class-number reserved"><?= ($days[$i] != 0) ? $days[$i] . ' reservation ' : ''; ?></div>');
		$(".calendar-day-<?= "{$ym}-$d" ?> > .day-contents").after('<div class="class-number events"><?= ($events[$i] != 0) ? $events[$i] . ' event/s found ' : ''; ?></div>');
		$(".calendar-day-<?= "{$ym}-$d" ?> > .day-contents").after('<div class="class-number w-day"><?= ($dayevt[$i] != 0) ? ' Whole Day Event ' : ''; ?></div>');
		<?
			$gnow = $ym."-".$d;
			$gdivide = explode("-", $gnow);
			$gyear = $gdivide[0];
			$gmonth = $gdivide[1];
			$gday = $gdivide[2];
		?>
		$(".calendar-day-<?= "{$ym}-$d" ?> > .day-contents").after('<div id="edate"><?= $gmonth . '-' . (int) $gday; ?></div>');
		$(".calendar-day-<?= "{$ym}-$d" ?>").each(function(){
			<? foreach ($rss_1->entry as $item) {
					$title = (string) $item->title;
					$summary = (string) $item->summary;
					$summary2 = explode("\n", $summary);
					$summary = $summary2[0];
					$calendar['event'] = array('title'=>$title,'summary'=>$summary);
					$old = array('Ene','Jan','Peb','Feb','Mar','Mar','Abr','Apr','May','May','Hun','Jun','Hul','Jul','Ago','Aug','Set','Sep','Okt','Oct','Nob','Nov','Dis','Dec');
					$new = array('01','01','02','02','03','03','04','04','05','05','06','06','07','07','08','08','09','09','10','10','11','11','12','12');
					$text = $calendar['event']['summary'];
					$newtext = str_replace($old, $new, $text);
					list($when, $dayWord, $dayNum, $month, $year) = explode(" ", $newtext);
					/* $remove_br = $dayNum . '-' . $month;*/ //dev site
					$remove_br = $month . '-' . $dayNum; //local / real site
					$ono_br = str_replace('<br>', '', $remove_br);
					$no_br = str_replace(',', '', $ono_br); ?>
				
					if($(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").text() == '<?= $no_br; ?>'){
						$(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").after("<div class='gracal'><?= $title; ?></div>");
						$(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").attr('class','edate');
						$(".calendar-day-<?= "{$ym}-$d" ?>").on('click', function(){ return false; });
					}
			<? } ?>
		
			<? foreach ($rss_2->entry as $item) {
					$title = (string) $item->title;
					$summary = (string) $item->summary;
					$summary2 = explode("\n", $summary);
					$summary = $summary2[0];
					$calendar['event'] = array('title'=>$title,'summary'=>$summary);
					$old = array('Ene','Jan','Peb','Feb','Mar','Mar','Abr','Apr','May','May','Hun','Jun','Hul','Jul','Ago','Aug','Set','Sep','Okt','Oct','Nob','Nov','Dis','Dec');
					$new = array('01','01','02','02','03','03','04','04','05','05','06','06','07','07','08','08','09','09','10','10','11','11','12','12');
					$text = $calendar['event']['summary'];
					$newtext = str_replace($old, $new, $text);
					list($when, $dayWord, $dayNum, $month, $year) = explode(" ", $newtext);
					/*$remove_br = $dayNum . '-' . $month;*/ //dev site
					$remove_br = $month . '-' . $dayNum ; //local / real site
					$ono_br = str_replace('<br>', '', $remove_br);
					$no_br = str_replace(',', '', $ono_br);
					
					//changing Shab e-Barat 06-2 to 06-3 and removing USELESS Google Generated Holidays -.-
					$search = array('06-2','07-26','07-28','07-29','07-30','10-31','05-10');
					$replace = array('06-3','','','','','','');
					$result = str_replace($search, $replace, $no_br); ?>
					
					if($(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").text() == '<?= $result; ?>'){
						$(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").after("<div class='gracal'><?= $title; ?></div>");
						$(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").attr('class','edate');
						$(".calendar-day-<?= "{$ym}-$d" ?>").on('click', function(){
							return false;
						});
					}

					//adding Bank Holiday 07-1
					if($(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").text() == '07-1'){
						$(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").after("<div class='gracal'>Bank Holiday</div>");
						$(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").attr('class','edate');
						$(".calendar-day-<?= "{$ym}-$d" ?>").on('click', function(){
							return false;
						});
					}

					//adding Eid ul-Adha Day 1 09-24
					if($(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").text() == '09-24'){
						$(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").after("<div class='gracal'>Eid ul-Adha Day 1</div>");
						$(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").attr('class','edate');
						$(".calendar-day-<?= "{$ym}-$d" ?>").on('click', function(){
							return false;
						});
					}
					//adding Eid ul-Adha Day 2 09-25
					if($(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").text() == '09-25'){
						$(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").after("<div class='gracal'>Eid ul-Adha Day 2</div>");
						$(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").attr('class','edate');
						$(".calendar-day-<?= "{$ym}-$d" ?>").on('click', function(){
							return false;
						});
					}
					//adding Durga Puja ( Vijaya Dasami ) 10-23
					if($(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").text() == '10-23'){
						$(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").after("<div class='gracal'>Durga Puja (Vijaya Dasami)</div>");
						$(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").attr('class','edate');
						$(".calendar-day-<?= "{$ym}-$d" ?>").on('click', function(){
							return false;
						});
					}
					//adding Muharram(Ashura) 10-24
					if($(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").text() == '10-24'){
						$(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").after("<div class='gracal'>Muharram(Ashura)</div>");
						$(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").attr('class','edate');
						$(".calendar-day-<?= "{$ym}-$d" ?>").on('click', function(){
							return false;
						});
					}
					//adding Christmas 12-25
					if($(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").text() == '12-25'){
						$(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").after("<div class='gracal'>Christmas</div>");
						$(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").attr('class','edate');
						$(".calendar-day-<?= "{$ym}-$d" ?>").on('click', function(){
							return false;
						});
					}
					//adding Bank Holiday 12-31
					if($(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").text() == '12-31'){
						$(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").after("<div class='gracal'>Bank Holiday</div>");
						$(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").attr('class','edate');
						$(".calendar-day-<?= "{$ym}-$d" ?>").on('click', function(){
							return false;
						});
					}
					//adding Bangla New Year's Day 04-14
					if($(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").text() == '04-14'){
						$(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").after("<div class='gracal'>Bangla New Year's Day</div>");
						$(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").attr('class','edate');
						$(".calendar-day-<?= "{$ym}-$d" ?>").on('click', function(){
							return false;
						});
					}
			<? } ?>
		});
		
		//add information
		$('.clndr-controls').add('table.table-base.course2 th').css('background','#7E9E42');
		$('.info').css('background','#7E9E42');
		
		$(".calendar-day-<?= "{$ym}-$d" ?>").on('mouseenter', function(){
			<? 
			$now = $ym."-".$d;
			$unix = strtotime($now);
			$divide = explode("-", $now);
			$year = $divide[0];
			$month = $divide[1];
			$day = $divide[2];
			
			$createLink = "/grameencom/reservations/?year=".$year."&month=".$month."&day=".$day;
			$viewres = "/grameencom/reservations/view/?year=".$year."&month=".$month."&day=".$day;
			$viewevents = "/grameencom/events/?year=".$year."&month=".$month."&day=".$day;
			
			$rsv = 0;
			foreach($reservations as $res){
				if($res->freetime_at == $unix){
					$resDate[$rsv] = $res->freetime_at;
					$rsv++;
				}
			}
			
			$evt = 0;
			foreach($readevents as $revt){
				$rEvent = date("Y-m-d", $revt->start_time);
				if(strtotime($rEvent) == $unix){
					$evtDate[$evt] = $revt->start_time;
					$evt++;
				}
			}

			if(isset($reserveinfo)){
				$r_count = count($reserveinfo);
				foreach($reserveinfo as $rinfo){
					$r_pieces = explode("-", $rinfo);
					$r_date = $r_pieces[0]."-".$r_pieces[1]."-".$r_pieces[2];
					$r_id = $r_pieces[3];
					
					if($now == $r_date && $r_count >=$r){?>
						$('.calendar-day-<?= $now; ?> .class-number').css('display','none');
						$('.calendar-day-<?= $now; ?> .day-contents').css('float','right');

						<? if($evt>0){ ?>
							$(this).append('<p class="view-event1"><a href="<?=$viewevents;?>">View Event/s</a></p>');
							$(this).append('<p class="view-event2"><a href="<?=$viewres; ?>">View Reservation</a></p>');
							$(this).append('<p><a href="<?=$createLink; ?>">Create New Event</a></p>');
							$('.view-event1').css('marginTop','15px');
						<? }else{ ?>
							$(this).append('<p class="view-event2"><a href="<?=$viewres; ?>">View Reservation</a></p>');
							$(this).append('<p><a href="<?=$createLink; ?>">Create New Event</a></p>');
							$('.view-event2').css('margin-top','40px');
						<? } ?>
							
						
						$(a).css('cursor','pointer');
					<?}
				}
			}
			if(isset($eventinfo)){
				$rE_count = count($eventinfo);
				foreach($eventinfo as $einfo){
					$rE_pieces = explode("-", $einfo);
					$rE_date = $rE_pieces[0]."-".$rE_pieces[1]."-".$rE_pieces[2];
					$rE_id = $rE_pieces[3];
					$rE_link = "/grameencom/events/edit/".$rE_id;
					
					if($now == $rE_date && $rE_count >=$rE){?>
						$('.calendar-day-<?= $now; ?> .class-number').css('display','none');
						$(this).append('<p><a href="<?=$viewevents;?>">View Event/s</></>');
						$(this).append('<p><a href="<?=$createLink; ?>">Create New Event</></>');
						$(a).css('cursor','pointer');
					<?}
				}
			}
			if(isset($info)){
				$count = count($info);
				foreach($info as $infos){
					$pieces = explode("-", $infos);
					$date = $pieces[0]."-".$pieces[1]."-".$pieces[2];
					$id = $pieces[3];
					$link = "/grameencom/events/edit/".$id;
						
						if($now == $date && $count >= $a){?>
							$('.calendar-day-<?= $now; ?> .class-number').css('display','none');
							$(this).append('<p><a href="<?=$link;?>">Edit this event</></>');
							$(this).append('<p><a href="<?=$viewevents;?>">View Event</></>');
							$(a).css('cursor','pointer');
						<?}
					}
				}
			?>
			
		});
		$(".calendar-day-<?= "{$ym}-$d" ?>").on('mouseenter', function(){
			$(this).each(function(){
				if(!($(".calendar-day-<?= $ym . '-' .$d; ?> > #edate").hasClass('edate'))){
					$('.calendar-day-<?= $now; ?> .class-number').css('display','none');
					$(this).append('<p>Create New Event</>');
					$(this).css('cursor','pointer');
				}
			});
		});
		$(".calendar-day-<?= "{$ym}-$d" ?>").on('mouseleave', function(){
			$('.calendar-day-<?= "{$ym}-$d" ?> .class-number').css('display','block');
			$('.calendar-day-<?= $now; ?> .day-contents').css('float','none');
			$('.view-event').css('marginTop','0');
			$('.calendar-day-<?= "{$ym}-$d" ?> > p').remove();
		});	

		$(".calendar-day-<?= "{$ym}-$d" ?>").on('', function(){
			});
	<? endfor; ?>

 	$('.whole-day').on('click' ,function(){
		if ($('.checkbox').is(':checked')) {
			$('.time').attr('disabled','disabled');
		} else {
			$('.time').removeAttr('disabled');
		}
	});
	//tutors modal
	$('.hide').css('display','none');
	$('.show').css('display','block');
	$('ul.tutors_list_l li').css({
		'width':'auto',
		'float':'none',
		'textAlign':'left'
	});

	//remove duplicate titles
	$('tr td .gracal').filter(function () { return $(this).prev('.gracal').length }).hide();
});
</script>
