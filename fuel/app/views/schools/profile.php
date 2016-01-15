<div id="contents-wrap">
	<div id="main">
		<h3>Profile</h3>
		<section class="content-wrap">
			<? if($is_chenged): ?>
				<p class="error-ok">Update success.</p>
			<? endif; ?>
			<form action="" method="post" enctype="multipart/form-data">
				<ul class="forms">
					<li><h4>Name</h4>
						<div>
							<input placeholder="First name" name="firstname" type="text" required pattern=".{2,20}" title="must be less than 20 chars" value="<? echo Security::htmlentities(Input::post("firstname", $user->firstname)); ?>">
							<input placeholder="Middle name" name="middlename" type="text" pattern=".{2,20}" title="must be less than 20 chars" value="<? echo Security::htmlentities(Input::post("middlename", $user->middlename)); ?>">
							<input placeholder="Last name" name="lastname" type="text" required pattern=".{2,20}" title="must be less than 20 chars" value="<? echo Security::htmlentities(Input::post("lastname", $user->lastname)); ?>">
						</div>
					</li>
					<li><h4>Email address</h4>
						<div>
							<? if(isset($error)): ?>
								<p class="error"><? echo $error; ?></p>
							<? endif; ?>
							<input class="wl" name="email" type="email" required value="<? echo Security::htmlentities(Input::post("email", $user->email)); ?>">
						</div>
					</li>
					<li><h4>Image</h4>
						<div>
							<? if($user->img_path != "") echo '<img src="/assets/img/pictures/s_'.$user->img_path.'">';?><input type="file" name="upload_file">
						</div>
					</li>
					<li><h4>Gender</h4>
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
					<li><h4>Birthday</h4>
						<div>
							<?= date("M d, Y.", strtotime($user->birthday)); ?>
						</div>
					</li>
				</ul>
				<p class="button-area">
					<button class="button" href="">Change</button>
				</p>
				<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
			</form>
		</section>
	</div>
	<? echo View::forge("schools/_menu")->set($this->get()); ?>
</div>
