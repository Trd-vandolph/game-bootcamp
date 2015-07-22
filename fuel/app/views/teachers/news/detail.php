<div id="contents-wrap">
	<div id="main">
		<h3><?= $news->title; ?></h3>
		<section class="feedback">
			Dear <?= $user->firstname; ?>,<br><br>
			<?= nl2br($news->body); ?>
		</section>
	</div>

	<? echo View::forge("teachers/_menu"); ?>
</div>
