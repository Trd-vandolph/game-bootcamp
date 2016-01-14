<div id="contents-wrap">
	<div id="main">
		<h3>Contact</h3>
		<section class="content-wrap">
			<p>Contact success.</p>
			<p class="button-area">
				<? echo Html::anchor("/students/", "top", ["class" => "button"]); ?>
			</p>
		</section>

	</div>
	<? echo View::forge("students/_menu")->set($this->get()); ?>
</div>