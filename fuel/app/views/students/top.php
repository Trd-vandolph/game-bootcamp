<?if(Input::get('success', 0) != 0){?>
	<input type="text" id="pay" value="<?=Input::get('success', 0); ?>" hidden/>
<?}?>
<?if(Input::get('pay', 0) != 0){?>
	<input type="text" id="confirm" value="<?=Input::get('pay', 0); ?>" hidden/>
<?}?>
<? if(Input::get('m', 0) == 1){ ?>
	<script>
		alert("You're payment details was been sent already to the admin. Wait for confirmation from the admin. Thank you.");
	</script>
<? } ?>
<div id="contents-wrap">
	<div id="main">
		<? if(count($user->charge_html) < 2 && $user->charge_html == 0 ): ?>
		<section class="notice new-course-proposal content-wrap">
			<p>How did you find a trial lesson? Have a try if you haven't taken it.<br>Proceed to take the course by signing up as paying student if you like our lesson. 　</p>
			<a href="/students/courses" class="button yellow right">Sign up as paying student <i class="fa fa-chevron-right"></i></a>
		</section>
		<? endif; ?>
		<section class="notice content-wrap" style="display: none" id="reservation_area">
		</section>
		<? if(($user->place == 1)): ?>
			<h3>Lesson Schedule (Grameen)</h3>
		<? else: ?>
			<h3>Lesson Schedule (Home)</h3>
		<? endif; ?>
		<section class="schedule">
			<? if($reservations == null): ?>
				<div class="content-wrap">
					You don’t have reservation of classes.
				</div>
			<? else: ?>
			<ul>
				<? foreach($reservations as $reservation): ?>
				<li class="course1">
					<p class="date"><? echo date("d ", $reservation->freetime_at); echo Config::get("statics.months", [])[(int)date("m ", $reservation->freetime_at) - 1];?><span><? echo date("H:i", $reservation->freetime_at); ?></span></p>
					<div class="detail">
						Tutor：<? if($reservation->teacher != null) echo $reservation->teacher->firstname; ?><br />
						<? /* if($reservation->teacher != null) echo Html::anchor("students/teachers/detail/{$reservation->teacher_id}", $reservation->teacher->firstname); */ ?>
						<span class="icon-course1"><?php echo Model_Lessontime::getCourse($reservation->language); ?></span><?= $reservation->number; ?> / 24 Lessons
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
				<? endforeach; ?>
			</ul>
			<? endif; ?>
		</section>
		<!--<h3>Feedback from Teacher</h3>
		<p class="link-more"><a href="#">See More <i class="fa fa-angle-right"></i></a></p>
		<section class="feedback">
			<ul class="list-base">
				<li><a href="#"><span class="icon-course1">Markup Engineer</span><span class="icon-new">NEW</span><strong>20:00 18 AUG</strong> posted by YukikoCho</a></li>
				<li><a href="#"><span class="icon-course2">PHPer</span><span class="icon-new">NEW</span><strong>20:00 18 AUG</strong> posted by YukikoCho</a></li>
				<li><a href="#"><span class="icon-course3">course3</span><span class="icon-new">NEW</span><strong>20:00 18 AUG</strong> posted by YukikoCho</a></li>
				<li><a href="#"><span class="icon-course4">course4</span><strong>20:00 18 AUG</strong> posted by YukikoCho</a></li>
				<li><a href="#"><span class="icon-course5">course5</span><strong>20:00 18 AUG</strong> posted by YukikoCho</a></li>
			</ul>
		</section>
-->
		<h3>Information</h3>
		<p class="link-more"><a href="/students/news">See More <i class="fa fa-angle-right"></i></a></p>
		<section class="feedback">
			<ul class="list-base">
				<? foreach($news as $new): ?>
				<li><a href="/students/news/detail/<?= $new->id; ?>">
						<?
						$is_read = Model_Readnews::find("first", [
							"where" => [
								["user_id" => $user->id],
								["news_id" => $new->id]
							]
						]);
						if($is_read == null): ?><span class="icon-new">NEW</span>
						<? endif; ?><strong><?= $new->title; ?></strong></a></li>
				<? endforeach; ?>
			</ul>
		</section>
	</div>
	<? echo View::forge("students/_menu")->set($this->get()); ?>
</div>
<div id="dialogoverlay"></div>
<div id="dialogbox">
  <div>
    <div id="dialogboxhead"></div>
    <div id="dialogboxbody"></div>
    <div id="dialogboxfoot"></div>
  </div>
</div>
<script type="text/javascript">
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
			window.location="/students/top";
		}
	}
	var Alert = new CustomAlert();

	//end alert

	$(function(){


		getReservation();

		setInterval("getReservation()",10000);

		var paySuccess = $('#pay').val();
		var confirm = $('#confirm').val();

		if(paySuccess == 1) {
			Alert.render("Successfully sent payment information. Once we confirm your photo of receipt, you can now book a lesson.");
		} else if(paySuccess == 2) {
			Alert.render("Thank you for your payment. Once we confirm money comes to our account, you can book a lesson.");
		}

		if(confirm == 1) {
			Alert.render("Payment of this account is already completed. Thank you.");
		}
	});

	function getReservation(){

		$.ajax({
			url: '/students/api/getreservation.json',
			type: 'POST',
			data: {
			},

			success: function(res) {

				$("#reservation_area").empty();
				$("#reservation_area").hide();

				if(res.reservation != ""){
					if(res.reservation.is_ready == true){
						$("#reservation_area").append('<p><i class="fa fa-exclamation-circle"></i>Your teacher is ready. Please click the right button.</p><a class="button yellow right" href="' + res.reservation.url + '" target="_blank" id="lesson_btn"><i class="fa fa-pencil"></i> Go To Lesson Room</a>');
						setInterval(function(){
							$('#lesson_btn').fadeOut(500,function(){$(this).fadeIn(500)});
						},500);
					}else{
						$("#reservation_area").append('<p><i class="fa fa-exclamation-circle"></i>Your lesson will start soon</p>');
					}
					$("#reservation_area").show();
				}
			}
		});
	}
</script>
