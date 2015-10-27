<?
	if(Input::get('pay', 0)==1){
		$paid = 1;?>
		<input type="text" id="paid" value="<?=$paid ?>" hidden />
<? }?>
<?	if(Input::get('s', 0) == 1){?>
		<input type="text" id="cancelSuccess" value="<?=Input::get('s', 0); ?>" hidden />
<? }?>
<div id="contents-wrap">
	<div id="main">
    <h3>Contact from Students</h3>
    <p class="link-more"><? echo Html::anchor('/admin/contactforum', 'See Contact <i class="fa fa-angle-right"></i>'); ?></p>
    <section class="feedback">
      <ul class="list-base">
		  <? foreach($contacts as $contact): ?>
        <li>
					<a href="/admin/contactforum/detail/<?= $contact->id; ?>">
						<? if($contact->is_read == 0): ?>
								<span class="icon-new">New</span>
						<? endif; ?>
						<?= $contact->title; ?>
						<strong>
							<?= date("H:i M d, Y.", $contact->created_at); ?>
						</strong>
							posted by
							<?= $contact->user->firstname; ?>
							<?= $contact->user->middlename; ?>
							<?= $contact->user->lastname; ?>
					</a>
				</li>
		  <? endforeach; ?>
      </ul>
    </section>

    <h3>Lesson Calender</h3>
	<a name="cal"></a>
    <div id="calendar">
    </div>
	</div>
	<? echo View::forge("admin/_menu"); ?>
</div>
<div id="dialogoverlay"></div>
<div id="dialogbox">
  <div>
    <div id="dialogboxhead"></div>
    <div id="dialogboxbody"></div>
    <div id="dialogboxfoot"></div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
<?= Asset::js("base.js"); ?>
<?= Asset::js("jquery.remodal.js"); ?>
<?= Asset::js("moment-2.8.3.js"); ?>
<?= Asset::js("clndr.js"); ?>
<script type="text/javascript">
$(function(){
	var paid = $('#paid').val();
	var cancelSuccess = $('#cancelSuccess').val();

	if(paid == 1){
		Alert.render("Successfully confirmed student's payment.");
	}

	if(cancelSuccess == 1) {
		Alert.render("Successfully cancelled student's payment.");
	}

	$('#calendar').clndr({
		daysOfTheWeek: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
		startWithMonth: "<?= $ym; ?>-01",
		clickEvents: {
				nextMonth: function(month){
					location.href="/admin/top/?ym=<?= date("Y-m", strtotime($ym . "-01 +1 month")); ?>#cal";
				},
				previousMonth: function(month){
					location.href="/admin/top/?ym=<?= date("Y-m", strtotime($ym . "-01 -1 month")); ?>#cal";
				},
				click: function(target){
					var ymd = target.date._i.split("-");
					location.href="/admin/reservations/?year=" + ymd[0] + "&month=" + ymd[1] + "&day=" + ymd[2];
				}


		}
	})

	<?
	$days = [];
	for($i = 0; $i <=  date("t", strtotime($ym . "-01")); $i++){
		$days[$i] = 0;
	}
	foreach($reservations as $reservation){
		$days[date("j", $reservation->freetime_at)]++;
	}
	?>
	<? for($i = 1; $i <=  date("t", strtotime($ym . "-01")); $i++): ?>
	<? if($i < 10){
		$d = "0{$i}";
	}else{
		$d = $i;
	} ?>
	$(".calendar-day-<?= "{$ym}-$d" ?> > .day-contents").after('<div class="class-number"><?= $days[$i]; ?></div>');
	<? endfor; ?>

});

//custom alert

function CustomAlert(){
	this.render = function(dialog){
		var winW = window.innerWidth;
		var winH = window.innerHeight;
        var dialogoverlay = document.getElementById('dialogoverlay');
        var dialogbox = document.getElementById('dialogbox');
        dialogoverlay.style.display = "block";
        dialogoverlay.style.height = winH+"px";
        dialogbox.style.left = (winW/2) - (550 * .5)+"px";
        dialogbox.style.top = "100px";
        dialogbox.style.display = "block";
        document.getElementById('dialogboxhead').innerHTML = "<strong>Acknowledge This Message</strong>";
        document.getElementById('dialogboxbody').innerHTML = dialog;
        document.getElementById('dialogboxfoot').innerHTML = '<button onclick="Alert.ok()">OK</button>';
    }
	this.ok = function(){
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
		window.location="/admin/top";
	}
}
var Alert = new CustomAlert();

//end alert
</script>
