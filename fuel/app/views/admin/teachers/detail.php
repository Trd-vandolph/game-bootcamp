<div id="contents-wrap">
	<div id="main">
		<h3><?= $user->firstname; ?> <?= $user->middlename; ?> <?= $user->lastname; ?></h3>
		<p class="link-more"><? echo Html::anchor("admin/teachers/add?id={$user->id}", '<i class="fa fa-plus-circle"></i>Edit'); ?></p>
		<section class="content-wrap">
				<ul class="forms">
					<li><h4>Name</h4>
						<div><?= $user->firstname; ?> <?= $user->middlename; ?> <?= $user->lastname; ?></div>
					</li>
					<li><h4>Email address</h4>
						<div><? echo $user->email ?></div>
					</li>
					<li><h4>Type</h4>
						<div><?= $user->getType(); ?></div>
					</li>
					<li><h4>Image</h4>
						<div>
							<? if($user->img_path != "") echo '<img src="/assets/img/pictures/s_'.$user->img_path.'">';?>
						</div>
					</li>
					<li><h4>Gender</h4>
						<div><? echo Config::get("statics.sex", [])[$user->sex]; ?></div>
					</li>
					<li><h4>Birthday</h4>
						<div><? echo date("M d, Y.", strtotime($user->birthday)); ?></div>
					</li>
					<li><h4>Gmail address</h4>
						<div><? echo $user->google_account ?></div>
					</li>
					<li><h4>Reservation email</h4>
						<div><? echo Config::get("statics.on_off", [])[$user->need_reservation_email]; ?></div>
					</li>
					<li><h4>News email</h4>
						<div><? echo Config::get("statics.on_off", [])[$user->need_news_email]; ?></div>
					</li>
					<li><h4>Timezone</h4>
						<div><? echo $user->timezone ?></div>
					</li>
					<li><h4>PR</h4>
						<div><? echo nl2br($user->pr) ?></div>
					</li>
					<li><h4>Educational background</h4>
						<div><? echo $user->educational_background; ?></div>
					</li>
					<li><h4>Trial</h4>
						<div><? echo Config::get("statics.on_off", [])[$user->trial]; ?></div>
					</li>
					<li><h4>HTML/CSS</h4>
						<div><? echo Config::get("statics.on_off", [])[$user->html5]; ?></div>
					</li>
					<li><h4>JavaScript</h4>
						<div><? echo Config::get("statics.on_off", [])[$user->javascript]; ?></div>
					</li>
				</ul>
			<ul class="forms">
				<li><h4>Bank name</h4>
					<div><?= $user->bank->name; ?></div>
				</li>
				<li><h4>Bank branch</h4>
					<div><?= $user->bank->branch; ?></div>
				</li>
				<li><h4>Bank account</h4>
					<div><?= $user->bank->account; ?></div>
				</li>
				<li><h4>Account type</h4>
					<div>
						<? if($user->bank->type == 0){
							echo "ordinary";
						}else{
							echo "current";
						} ?>
					</div>
				</li>
				<li><h4>Number</h4>
					<div><?= $user->bank->number; ?></div>
				</li>
				<li><h4>etc</h4>
					<div><?= $user->bank->etc; ?></div>
				</li>
			</ul>
					<p class="button-area">
						<? echo Html::anchor("admin/teachers/changepassword/{$user->id}", 'Change password', ["class" => "button"]); ?>
					</p>
		</section>
	</div>
	<? echo View::forge("admin/_menu"); ?>
</div>
