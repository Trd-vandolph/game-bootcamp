<div id="contents-wrap">
	<div id="main">
		<h3><? if(Input::get("id", 0) == 0){
				echo "Add";
			}else{
				echo "Edit";
			} ?> student</h3>
		<section class="content-wrap">
			<form action="" method="post" enctype="multipart/form-data">
				<input type="hidden" id="id" value="<? echo Input::get("id", ""); ?>" />
				<ul class="forms">
					<li>
						<h4>Name</h4>
						<div>
							<input placeholder="First name" name="firstname" type="text" required pattern=".{2,20}" title="must be less than 20 chars" value="<? echo Security::htmlentities(Input::post("firstname", $user->firstname)); ?>">
							<input placeholder="Middle name" name="middlename" type="text" pattern=".{2,20}" title="must be less than 20 chars" value="<? echo Security::htmlentities(Input::post("middlename", $user->middlename)); ?>">
							<input placeholder="Last name" name="lastname" type="text" required pattern=".{2,20}" title="must be less than 20 chars" value="<? echo Security::htmlentities(Input::post("lastname", $user->lastname)); ?>">
						</div>
					</li>
					<li>
						<h4>Email address</h4>
						<div>
							<? if(isset($error)): ?>
								<p class="error"><? echo $error; ?></p>
							<? endif; ?>
							<input name="email" type="email" required value="<? echo Input::post("email", $user->email); ?>">
						</div>
					</li>
					<? if(Input::get("id", 0) == 0): ?>
					<li>
						<h4>Password</h4>
						<div>
							<input name="password" type="password" required pattern="(?=.*\d+.*)(?=.*[a-zA-Z]+.*)+.{8,}" title="must be greater than 7 characters including alphabet and number">greater than 7 characters including alphabet and number
						</div>
					</li>
					<? endif; ?>
					<li>
						<h4>Image</h4>
						<div>
							<? if($user->img_path != "") echo '<img src="/assets/img/pictures/s_'.$user->img_path.'">';?><input type="file" name="upload_file">
						</div>
					</li>
					<li>
						<h4>Gender</h4>
						<div>
							<input name="sex" type="radio" value="0" <? if(Input::post("sex", $user->sex) == 0) echo "checked" ?> >Male
							<input name="sex" type="radio" value="1" <? if(Input::post("sex", $user->sex) == 1) echo "checked" ?> >Female
						</div>
					</li>
					<li>
						<h4>Birthday</h4>
						<div>
							<select name="month" id="month" onchange="dateChange()">
								<?
								$months = Config::get("statics.months", []);

								$birthday = explode("-", $user->birthday);

								for($i = 1; $i <= 12; $i++): ?>
									<option <? if($birthday[1] == $i) echo "selected"; ?> value="<? echo $i; ?>"><? echo $months[$i - 1]; ?></option>
								<? endfor; ?>
							</select>
							<select name="day" id="day">
								<? for($i = 1; $i <= 31; $i++): ?>
									<option <? if($birthday[2] == $i) echo "selected"; ?> value="<? echo $i; ?>"><? echo $i; ?></option>
								<? endfor; ?>
							</select>
							<select name="year" id="year" onchange="dateChange()">
								<? for($i = date("Y")-1; $i >= 1920; $i--): ?>
									<option <? if($birthday[0] == $i) echo "selected"; ?> value="<? echo $i; ?>"><? echo $i; ?></option>
								<? endfor; ?>
							</select>
						</div>
					</li>
					<li>
						<h4>Gmail address</h4>
						<div>
							<input name="google_account" type="text" required pattern=".{2,40}" title="must be less than 40 chars" value="<? echo Input::post("google_account", $user->google_account); ?>">
						</div>
					</li>
					<li>
						<h4>Reservation email</h4>
						<div>
							<input <? if(Input::post("need_reservation_email", $user->need_reservation_email) == 1) echo "checked" ?> name="need_reservation_email" type="radio" value="1">On
							<input <? if(Input::post("need_reservation_email", $user->need_reservation_email) == 0) echo "checked" ?> name="need_reservation_email" type="radio" value="0">Off
						</div>
					</li>
					<li>
						<h4>News email</h4>
						<div>
							<input <? if(Input::post("need_news_email", $user->need_news_email) == 1) echo "checked" ?> name="need_news_email" type="radio" value="1">On
							<input <? if(Input::post("need_news_email", $user->need_news_email) == 0) echo "checked" ?> name="need_news_email" type="radio" value="0">Off
						</div>
					</li>
					<li>
						<h4>Timezone</h4>
						<div>
							<?= View::forge("_timezone",["user" => $user]); ?>
						</div>
					</li>
					<li>
						<h4>Place of Learning</h4>
						<div>
							<select id="place" name="place">
								<option <? if(Input::post("place", $user->place) == 0) echo "selected" ?> value="0">Online School</option>
								<option <? if(Input::post("place", $user->place) == 1) echo "selected" ?> value="1">Grameen Course</option>
							</select>
							<select id="grameen_student" name="grameen_student" hidden>
								<option <? if(Input::post("grameen_student", $user->grameen_student) == 0) echo "selected" ?> value="0">No</option>
								<option <? if(Input::post("grameen_student", $user->grameen_student) == 1) echo "selected" ?> value="1">Yes</option>
							</select>
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

		var place = $('#place');
		var gs = $('#grameen_student');
		var dm = $('.disable-message');
		
		place.on('change', function(){
			gs.val(place.val());
		});
		
		dm.css('textAlign','center');
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