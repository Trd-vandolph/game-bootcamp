<div id="contents-wrap">
	<div id="main">
		<h3>News</h3>
		<section class="content-wrap">
			<form action="" method="post" enctype="multipart/form-data">
				<ul class="forms">
					<li><h4>Teacher</h4>
						<div>
							<?
							if($for_teachers == 1){
								echo "On";
							}else{
								echo "Off";
							}
							?>
						</div>
					</li>
					<li><h4>Student</h4>
						<div>
							<?
							if($for_students == 1){
								echo "On";
							}else{
								echo "Off";
							}
							?>
						</div>
					</li>
					<li><h4>Title</h4>
						<div>
							<?= $title; ?>
						</div>
					</li>
					<li><h4>Body</h4>
						<div>
							<?= nl2br($body); ?>
						</div>
					</li>
				</ul>
				<p class="button-area">
					<button class="button" name="action" value="submit">Submit <i class="fa fa-chevron-right"></i></button>
				</p>
				<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
			</form>
		</section>
	</div>
	<? echo View::forge("admin/_menu"); ?>
</div>
