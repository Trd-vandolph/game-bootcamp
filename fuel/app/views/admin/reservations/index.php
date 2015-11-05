<div id="contents-wrap">
	<div id="main">
		<h3>Reservations</h3>
		<section class="content-wrap">
			<form action="" method="post" enctype="multipart/form-data">
				<ul class="forms">
					<li><h4>Tutors</h4>
						<div>
							<select name="teacher_id" size="5">
								<? foreach($teachers as $teacher): ?>
									<option value="<? echo $teacher->id; ?>"><? echo $teacher->firstname; ?></option>
								<? endforeach; ?>
							</select>
						</div>
					</li>
					<li><h4>Time</h4>
						<div>
							<select name="month" id="month" onchange="dateChange()">
								<?
								$months = Config::get("statics.months", []);

								for($i = 1; $i <= 12; $i++): ?>
									<option <? if($i == date("m")) echo "selected"; ?> value="<? echo $i; ?>"><? echo $months[$i - 1]; ?></option>
								<? endfor; ?>
							</select>
							<select name="day" id="day">
								<? for($i = 1; $i <= 31; $i++): ?>
									<option <? if($i == date("d")) echo "selected"; ?> value="<? echo $i; ?>"><? echo $i; ?></option>
								<? endfor; ?>
							</select>
							<select name="year" id="year" onchange="dateChange()">
								<? for($i = date("Y"); $i <= date("Y")+1; $i++): ?>
									<option value="<? echo $i; ?>"><? echo $i; ?></option>
								<? endfor; ?>
							</select>
							<select name="hour" id="hour">
								<? for($i = 0; $i <= 23; $i++): ?>
									<option value="<? echo $i; ?>"><? echo $i; ?></option>
								<? endfor; ?>
							</select>:00
						</div>
					</li>
				</ul>
				<p class="button-area">
					<button class="button" href="">Submit <i class="fa fa-chevron-right"></i></button>
				</p>
				<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
			</form>
		</section>
		<div>
			<div style="float: right; margin: 10px;">
				<form action="" method="get" id="search_form">
					<select name="search_teacher" onchange="$('#search_form').submit();">
						<option value="0">All</option>
						<? foreach($teachers as $teacher): ?>
							<option <? if($teacher->id == Input::get("search_teacher", 0)) echo "selected"; ?> value="<? echo $teacher->id; ?>"><? echo $teacher->firstname; ?></option>
						<? endforeach; ?>
					</select>
				</form>
			</div>
			<div style="float: right; margin: 10px;">
				<form action="" method="get" id="search_form">
					<select name="year">
						<option value="0">----</option>
						<? for($i = 2015; $i <= date("Y"); $i++): ?>
							<option <? if($i == Input::get("year", 0)) echo "selected"; ?> value="<?= $i; ?>"><?= $i; ?></option>
						<? endfor; ?>
					</select>
					<select name="month">
						<option value="0">----</option>
						<? for($i = 1; $i <= 12; $i++): ?>
							<option <? if($i == Input::get("month", 0)) echo "selected"; ?> value="<?= $i; ?>"><?= $i; ?></option>
						<? endfor; ?>
					</select>
					<select name="day">
						<option value="0">----</option>
						<? for($i = 1; $i <= 31; $i++): ?>
							<option <? if($i == Input::get("day", 0)) echo "selected"; ?> value="<?= $i; ?>"><?= $i; ?></option>
						<? endfor; ?>
					</select>
					<input type="submit" value="search">
				</form>
			</div>
		</div>
		<table class="table-base" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Lesson at</th>
					<th>lesson</th>
					<th>Status</th>
					<th>Hangout</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<? if($reservations != null): ?>
				<? foreach($reservations as $reservation): ?>
				<tr id="reservation_<? echo $reservation->id; ?>" <? if($reservation->status > 0) echo 'class="reserved"';?>>
					<th class="number"><? echo $reservation->id; ?></th>
					<td class="name">
						<p>Tutor : <span><? echo "{$reservation->teacher->firstname} {$reservation->teacher->middlename} {$reservation->teacher->lastname}"; ?></span></p>
						<p>Student : <span><? if($reservation->student != null) echo "{$reservation->student->firstname} {$reservation->student->middlename} {$reservation->student->lastname}"; ?></span></p>
					</td>
					<td><? echo date("M d, Y. H:i:s", $reservation->freetime_at); ?></td>
					<td>
						<?
							if($reservation->number != 0):
								echo $reservation->number."/12 enchant.js";
							endif;
						?>
					</td>
					<td class="status"><? echo Config::get("statics.reservation_status", [])[$reservation->status]; ?></td>
					<td class="hangout"><a href="<? echo $reservation->url; ?>"><? if($reservation->url != ""){echo "Link"; } ?></a></td>
					<td><button class="button gray right" onclick="deleteReservation(<? echo $reservation->id; ?>)"><i
								class="fa fa-times"></i>
							Delete</button><? echo Html::anchor("admin/reservations/edit/{$reservation->id}", '<i class="fa fa-cog"></i> Edit', [ "style" => "height:14px; line-height:14px", "class" => "button green right"]); ?></td>
				</tr>
				<? endforeach; ?>
			<? endif; ?>
			</tbody>
		</table>
		<? echo $pager ?>
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

	function deleteReservation(id){

		if(confirm('Do you want to delete this reservation?')){
			$.ajax({
				url: '/admin/api/delreservation.json',
				type: 'POST',
				data: {
					"id": id
				},

				complete: function(){

				},
				success: function(res) {
					$("#reservation_" + id).hide();
				}
			})
		}
	}
</script>
