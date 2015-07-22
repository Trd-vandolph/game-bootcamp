<div id="contents-wrap">
	<div id="main">
		<h3>Reservation</h3>
		<section class="content-wrap">
			<?= $error ?>
			<form action="" method="post" enctype="multipart/form-data">
				<ul class="forms">
					<li>
						<h4>Teacher</h4>
						<div>
							<select name="teacher_id" size="10">
								<? foreach($teachers as $teacher): ?>
									<option <? if($teacher->id == $reservation->teacher_id) echo "selected"; ?> value="<? echo $teacher->id; ?>"><? echo $teacher->firstname; ?></option>
								<? endforeach; ?>
							</select>
						</div>
					</li>
					<li>
						<h4>Student</h4>
						<div>
							<select name="student_id" size="10">
								<option value="0">None</option>
								<? foreach($students as $student): ?>
									<option <? if($student->id == $reservation->student_id) echo "selected"; ?> value="<? echo $student->id; ?>"><? echo $student->firstname; ?></option>
								<? endforeach; ?>
							</select>
						</div>
					</li>
					<li>
						<h4>Time</h4>
						<div>
							<select name="month" id="month" onchange="dateChange()">
								<?

								$datetime = explode("-", date("Y-m-d-H-i", $reservation->freetime_at));

								$months = Config::get("statics.months", []);

								for($i = 1; $i <= 12; $i++): ?>
									<option <? if($i == $datetime[1]) echo "selected"; ?> value="<? echo $i; ?>"><? echo $months[$i - 1]; ?></option>
								<? endfor; ?>
							</select>
							<select name="day" id="day">
								<? for($i = 1; $i <= 31; $i++): ?>
									<option <? if($i == $datetime[2]) echo "selected"; ?> value="<? echo $i; ?>"><? echo $i; ?></option>
								<? endfor; ?>
							</select>
							<select name="year" id="year" onchange="dateChange()">
								<? for($i = date("Y"); $i <= date("Y")+1; $i++): ?>
									<option <? if($i == $datetime[0]) echo "selected"; ?> value="<? echo $i; ?>"><? echo $i; ?></option>
								<? endfor; ?>
							</select>
							<select name="hour" id="hour">
								<? for($i = 0; $i <= 23; $i++): ?>
									<option <? if($i == $datetime[3]) echo "selected"; ?> value="<? echo $i; ?>"><? echo $i; ?></option>
								<? endfor; ?>
							</select>:00
						</div>
					</li>
					<li>
						<h4>Language</h4>
						<div>
							<select name="language">
								<option value="-1" <? if($reservation->language == -1) echo "selected";?>>Trial</option>
							<? $i = 0; foreach(Config::get("statics.content_types", []) as $language): ?>
								<option value="<?= $i; ?>" <? if($reservation->language == $i++) echo "selected"; ?>><?= $language; ?></option>
							<? endforeach; ?>
							</select>
						</div>
					</li>
					<li>
						<h4>Status</h4>
						<div>
							<? echo Config::get("statics.reservation_status", [])[$reservation->status]; ?>
						</div>
					</li>
					<li>
						<h4>Hangout url</h4>
						<div>
							<input type="text" name="url" value="<? echo $reservation->url; ?>">
						</div>
					</li>
				</ul>
			<p class="button-area">
				<button class="button" href="">Submit <i class="fa fa-chevron-right"></i></button>
			</p>
			<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
			</form>
		</section>

	</div>
	<? echo View::forge("admin/_menu"); ?>
</div>
<script>

	$(document).ready(function(){
		dateChange();
	});

	function dateChange(){
		var date = new Date($("#year").val(), $("#month").val(), 0);
		var selected_day = $("#day").val();
		var day_max = date.getDate();
		$("#day").empty();
		for(var i = 1; i <= day_max; i++){
			if(i == selected_day){
				$("#day").append('<option value="' + i + '" selected>' + i + '</option>');
			}else{
				$("#day").append('<option value="' + i + '">' + i + '</option>');
			}
		}
	}
</script>