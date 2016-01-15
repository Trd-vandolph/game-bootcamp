<div id="contents-wrap">
	<div id="main">
		<h3>Contact</h3>
		<div class="contact-text clearfix">
			<p>If you have any messages/questions, contact us right here.<br>We'll come back to you as soon as possible.</p>
			<? echo Html::anchor("schools/contactforum/edit",'<i class="fa fa-plus-circle"></i> Send New Message',array('class' => 'button right'));
			?>
		</div>
		<table class="table-base contact-table" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<th class="date">Created at</th>
				<th>Title</th>
			</tr>
			</thead>
			<tbody>
			<? if($news != null): ?>
				<? foreach($forum as $obj): ?>
				<tr id="forum_<? echo $obj->id; ?>">
					<td><?= date("M d, Y. H:i:s", $obj->created_at); ?></td>
					<td>
						<?= Html::anchor("schools/contactforum/detail/{$obj->id}", $obj->title); ?>
						<button class="button gray right" onclick="deleteForum(<? echo $obj->id; ?>)"><i
								class="fa fa-times"></i>
							Delete</button>
						<?= Html::anchor("schools/contactforum/edit/{$obj->id}", '<i class="fa fa-cog"></i> Edit', [ "class" => "button green right"]); ?>
					</td>
				</tr>
				<? endforeach; ?>
			<? endif; ?>
			</tbody>
		</table>
		<? echo $pager ?>
	</div>
	<? echo View::forge("schools/_menu")->set($this->get()); ?>
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
