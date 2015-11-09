<div id="contents-wrap">
	<div id="main">
		<h3>Teachers</h3>
		<div class="search-table">
			<p class="link-more table-top"><? echo Html::anchor("admin/teachers/add?id=0", '<i class="fa fa-plus-circle"></i> Add'); ?></p>
			<form action="" method="get" id="search_form">
				<input name="search_text" type="text" value="<? echo Input::get("search_text", ""); ?>"/>
			</form>
		</div>
		<table class="table-base" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<th>ID</th>
				<th>name / email</th>
				<th>last login</th>
				<th>type</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
			<? foreach($users as $user): ?>
			<tr id="user_<? echo $user->id; ?>">
				<th class="number"><? echo $user->id; ?></th>
				<td>
					<p><?= $user->firstname; ?> <?= $user->middlename; ?> <?= $user->lastname; ?></p>
					<p class="email"><? echo Html::anchor("admin/teachers/detail/{$user->id}", $user->email); ?></p>
				</td>
				<td><? if($user->last_login != 0) echo date("M d, Y. H:i:s", $user->last_login); ?></td>
				<td><?= $user->getType(); ?></td>
				<td><button class="button yellow right" onclick="deleteUser(<? echo $user->id; ?>)"><i
							class="fa fa-times"></i>
						Delete</button></td>
			</tr>
			<? endforeach; ?>
			</tbody>
		</table>
		<? echo $pager ?>
	</div>
	<? echo View::forge("admin/_menu"); ?>
</div>

<script>
	function deleteUser(id){

		if(confirm('Do you want to delete this user?')){
			$.ajax({
				url: '/admin/api/deluser.json',
				type: 'POST',
				data: {
					"id": id
				},

				complete: function(){

				},
				success: function(res) {
					$("#user_" + id).hide();
				}
			})
		}
	}
</script>
