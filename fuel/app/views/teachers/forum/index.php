<div id="contents-wrap">
	<div id="main">
		<h3>Forum</h3>
		<p class="link-more"><? echo Html::anchor("teachers/forum/edit", '<i class="fa fa-plus-circle"></i>Add');
			?></p>
		<ul class="forum-list">
			<? if($news != null): ?>
			<? foreach($forum as $obj): ?>
			<li id="forum_<? echo $obj->id; ?>" class="clearfix">
				<div class="detail clearfix">
					<h4><i class="fa fa-comments"></i> <?= Html::anchor("teachers/forum/detail/{$obj->id}", $obj->title); ?><span> [#<? echo $obj->id; ?>] </span></h4>
					<p class="date">Created at : <?= date("M d, Y. H:i:s", $obj->created_at); ?></p>
				</div>
				<div class="button-area">
					<? if($user->id == $obj->user_id): ?>
						<a class="button yellow right" style="height:14px;line-height:14px" onclick="if(confirm('Do you want to delete it?')){}else{return false;}" href="/teachers/forum/?del_id=<?=$obj->id; ?>"><i class="fa fa-times"></i>Delete</a>
						<?= Html::anchor("teachers/forum/edit/{$obj->id}", 'Edit', [ "style" => "height:14px;
						line-height:14px", "class" => "button green right"]); ?>
					<? endif; ?>
				</div>
			</li>
			<? endforeach; ?>
			<? endif; ?>
		</ul>
		<? echo $pager ?>
	</div>
	<? echo View::forge("teachers/_menu"); ?>
</div>