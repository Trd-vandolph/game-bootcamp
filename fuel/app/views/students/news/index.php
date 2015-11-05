<div id="contents-wrap">
	<div id="main">
		<h3>Information</h3>
		<section class="feedback">
			<ul class="list-base">
				<? foreach($news as $new): ?>
				<li><a href="/students/news/detail/<?= $new->id; ?>">
						<?
						$is_read = Model_Readnews::find("first", [
							"where" => [
								["user_id" => $user->id],
								["news_id" => $new->id]
							]
						]);
						if($is_read == null): ?><span class="icon-new">NEW</span>
						<? endif; ?><strong><?= $new->title; ?></strong></a></li>
				<? endforeach; ?>
			</ul>
			<? echo $pager ?>
		</section>
	</div>
	<? echo View::forge("students/_menu")->set($this->get()); ?>
</div>
