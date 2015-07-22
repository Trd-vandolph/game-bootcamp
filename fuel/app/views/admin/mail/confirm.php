<div id="contents-wrap">
	<div id="main">
		<h3>Confirm Message</h3>
		<section class="content-wrap">
			<form action="" method="post" enctype="multipart/form-data">
				<ul class="forms">
					<li>
						<h4>To All</h4>
						<div>
							<?
							if($for_all == 1){
								echo "On";
							}else{
								echo "Off";
							}
							?>
						</div>
					</li>
					<li>
						<h4>To Teachers</h4>
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
					<li>
						<h4>To Students</h4>
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
					<li>
						<h4>Mail Title</h4>
						<div>
							<?= $title; ?>
						</div>
					</li>
					<li>
						<h4>Message</h4>
						<div>
							<?= htmlspecialchars_decode($body); ?>
						</div>
					</li>
				</ul>
			<p class="button-area">
				<span id="goback" class="button"><i class="fa fa-chevron-left"></i> Cancel</span>
				<button class="button" name="action" value="submit">Send Now <i class="fa fa-chevron-right"></i></button>
			</p>
			<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
			</form>
		</section>

	</div>
	<? echo View::forge("admin/_menu"); ?>
</div>

<script>
	$(function(){
		var title = $('.forms input:eq(3)');
		var goback = $('#goback');
		var send = $('button');
		
		function goBack(){
			window.history.go(-1);
		};

		goback.on('click', function(){
			goback.AddEventListener('click', goBack());
		});

		goback.css('padding','8px 30px');

		send.on('click', function(){
			//alert();
			//title.attr('autocomplete', 'on');
			title.removeAttr('autocomplete');
		});
	});
</script>