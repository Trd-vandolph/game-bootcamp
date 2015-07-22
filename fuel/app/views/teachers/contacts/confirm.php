<div id="contents-wrap">
	<div id="main">
		<h3>Contact</h3>
		<section class="content-wrap">
			<form action="submit" method="post" enctype="multipart/form-data">
				<ul class="forms">
					<li>
						<h4>Title</h4>
						<div>
							<?= $title; ?>
						</div>
					</li>
					<li>
						<h4>Body</h4>
						<div>
							<?= nl2br($body); ?>
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
	<? echo View::forge("teachers/_menu"); ?>
</div>