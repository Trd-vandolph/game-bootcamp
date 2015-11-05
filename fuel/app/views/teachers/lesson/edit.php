<div id="contents-wrap">
	<div id="main">
		<h3>Reservation</h3>
		<section class="content-wrap">
			<form action="" method="post" enctype="multipart/form-data">
				<ul class="forms">
					<li><h4>Hangout url</h4>
						<div>
							<input type="text" name="url" value="<? echo $reservation->url; ?>">
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
