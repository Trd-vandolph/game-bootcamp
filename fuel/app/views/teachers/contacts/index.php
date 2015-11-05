<div id="contents-wrap">
	<div id="main">
		<h3>Contact</h3>
		<section class="content-wrap">
			<form action="" method="post" enctype="multipart/form-data">
				<ul class="forms">
					<li><h4>Title</h4>
						<div>
							<input id="email-title-width" name="title" type="text" required value="<?= Session::get_flash("title", ""); ?>">
						</div>
					</li>
					<li><h4>Message</h4>
						<div>
							<textarea name="body" rows="10" cols="60"><?= Session::get_flash("body", ""); ?></textarea>
						</div>
					</li>
				</ul>
			<p class="button-area">
				<button class="button" name="confirm" value="1">Confirm <i class="fa fa-chevron-right"></i></button>
			</p>
			<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
			</form>
		</section>
	</div>
	<? echo View::forge("teachers/_menu"); ?>
</div>
