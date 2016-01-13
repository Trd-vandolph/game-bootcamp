<? $pay = Input::get("p", 0); ?>
<? $method = Input::get("g", 0); ?>
<? $type = Input::get("t", 0); ?>
<? $doc = Input::get("d", 0); ?>
<div id="login">
	<div class="content-wrap_s clearfix">
		<form action="" method="post">
			<div class="login-area">
				<ul class="forms">
					<li><h4>E-Mail</h4>
						<div>
							<input name="email" type="email" required>
						</div>
					</li>
					<li><h4>Password</h4>
						<div>
							<input name="password" type="password" required>
						</div>
					</li>
				</ul>
				<div class="button-area">
					<? if(Input::get("e", 0) == 1): ?>
						<p class="att-txt">Signin failed.</p>
					<? endif; ?>
					<button class="button" href="">Login <i class="fa fa-chevron-right"></i></button>
					<p><label for="remember"><input id="remember" name="remember_me" value="1" type="checkbox"> Remember me</label></p>
				</div>
				<p class="forgotpassword"><? echo Html::anchor("schools/forgotpassword", '<i class="fa fa-angle-right"></i> Forget Password ?'); ?></p>
			</div>
			<div class="signup-area">
				<div class="signup">
					<p>Sign up as school</p>
					<? echo Html::anchor("schools/signup", 'Signup <i class="fa fa-chevron-right"></i>',array('class' => 'button')); ?>
				</div>
				<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
				<input type="text" value="<?=$pay; ?>" name="pay" hidden>
				<input type="text" value="<?=$method; ?>" name="method" hidden>
				<input type="text" value="<?=$type; ?>" name="type" hidden>
				<input type="text" value="<?=$doc; ?>" name="doc" hidden>
			</div>
		</form>
	</div>
</div>
