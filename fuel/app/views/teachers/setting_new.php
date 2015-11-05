<div id="contents-wrap">
	<div id="main">
		<h3>Setting</h3>
		<section class="content-wrap_s">
			<form action="" method="post" enctype="multipart/form-data">
				<input type="hidden" id="id" value="<? echo Input::get("id", ""); ?>" />
				<ul class="forms">
					<li>
						<h4>Name</h4>
						<div>
							<input placeholder="First name" name="firstname" type="text" required pattern=".{2,20}" style="width: 70px" title="must be less than 20 chars" value="<? echo Session::get_flash("firstname", ""); ?>">
							<input placeholder="Middle name" name="middlename" type="text"  pattern=".{2,20}" style="width: 70px" title="must be less than 20 chars" value="<? echo Session::get_flash("middlename", ""); ?>">
							<input placeholder="Last name" name="lastname" type="text" required pattern=".{2,20}" style="width: 70px" title="must be less than 20 chars" value="<? echo Session::get_flash("lastname", ""); ?>">
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
							<input name="email" type="email" required value="<? echo Session::get_flash("email", ""); ?>">
						</div>
					</li>
					<li>
						<h4>Password</h4>
						<div>
							<input name="password" type="password" required pattern="(?=.*\d+.*)(?=.*[a-zA-Z]+.*)+.{8,}" title="must be greater than 7 characters including alphabet and number">greater than 7 characters including alphabet and number
						</div>
					</li>
					<li>
						<h4>Gender</h4>
						<div>
							<input name="sex" type="radio" value="0" <? if(Session::get_flash("sex", 0) == 0) echo "checked" ?> >Male
							<input name="sex" type="radio" value="1" <? if(Session::get_flash("sex", 0) == 1) echo "checked" ?> >Female
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
							<input name="google_account" type="text" required pattern=".{2,40}" title="must be less than 40 chars" value="<? echo Session::get_flash("google_account", ""); ?>">
						</div>
					</li>
					<li>
						<h4>Reservation email</h4>
						<div>
							<input <? if(Session::get_flash("need_reservation_email", 1) == 1) echo "checked" ?> name="need_reservation_email" type="radio" value="1">On
							<input <? if(Session::get_flash("need_reservation_email", 1) == 0) echo "checked" ?> name="need_reservation_email" type="radio" value="0">Off
						</div>
					</li>
					<li>
						<h4>News email</h4>
						<div>
							<input <? if(Session::get_flash("need_news_email", 1) == 1) echo "checked" ?> name="need_news_email" type="radio" value="1">On
							<input <? if(Session::get_flash("need_news_email", 1) == 0) echo "checked" ?> name="need_news_email" type="radio" value="0">Off
						</div>
					</li>
					<li>
						<h4>Timezone</h4>
						<div>
							<?= View::forge("_timezone",["user" => ""]); ?>
						</div>
					</li>
					<li>
						<h4>PR</h4>
						<div>
							<textarea name="pr"><? echo Session::get_flash("pr", ""); ?></textarea>
						</div>
					</li>
					<li>
						<h4>Educational background</h4>
						<div>
							<input name="educational_background" type="text" value="<? echo Session::get_flash("educational_background", ""); ?>">
						</div>
					</li>
					<li>
						<h4>Trial</h4>
						<div>
							<input type="checkbox" name="trial" value="1" <? if(Session::get_flash("trial", "") == 1) echo "checked"; ?>>
						</div>
					</li>
					<li>
						<h4>HTML/CSS</h4>
						<div>
							<input type="checkbox" name="html5" value="1" <? if(Session::get_flash("html5", "") == 1) echo "checked"; ?>>
						</div>
					</li>
					<li>
						<h4>JavaScript</h4>
						<div>
							<input type="checkbox" name="javascript" value="1" <? if(Session::get_flash("javascript", "") == 1) echo "checked"; ?>>
						</div>
					</li>
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
