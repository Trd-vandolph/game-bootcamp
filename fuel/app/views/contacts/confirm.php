<section id="contents" class="contact">
	<p class="text">Confirm the following information.<br>Then click "Send message" button.</p>
	<form action="submit" method="post">
	<ul>
		<li class="clearfix">
			<h3>Your name</h3>
			<div>
				<?= $name; ?>
			</div>
		</li>
		<li class="clearfix">
			<h3>Your e-mail address</h3>
			<div>
				<?= $email; ?>
			</div>
		</li>
		<li class="clearfix">
			<h3>What's on your mind?</h3>
			<div>
				<?= nl2br($body); ?>
			</div>
		</li>
	</ul>
	<p class="button-area"><button name="send" value="1">Send message</button></p>
	<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
	</form>
</section>
