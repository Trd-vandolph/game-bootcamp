<div id="contents-wrap">
	<div id="main">
		<h3>Forum</h3>
		<p class="link-more"><? echo Html::anchor("admin/forum/edit", '<i class="fa fa-plus-circle"></i> Create new topic'); ?></p>


		<ul class="forum-list">
			<? if($news != null): ?>
			<? foreach($forum as $obj): ?>
			<li class="clearfix">
				<div class="detail clearfix">
					<h4><i class="fa fa-comments"></i> <?= Html::anchor("admin/forum/detail/{$obj->id}", $obj->title); ?><span> [#<? echo $obj->id; ?>] </span></h4>
					<p class="date">Created at : <?= date("M d, Y. H:i:s", $obj->created_at); ?></p>
				</div>
				<div class="button-area">
					<button class="button gray right" onclick="deleteForum(<? echo $obj->id; ?>)"><i class="fa fa-times"></i> Delete</button>
					<?= Html::anchor("admin/forum/edit/{$obj->id}", '<i class="fa fa-cog"></i> Edit', ["class" => "button green right"]); ?>
				</div>
			</li>
			<? endforeach; ?>
			<? endif; ?>
		</ul>




		<? echo $pager ?>
	</div>
	<? echo View::forge("admin/_menu"); ?>
</div>
<script>

	function deleteForum(id){

		if(confirm('Do you want to delete it?')){
			$.ajax({
				url: '/admin/api/delforum.json',
				type: 'POST',
				data: {
					"id": id
				},

				complete: function(){

				},
				success: function(res) {
					$("#forum_" + id).hide();
				}
			})
		}
	}
</script>