<div id="login">
	<div class="content-wrap_s">
		<form action="" method="post">
			<p>Please input your new password.</p>
			<ul class="forms">
				<li>
					<h4>Password</h4>
					<div>
						<input name="password" type="password" required>
					</div>
				</li>
			</ul>
			<p class="button-area">
				<button class="button" href="">Set <i class="fa fa-chevron-right"></i></button>
			</p>
			<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
		</form>
	</div>
</div>