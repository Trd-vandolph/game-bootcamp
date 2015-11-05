<div id="contents-wrap">
	<div id="main">
		<h3>Information</h3>
		<p class="link-more"><? echo Html::anchor("admin/news/edit", '<i class="fa fa-plus-circle"></i> Add'); ?></p>
		<table class="table-base" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<th>ID</th>
				<th>Created at</th>
				<th>Title</th>
			</tr>
			</thead>
			<tbody>
			<? if($news != null): ?>
				<? foreach($news as $new): ?>
				<tr id="news_<? echo $new->id; ?>">
					<th class="number"><? echo $new->id; ?></th>
					<td><? echo date("M d, Y. H:i:s", $new->created_at); ?></td>
					<td>
						<? echo $new->title; ?>
						<button class="button gray right" onclick="deleteNews(<? echo $new->id; ?>)"><i
								class="fa fa-times"></i>
							Delete</button>
						<? echo Html::anchor("admin/news/edit/{$new->id}", '<i class="fa fa-cog"></i> Edit', [  "class" => "button green right"]); ?>
					</td>
				</tr>
				<? endforeach; ?>
			<? endif; ?>
			</tbody>
		</table>
		<? echo $pager ?>
	</div>
	<? echo View::forge("admin/_menu"); ?>
</div>
<script>
	function deleteNews(id){
		if(confirm('Do you want to delete it?')){
			$.ajax({
				url: '/admin/api/delnews.json',
				type: 'POST',
				data: {
					"id": id
				},

				complete: function(){

				},
				success: function(res) {
					$("#news_" + id).hide();
				}
			})
		}
	}
</script>
