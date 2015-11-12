<div id="contents-wrap">
	<div id="main">
		<h3>Lesson Schedule</h3>
		<p>Click on the date you can schedule a lesson</p>
		<p class="calender-notice"><span class="reserved">Reserved lesson</span><span class="selected">Available lesson</span></p>
		<div class="schedule">
			<div id="calendar">
			</div>
			<!-- モーダルウインドウここから -->
			<div data-remodal-id="lesson_time">
				<div class="content lesson-time">
					<h3>Schedule of <span id="schedule_date"></span></h3>
					<p class="calender-notice">
						<span class="reserved">Lesson is booked</span>
						<span class="selected">Lesson is available</span>
						<span class="disabled">Time is not available</span>
					</p>
					<ul class="clearfix">
						<? for($i = 8; $i < 24; $i++): ?>
						<li id="time_<?= $i; ?>"><?= $i; ?>:00 - <?= $i; ?>:45</li>
						<? endfor; ?>
					</ul>
				</div>
			</div>
			<!-- モーダルウインドウここまで -->
		</div>
	</div>
	<? echo View::forge("teachers/_menu"); ?>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
<?= Asset::js("base.js"); ?>
<?= Asset::js("jquery.remodal.js"); ?>
<?= Asset::js("moment-2.8.3.js"); ?>
<?= Asset::js("clndr.js"); ?>
<script type="text/javascript">
	$(function(){
		$('.tiles').tiles(4,'div'); //.tilesの中のdiv
		$('ul.tiles').tiles(4); //ul.tilesの中のli
		var modal = $('[data-remodal-id=lesson_time]').remodal();
		$(document).on('opened', '[data-remodal-id=lesson_time]', function (){
			if($("#schedule_date").html() == ""){
				modal.close();
			}
		});
		var target_date = "";
		var lock = false;
		var cal = $('#calendar').clndr({
			daysOfTheWeek: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
			events: [
				<? foreach($reservations as $reservation): ?>
				{ date: '<?= Date("Y-m-d", $reservation->freetime_at); ?>', status: '<?= $reservation->status;
				?>', hour: '<?= Date("G", $reservation->freetime_at); ?>'},
				<? endforeach; ?>
			],
			clickEvents: {
				click: function(target) {
					if(new Date(target.date._i) - (new Date('<?= Date("Y-m-d"); ?>')) >= 0){
						$(".lesson-time ul li").removeClass("reserved");
						$(".lesson-time ul li").removeClass("selected");
						var date = new Date(target.date._i);
						var months = [
							"Jan",
							"Feb",
							"Mar",
							"Apr",
							"May",
							"Jun",
							"Jul",
							"Aug",
							"Sep",
							"Oct",
							"Nov",
							"Dec"];
							var d = new Date(target.date._i);
							var weekday = new Array(7);
							weekday[0]=  "Sun";
							weekday[1] = "Mon";
							weekday[2] = "Tue";
							weekday[3] = "Wed";
							weekday[4] = "Thu";
							weekday[5] = "Fri";
							weekday[6] = "Sat";
							var n = weekday[d.getDay()];
						$("#schedule_date").html(date.getDate() + " " + months[date.getMonth()] + " " +
							"" + date.getFullYear() +
							" " + "("  + weekday[d.getDay()] + ")");
						for(var i = 0; i < target.events.length; i++){
							if(target.events[i].status == 1){
								$("#time_" + target.events[i].hour).addClass("reserved");
							}else if(target.events[i].status == 3){
								$("#time_" + target.events[i].hour).addClass("disabled");
							}else {
								$("#time_" + target.events[i].hour).addClass("selected");
							}
						}
						target_date = target.date._i;
						modal.open();
					}
				}
			}
		})
		<? foreach($reservations as $reservation): ?>
			<? if($reservation->status == 1): ?>
				$(".calendar-day-<?= Date("Y-m-d", $reservation->freetime_at); ?>").addClass("booked");
			<? endif; ?>
		<? endforeach; ?>
		$(".lesson-time ul li").click(function () {
			var button = $(this);
			if(!button.hasClass("reserved") && !button.hasClass("disabled") && lock == false){
				lock = true;
				$.ajax({
					url: '/teachers/api/reservation.json',
					type: 'POST',
					data: {
						"date": target_date,
						"hour": button.html().split(":")[0]
					},
					complete: function(){
					},
					success: function(res) {
						if(res.code == 200){
							button.addClass("selected");
							cal.addEvents([
								{date: target_date, status: 0, hour: button.html().split(":")[0]}
							]);
						}else if(res.code == 201){
							button.removeClass("selected");
							cal.removeEvents(function(event){
								return (event.date == target_date && event.hour == button.html().split(":")[0]);
							});
						}else if(res.code == 202){
							button.addClass("reserved");
						}
					}
				})
			}
			lock = false;
		});
	});
</script>
