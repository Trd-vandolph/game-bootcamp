<?
$token = Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
<div id="contents-wrap">
	<div id="main">
		<? if($is_chenged): ?>
			<p>Update success.</p>
		<? endif; ?>
		<h3>Email</h3>
		<section class="content-wrap">
			<form action="" method="post" enctype="multipart/form-data">
				<ul class="forms">
<!--					<li><h4>Reservation email</h4>-->
<!--						<div>-->
<!--							<label for="reservation-on">-->
<!--							<input --><?// if(Input::post("need_reservation_email", $user->need_reservation_email) == 1) echo "checked" ?><!-- id="reservation-on" name="need_reservation_email" type="radio" value="1">On-->
<!--							</label>-->
<!--							<label for="reservation-off">-->
<!--							<input --><?// if(Input::post("need_reservation_email", $user->need_reservation_email) == 0) echo "checked" ?><!-- id="reservation-off" name="need_reservation_email" type="radio" value="0">Off-->
<!--							</label>-->
<!--						</div>-->
<!--					</li>-->
<!--					<li><h4>News email</h4>-->
<!--						<div>-->
<!--							<label for="news-on">-->
<!--							<input --><?// if(Input::post("need_news_email", $user->need_news_email) == 1) echo "checked" ?><!-- id="news-on" name="need_news_email" type="radio" value="1">On-->
<!--							</label>-->
<!--							<label for="news-off">-->
<!--							<input --><?// if(Input::post("need_news_email", $user->need_news_email) == 0) echo "checked" ?><!-- id="news-off" name="need_news_email" type="radio" value="0">Off-->
<!--							</label>-->
<!--						</div>-->
<!--					</li>-->
				</ul>
				<p class="button-area">
					<button class="button" href="">Change</button>
				</p>
				<? echo $token; ?>
			</form>
		</section>
		<h3>Timezone</h3>
		<section class="content-wrap">
			<form action="" method="post" enctype="multipart/form-data">
				<ul class="forms">
					<li><h4>Timezone</h4>
						<div>
							<?= View::forge("_timezone",["user" => $user]); ?>
						</div>
					</li>
				</ul>
				<p class="button-area">
					<button class="button" href="">Change</button>
				</p>
				<? echo $token; ?>
			</form>
		</section>
		<h3>Change password</h3>
		<section class="content-wrap">
			<? if($password_error): ?>
				<p><? echo $password_error; ?></p>
			<? endif; ?>
			<form action="" method="post" enctype="multipart/form-data">
				<ul class="forms">
					<li><h4>New password</h4>
						<div>
							<input name="password" type="password" required pattern="(?=.*\d+.*)(?=.*[a-zA-Z]+.*)+.{8,}" title="must be greater than 7 characters including alphabet and number">
							<aside>greater than 7 characters including alphabet and number</aside>
						</div>
					</li>
					<li><h4>Confirm</h4>
						<div>
							<input name="password2" type="password" required pattern="(?=.*\d+.*)(?=.*[a-zA-Z]+.*)+.{8,}" title="must be greater than 7 characters including alphabet and number">
						</div>
					</li>
				</ul>
				<p class="button-area">
					<button class="button" href="">Change</button>
				</p>
				<? echo $token; ?>
			</form>
		</section>
	</div>
	<? echo View::forge("students/_menu")->set($this->get()); ?>
</div>
<script>
	$(function(){
		var place = $('#place');
		var gs = $('#grameen_student');
		var dm = $('.disable-message');
		place.on('change', function(){
			gs.val(place.val());
		});
		dm.css('textAlign','center');
	});
</script>
