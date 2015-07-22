<div id="login">
	<div class="content-wrap_s">
		<form action="" method="post">
		<ul class="forms">
			<li>
				<h4>E-Mail</h4>
				<div>
					<input name="email" type="email" required>
				</div>
			</li>
			<li>
				<h4>Password</h4>
				<div>
					<input name="password" type="password" required>
				</div>
			</li>
			<? if(Input::get("e", 0) == 1): ?>
			<p style="color: red">Signin failed.</p>
			<? endif; ?>
		</ul>
		<p class="button-area">
			<button class="button" href="">Login <i class="fa fa-chevron-right"></i></button>
		</p>
		<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
		</form>
	</div>
</div>