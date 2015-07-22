<div id="contents-wrap">
	<div id="main">
		<div class="content-wrap_s">
			<p class="notice-text">Email Sent</p>
			<p class="button-area">
				<? echo Html::anchor("admin/mail", 'Go back to Mail Management <i class="fa fa-chevron-right"></i>', ["class" => "button"]); ?>
			</p>
		</div>
	</div>
	<? echo View::forge("admin/_menu"); ?>
</div>