<div id="contents-wrap">
	<div id="main">
		<h3>Contacts</h3>
		<table class="table-base" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
				<tr>
					<th>created_at</th>
					<th>email<br>name</th>
					<th>title</th>
					<th>body</th>
					<th>status</th>
				</tr>
			</thead>
			<tbody>
				<? foreach($contacts as $contact): ?>
					<? if($contact->student == null){
						$user = $contact->teacher;
					}else{
						$user = $contact->student;
					}?>
					<tr>
						<td><?= date("M d, Y. H:i:s", $user->last_login); ?></td>
						<td><?= $user->firstname; ?> <?= $user->middlename; ?> <?= $user->lastname; ?><br><?= $user->email; ?></td>
						<td><?= $contact->title; ?></td>
						<td><?= nl2br($contact->body); ?></td>
						<td><select id="status_<?= $contact->id; ?>" onchange="changeStatus(<?= $contact->id; ?>)">
								<option value="0" <? if($contact->status == 0) echo "selected"; ?>>----</option>
								<option value="1"  <? if($contact->status == 1) echo "selected"; ?>>done</option>
						</select></td>
					</tr>
				<? endforeach; ?>
			</tbody>
		</table>
		<? echo $pager ?>
	</div>
	<? echo View::forge("admin/_menu"); ?>
</div>

<script>
	function changeStatus(id){
		$.ajax({
			url: '/admin/api/changecontactstatus.json',
			type: 'POST',
			data: {
				"id": id,
				"status": $("#status_" + id).val()
			},
			complete: function(){
			},
			success: function(res) {
			}
		})
	}
</script>
