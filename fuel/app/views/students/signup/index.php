<div id="contents-wrap">
	<div id="main">
	<? $g=Input::GET('g',0); ?>	
		<?php echo Uri::segment(3); ?>
		<h3>Signup<? if($g==1){echo "&nbsp;<font style='color: red;'>(Grameen Course)</font>"; } else { echo "&nbsp;<font style='color: red;'>(Home Course)</font>"; } ?></h3>
		<section class="content-wrap">
			<form action="" method="post" enctype="multipart/form-data">
				<input type="hidden" id="id" value="<? echo Input::get("id", ""); ?>" />
				<ul class="forms">
					<li>
						<h4>Name</h4>
						<div>
							<input placeholder="First name" name="firstname" type="text" required pattern=".{2,20}" style="width: 120px" title="must be less than 20 chars" value="<? echo Session::get_flash("firstname", ""); ?>">
							<input placeholder="Middle name" name="middlename" type="text"  pattern=".{2,20}" style="width: 120px" title="must be less than 20 chars" value="<? echo Session::get_flash("middlename", ""); ?>">
							<input placeholder="Last name" name="lastname" type="text" required pattern=".{2,20}" style="width: 120px" title="must be less than 20 chars" value="<? echo Session::get_flash("lastname", ""); ?>">
						</div>
					</li>
					<li>
						<h4>Email address</h4>
						<div>
							<? if(isset($errors)): ?>
								<? foreach($errors as $error): ?>
									<p class="error"><? echo $error; ?></p>
								<? endforeach; ?>
							<? endif; ?>
							<input name="email" type="email" required value="<? echo Session::get_flash("email", ""); ?>" style="width:300px;">
						</div>
					</li>
					<li>
						<h4>Password</h4>
						<div>
							<input name="password" type="password" required pattern="(?=.*\d+.*)(?=.*[a-zA-Z]+.*)+.{8,}" title="must be greater than 7 characters including alphabet and number">
							<aside>greater than 7 characters including alphabet and number</aside>
						</div>
					</li>
					<li>
						<h4>Gender</h4>
						<div>
							<label for="sex_m">
								<input id="sex_m" name="sex" type="radio" value="0" <? if(Session::get_flash("sex", 0) == 0) echo "checked" ?> >Male
							</label>
							<label for="sex_f">
								<input id="sex_f" name="sex" type="radio" value="1" <? if(Session::get_flash("sex", 0) == 1) echo "checked" ?> >Female
							</label>
						</div>
					</li>
					<li>
						<h4>Birthday</h4>
						<div>
							<select name="month" id="month" onchange="dateChange()">
								<?
								$months = Config::get("statics.months", []);

								for($i = 1; $i <= 12; $i++): ?>
									<option <? if(Session::get_flash("month", 0) == $i) echo "selected"; ?> value="<? echo $i; ?>"><? echo $months[$i - 1]; ?></option>
								<? endfor; ?>
							</select>
							<select name="day" id="day">
								<? for($i = 1; $i <= 31; $i++): ?>
									<option <? if(Session::get_flash("day", 0) == $i) echo "selected"; ?> value="<? echo $i; ?>"><? echo $i; ?></option>
								<? endfor; ?>
							</select>
							<select name="year" id="year" onchange="dateChange()">
								<? for($i = date("Y")-1; $i >= 1920; $i--): ?>
									<option <? if(Session::get_flash("year", 0) == $i) echo "selected"; ?> value="<? echo $i; ?>"><? echo $i; ?></option>
								<? endfor; ?>
							</select>
						</div>
					</li>
					<li>
						<h4>Gmail address</h4>
						<div>
							<input name="google_account" type="text" required pattern=".{2,40}" title="must be less than 40 chars" value="<? echo Session::get_flash("google_account", ""); ?>" style="width:300px;">
						</div>
					</li>
					<li>
						<h4>Reservation email</h4>
						<div>
							<label for="reservemail_on">
								<input id="reservemail_on" <? if(Session::get_flash("need_reservation_email", 1) == 1) echo "checked" ?> name="need_reservation_email" type="radio" value="1">On
							</label>
							<label for="reservemail_off">
								<input id="reservemail_off" <? if(Session::get_flash("need_reservation_email", 1) == 0) echo "checked" ?> name="need_reservation_email" type="radio" value="0">Off
							</label>
						</div>
					</li>
					<li>
						<h4>News email</h4>
						<div>
							<label for="newsmail_on">
							<input id="newsmail_on" <? if(Session::get_flash("need_news_email", 1) == 1) echo "checked" ?> name="need_news_email" type="radio" value="1">On
							</label>
							<label for="newsmail_off">
							<input id="newsmail_off" <? if(Session::get_flash("need_news_email", 1) == 0) echo "checked" ?> name="need_news_email" type="radio" value="0">Off
							</label>
						</div>
					</li>
					<li>
						<h4>Timezone</h4>
						<div>
							<?= View::forge("_timezone",["user" => ""]); ?>
						</div>
					</li>
					<input type="text" name="grameen" value="<?= ($g==1) ? '1' : '0'; ?>" hidden/>
					<input type="text" name="grameen_student" value="<?= ($g==1) ? '1' : '0'; ?>" hidden/>
				</ul>
				<p class="button-area">
					<button class="button" name="confirm" value="1">Submit <i class="fa fa-chevron-right"></i></button>
				</p>
				<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
			</form>
		</section>
	</div>
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