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
						<h4>School Name</h4>
						<div>
							<input placeholder="School Name" name="school_name" type="text" required pattern=".{2,255}" style="width: 500px" title="must be less than 255 chars" value="<? echo Session::get_flash("school_name", ""); ?>">
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
