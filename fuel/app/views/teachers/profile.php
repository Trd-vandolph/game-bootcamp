<div id="contents-wrap">
	<div id="main">
		<h3>Profile</h3>
		<section class="content-wrap">
			<? if($is_chenged): ?>
				<p>Update success.</p>
			<? endif; ?>
			<form action="" method="post" enctype="multipart/form-data">
				<ul class="forms">
					<li>
						<h4>Name</h4>
						<div>
							<input placeholder="First name" name="firstname" type="text" required pattern=".{2,20}" title="must be less than 20 chars" value="<? echo Security::htmlentities(Input::post("firstname", $user->firstname)); ?>">
							<input placeholder="Middle name" name="middlename" type="text"  pattern=".{2,20}" title="must be less than 20 chars" value="<? echo Security::htmlentities(Input::post("middlename", $user->middlename)); ?>">
							<input placeholder="Last name" name="lastname" type="text" required pattern=".{2,20}" title="must be less than 20 chars" value="<? echo Security::htmlentities(Input::post("lastname", $user->lastname)); ?>">
						</div>
					</li>
					<li>
						<h4>Email address</h4>
						<div>
							<? if(isset($error)): ?>
								<p class="error"><? echo $error; ?></p>
							<? endif; ?>
							<input name="email" type="email" required value="<? echo Security::htmlentities(Input::post("email", $user->email)); ?>">
						</div>
					</li>
					<li>
						<h4>Image</h4>
						<div>
							<? if($user->img_path != "") echo '<img src="/assets/img/pictures/s_'.$user->img_path.'">';?><input type="file" name="upload_file">
						</div>
					</li>
					<li>
						<h4>Gender</h4>
						<div>
							<?
							if($user->sex == 1){
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
							<?= date("M d, Y.", strtotime($user->birthday)); ?>
						</div>
					</li>
					<li>
						<h4>Gmail address</h4>
						<div>
							<input name="google_account" type="text" required pattern=".{2,40}" title="must be less than 40 chars" value="<? echo Security::htmlentities(Input::post("google_account", $user->google_account)); ?>">
						</div>
					</li>
					<li>
						<h4>PR</h4>
						<div>
							<textarea name="pr"><? echo Security::htmlentities(Input::post("pr", $user->pr)); ?></textarea>
						</div>
					</li>
					<li>
						<h4>Educational background</h4>
						<div>
							<input name="educational_background" type="text" value="<? echo Security::htmlentities(Input::post("educational_background", $user->educational_background)); ?>">
						</div>
					</li>
					<li>
						<h4>Trial</h4>
						<div>
							<input type="checkbox" name="trial" value="1" <? if(Security::htmlentities(Input::post("trial", $user->trial)) == 1) echo "checked"; ?>>
						</div>
					</li>
					<li>
						<h4>enchant.js</h4>
						<div>
							<input type="checkbox" name="html5" value="1" <? if(Security::htmlentities(Input::post("enchantJS", $user->enchantJS)) == 1) echo "checked"; ?>>
						</div>
					</li>
				</ul>
				<ul class="forms">
					<li>
						<h4>Bank name</h4>
						<div>
							<input name="bank_name" type="text" value="<? echo Input::post("bank_name", $user->bank->name); ?>">
						</div>
					</li>
					<li>
						<h4>Bank branch</h4>
						<div>
							<input name="bank_branch" type="text" value="<? echo Input::post("bank_branch", $user->bank->branch); ?>">
						</div>
					</li>
					<li>
						<h4>Bank account</h4>
						<div>
							<input name="bank_account" type="text" value="<? echo Input::post("bank_account", $user->bank->account); ?>">
						</div>
					</li>
					<li>
						<h4>Account type</h4>
						<div>
							<label for="ordinary">
								<input id="ordinary" <? if(Input::post("bank_type", $user->bank->type) == 0) echo "checked" ?> name="bank_type" type="radio" value="0">ordinary
							</label>
							<label for="current">
								<input id="current" <? if(Input::post("bank_type", $user->bank->type) == 1) echo "checked" ?> name="bank_type" type="radio" value="1">current
							</label>
						</div>
					</li>
					<li>
						<h4>Number</h4>
						<div>

							<input name="bank_number" type="text" value="<? echo Input::post("bank_number", $user->bank->number); ?>">
						</div>
					</li>
					<li>
						<h4>etc</h4>
						<div>
							<input name="bank_etc" type="text" value="<? echo Input::post("bank_etc", $user->bank->etc); ?>">
						</div>
					</li>
				</ul>
				<p class="button-area">
					<button class="button" href="">Change <i class="fa fa-chevron-right"></i></button>
				</p>
				<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
			</form>
		</section>
	</div>
	<? echo View::forge("teachers/_menu"); ?>
</div>
