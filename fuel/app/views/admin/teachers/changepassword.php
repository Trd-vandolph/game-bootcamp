<div id="contents-wrap">
	<div id="main">
		<h3>Change password</h3>
		<section class="content-wrap">
			<form action="" method="post" enctype="multipart/form-data">

				<ul class="forms">
					<li>
						<h4>Password</h4>
						<div>
							<input name="password" type="password" required pattern="(?=.*\d+.*)(?=.*[a-zA-Z]+.*)+.{8,}" title="must be greater than 7 characters including alphabet and number">greater than 7 characters including alphabet and number
						</div>
					</li>
				</ul>
				<p class="button-area">
					<button class="button" href="">Submit <i class="fa fa-chevron-right"></i></button>
				</p>
				<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
			</form>
		</section>
	</div>
	<? echo View::forge("admin/_menu"); ?>
</div>
