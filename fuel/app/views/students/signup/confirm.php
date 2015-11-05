<div id="contents-wrap">
	<div id="main">
		<h3>Signup</h3>
		<section class="content-wrap">
			<form action="submit" method="post" enctype="multipart/form-data">
				<input type="hidden" id="id" value="<? echo Input::get("id", ""); ?>" />
				<ul class="forms">
					<li><h4>Name</h4>
						<div><?= $firstname; ?>&nbsp;<?=$middlename; ?>&nbsp;<?= $lastname; ?></div>
					</li>
					<li><h4>Email address</h4>
						<div><? echo $email; ?></div>
					</li>
					<li><h4>Password</h4>
						<div>********</div>
					</li>
					<li><h4>Nationality</h4>
						<div><? echo $nationality; ?></div>
					</li>
					<li><h4>Gender</h4>
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
					<li><h4>Birthday</h4>
						<div>
							<? echo  Config::get("statics.months", [])[$month-1]; ?> <? echo $day; ?>, <? echo $year; ?>.
						</div>
					</li>
					<li><h4>Timezone</h4>
						<div>
							<? echo $timezone; ?>
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
