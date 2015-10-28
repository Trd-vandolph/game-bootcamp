<div id="contents-wrap">
	<div id="main">
		<h3>Signup</h3>
		<section class="content-wrap">
			<form action="submit" method="post" enctype="multipart/form-data">
				<input type="hidden" id="id" value="<? echo Input::get("id", ""); ?>" />
				<ul class="forms">
					<li>
						<h4>Name</h4>
						<div>
							<?= $firstname; ?><?=$middlename; ?><?= $lastname; ?>
						</div>
					</li>
					<li>
						<h4>Email address</h4>
						<div>
							<? echo $email; ?>
						</div>
					</li>
					<li>
						<h4>Password</h4>
						<div>
							********
						</div>
					</li>
					<li>
						<h4>Gender</h4>
						<div>
							<?
							if($sex == 1){
								echo "Female";
							}else{
								echo "Male";
							}
							?>
						</div>
					</li>
					<li>
						<h4>Birthday</h4>
						<div>
							<? echo  Config::get("statics.months", [])[$month-1]; ?> <? echo $day; ?>, <? echo $year; ?>.

						</div>
					</li>
					<li>
						<h4>Gmail address</h4>
						<div>
							<? echo $google_account; ?>
						</div>
					</li>
					<li>
						<h4>Reservation email</h4>
						<div>
							<?
							if($need_reservation_email == 1){
								echo "On";
							}else{
								echo "Off";
							}
							?>
						</div>
					</li>
					<li>
						<h4>News email</h4>
						<div>
							<?
							if($need_news_email == 1){
								echo "On";
							}else{
								echo "Off";
							}
							?>

						</div>
					</li>
					<li>
						<h4>Timezone</h4>
						<div>
							<? echo $timezone; ?>
						</div>
					</li>
					<li>
						<h4>PR</h4>
						<div>
							<? echo nl2br($pr); ?>
						</div>
					</li>
					<li>
						<h4>Educational background</h4>
						<div>
							<? echo $educational_background; ?>
						</div>
					</li>
					<li>
						<h4>Trial</h4>
						<div>
							<?
								if($trial == 1){
									echo "On";
								}else{
									echo "Off";
								}
							?>
						</div>
					</li>
					<li>
						<h4>enchant.js</h4>
						<div>
							<?
								if($enchantJS == 1){
									echo "On";
								}else{
									echo "Off";
								}
							?>

						</div>
					</li>
				</ul>
				<p class="button-area">
					<button name="submit" value="1" class="button">Submit <i class="fa fa-chevron-right"></i></button>
				</p>
				<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
			</form>
		</section>
	</div>
</div>
