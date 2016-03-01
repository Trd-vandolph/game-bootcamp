<div id="contents-wrap">
	<div id="main">
	<? $g=Input::GET('g',0); ?>
		<?php echo Uri::segment(3); ?>
		<h3>Signup<h3>
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
						<h4>Gmail address</h4>
						<div>
							<? if(isset($errors)): ?>
								<? foreach($errors as $error): ?>
									<p class="error"><? echo $error; ?></p>
								<? endforeach; ?>
							<? endif; ?>
							<input name="email" type="email" required value="<? echo Session::get_flash("email", ""); ?>" style="width:300px;">
							<span>Don't have Gmail Account? <a href="https://accounts.google.com/signup">Click Here</a></span>
						</div>
					</li>
					<li>
						<h4>Password</h4>
						<div>
							<input name="password" id="pass" type="password" required pattern="(?=.*\d+.*)(?=.*[a-zA-Z]+.*)+.{8,}" title="must be greater than 7 characters including alphabet and number">
							<aside>greater than 7 characters including alphabet and number</aside>
						</div>
					</li>
					<li>
						<h4>Confirm Password</h4>
						<div>
							<input name="password" id="cpass" type="password">
							<span id="pass-message"></span>
						</div>
					</li>
					<li>
                        <h4>Contact Number</h4>
                        <input name="contact_no" type="text" pattern="[0-9#-()+]{2,15}" required>
                    </li>
					<li>
						<h4>School Name</h4>
						<div>
							<select name="school_admitted" required>
                                <option>---Select School---</option>
                                <?php foreach($schools as $school): ?>
                                <option value="<?= $school->id ?>"><?= $school->school_name; ?></option>
                                <?php endforeach; ?>
                            </select>
						</div>
					</li>
					<li>
						<h4>Nationality</h4>
						<div>
							<!-- <input list="nationalities" name="nationality" placeholder="e.g. Singaporean">
							<datalist id="nationalities">

							</datalist> -->
							<select name="nationality">
								<option value="0">---Select Nationality---</option>
								<?
								$nationalities = Config::get("statics.nationalities", []);

								foreach($nationalities as $nationality):?>
									<option value="<? echo $nationality; ?>"><?= $nationality; ?></option>
								<? endforeach; ?>
							</select>
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
					<input type="text" hidden value="1" name="need_reservation_email" />
					<input type="text" hidden value="1" name="need_news_email" />
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
					<button class="button" id="button-submit" name="confirm" value="1">Submit <i class="fa fa-chevron-right"></i></button>
				</p>
				<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
			</form>
		</section>
	</div>
</div>
<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script>
	$(document).ready(function(){
		dateChange();

		var password = $('input#pass');
		var cpassword = $('input#cpass');
		var message = $('span#pass-message');
		var button = $('button#button-submit');
		var buttonHover = $('#button-submit:hover');

		button.css('display', 'none');

		cpassword.on('keyup', function () {
				confirmPass();
		});

		function confirmPass() {
			var origVal = password.val();
			var cpassVal = cpassword.val();
			if(password.val().length > 0) {
				if(origVal != cpassVal) {
					message.text("Password not matched.");
					message.css('color', 'red');
					button.css('display', 'none');
				}else{
					message.text("Password matched.");
					message.css('color', 'green');
					button.css({
						'display' : 'block',
						'margin' 	: 'auto'
					});
				}
			}else {
				message.text(" ");
			}
		}

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
	});
</script>
