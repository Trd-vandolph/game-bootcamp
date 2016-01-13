<div id="contents-wrap">
	<div id="main">
		<h3>Forum</h3>
		<p class="link-more"><? echo Html::anchor("students/forum/edit", '<i class="fa fa-plus-circle"></i> Create new topic');
			?></p>
		<ul class="forum-list">
			<? if($news != null): ?>
			<? foreach($forum as $obj): ?>
			<li class="clearfix">
				<div class="detail clearfix">
					<h4><i class="fa fa-comments"></i> <?= Html::anchor("students/forum/detail/{$obj->id}", $obj->title); ?><span> [#<? echo $obj->id; ?>] </span></h4>
					<p class="date">Created at : <?= date("M d, Y. H:i:s", $obj->created_at); ?></p>
				</div>
				<div class="button-area">
					<? if($user->id == $obj->user_id): ?>
						<a class="button gray right" onclick="if(confirm('Do you want to delete it?')){}else{return false;}" href="/students/forum/?del_id=<?=$obj->id; ?>"><i class="fa fa-times"></i> Delete</a>
						<?= Html::anchor("students/forum/edit/{$obj->id}", '<i class="fa fa-cog"></i> Edit', [ "class" => "button green right"]); ?>
					<? endif; ?>
				</div>
			</li>
			<? endforeach; ?>
			<? endif; ?>
		</ul>
		<? echo $pager ?>
	</div>
	<? echo View::forge("students/_menu")->set($this->get()); ?>
</div>