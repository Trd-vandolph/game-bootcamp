<div id="contents-wrap">
	<div id="main">
		<h3>Forum</h3>
		<section class="content-wrap forum-detail">
			<h4><i class="fa fa-comments"></i>  <?= $forum->title; ?></h4>
			<span class="date">Created at : <?= date("M d, Y. H:i:s", $forum->created_at); ?></span>Posted by <span class="name"><?= $forum->user->firstname; ?> <?= $forum->user->middlename; ?> <?=$forum->user->lastname;	?></span>
			<div class="forum-body">
				<?= nl2br($forum->body); ?>
			</div>
		</section>
		<section class="forum-replay">
			<dl>
				<? foreach($forum->comments as $comment): ?>
				<dt class="clearfix">
					<div class="detail">
						<p class="date"><?= date("M d, Y. H:i:s", $comment->created_at); ?></p>
						<p class="name"><?= $comment->user->firstname; ?> <?= $comment->user->middlename; ?> <?=
							$comment->user->lastname;	?></p>
					</div>
					<div class="button-area">
						<?= Html::anchor
								("admin/forum/detail/{$comment->forum_id}/?del_id={$comment->id}", '<i class="fa fa-times"></i> Delete',
								["onclick" => "if(confirm('Do you want to delete it?')){}else{return false}","class" => "button gray right"]);
						?>
						<?= Html::anchor("admin/forum/comment/{$comment->id}", '<i class="fa fa-cog"></i> Edit',array("class" => "button green right")); ?>
					</div>
				</dt>
				<dd>
						<?= nl2br($comment->body); ?>
				</dd>
				<? endforeach; ?>
			</dl>
		</section>
		<section class="replay">
			<form action="" method="post" enctype="multipart/form-data">
				<ul class="forms">
					<li><h4>Comment</h4>
						<div>
							<textarea name="body" rows="10" cols="100"></textarea>
						</div>
					</li>
				</ul>
				<p class="button-area">
					<button class="button" name="action" value="confirm">Submit <i class="fa
				fa-chevron-right"></i></button>
				</p>
				<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
			</form>
		</section>
	</div>
	<? echo View::forge("admin/_menu"); ?>
</div>
