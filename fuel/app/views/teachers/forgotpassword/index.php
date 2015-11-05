<div id="login">
	<div class="content-wrap_s">
		<form action="" method="post">
			<p>If you forgot password, please input your email.</p>
			<ul class="forms">
				<li><h4>E-Mail</h4>
					<div>
						<input name="email" type="email" required>
					</div>
				</li>
			</ul>
			<p class="button-area">
				<button class="button" href="">Send <i class="fa fa-chevron-right"></i></button>
			</p>
			<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
		</form>
	</div>
</div>
