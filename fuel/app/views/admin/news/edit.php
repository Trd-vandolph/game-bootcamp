<div id="contents-wrap">
	<div id="main">
		<h3>News</h3>
		<section class="content-wrap">
			<form action="" method="post" enctype="multipart/form-data">
				<ul class="forms">
					<li><h4>Teacher</h4>
						<div>
							<input type="checkbox" name="for_teachers" value="1" <? if($news->for_teachers == 1) echo "checked"; ?>>
						</div>
					</li>
					<li><h4>Student</h4>
						<div>
							<input type="checkbox" name="for_students" value="1" <? if($news->for_students == 1) echo "checked"; ?>>
						</div>
					</li>
					<li><h4>Title</h4>
						<div>
							<input type="text" name="title" value="<? echo $news->title; ?>">
						</div>
					</li>
					<li><h4>Body</h4>
						<div>
							<textarea name="body" rows="20" cols="100"><? echo $news->body; ?></textarea>
						</div>
					</li>
				</ul>
				<p class="button-area">
					<button class="button" name="action" value="confirm">Confirm <i class="fa fa-chevron-right"></i></button>
				</p>
				<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
			</form>
		</section>
	</div>
	<? echo View::forge("admin/_menu"); ?>
</div>
