<section id="contents" class="contact">
	<p class="text">We are always looking for ideas to improve our service and really value your thoughts.</p>
	<p class="text">Please let us know your questions and suggestions. We will get back to you as soon as possible.</p>
	<form action="" method="post">
		<ul>
			<li class="clearfix">
				<h3>Your name</h3>
				<div><input type="text" name="name" required=""></div>
			</li>
			<li class="clearfix">
				<h3>Your e-mail address</h3>
				<div><input type="email" name="email" required=""></div>
			</li>
			<li class="clearfix">
				<h3>What's on your mind?</h3>
				<div><textarea name="body" required=""></textarea></div>
			</li>
		</ul>
		<p class="button-area"><button name="confirm" value="1">Send message</button></p>
		<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
	</form>
</section>
