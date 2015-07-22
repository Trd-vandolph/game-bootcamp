<div id="contents-wrap">
	<div id="main">
		<h3>Contacts</h3>
		<p class="link-more"><? echo Html::anchor("admin/contactforum/edit", '<i class="fa fa-plus-circle"></i>Add');
			?></p>
		<table class="table-base contact-table" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<th>ID</th>
				<th>Created at</th>
				<th>Title</th>
			</tr>
			</thead>
			<tbody>
			<? if($news != null): ?>
				<? foreach($forum as $obj): ?>
				<tr id="forum_<? echo $obj->id; ?>">
					<th class="number"><? echo $obj->id; ?></th>
					<td><?= date("M d, Y. H:i:s", $obj->created_at); ?></td>
					<td>
						<?= Html::anchor("admin/contactforum/detail/{$obj->id}", $obj->title); ?>
						<button class="button gray right" onclick="deleteForum(<? echo $obj->id; ?>)"><i
								class="fa fa-times"></i>
							Delete</button>
						<?= Html::anchor("admin/contactforum/edit/{$obj->id}", '<i class="fa fa-cog"></i> Edit', [  "class" => "button green right"]); ?>
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