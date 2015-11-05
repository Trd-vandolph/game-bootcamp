<div id="contents-wrap">
	<div id="main">
		<h3>Forum</h3>
		<section class="content-wrap">
			<form action="" method="post" enctype="multipart/form-data">
				<ul class="forms">
					<li>
						<h4>Title</h4>
						<div>
							<input type="text" name="title" value="<? echo $forum->title; ?>">
						</div>
					</li>
					<li>
						<h4>Body</h4>
						<div>
							<textarea name="body" rows="20" cols="100"><? echo $forum->body; ?></textarea>
						</div>
					</li>
				</ul>
				<p class="button-area">
					<button class="button" name="action" value="confirm">Submit <i class="fa
					fa-chevron-right"></i></button>
				</p>
				<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
			</form>
		</section>
	</div>
	<? echo View::forge("admin/_menu"); ?>
</div>
