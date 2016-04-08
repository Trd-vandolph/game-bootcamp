<div id="contents-wrap">
	<div id="main">
		<h3>Students</h3>
		<div class="search-table">
			<p class="link-more table-top left"><? echo Html::anchor("admin/students/group", '<i class="fa fa-fw fa-users"></i> View Group Students'); ?></p>
			<p class="link-more table-top left"><? echo Html::anchor("admin/students/paid", '<i class="fa fa-fw fa-graduation-cap"></i> View Paying Students'); ?></p>
			<p class="link-more table-top left"><? echo Html::anchor("admin/students", '<i class="fa fa-fw fa-graduation-cap"></i> View Private Students'); ?></p>
		</div>
		<table class="table-base" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<th>ID</th>
				<th>name / email</th>
				<th>Place registered</th>
				<th>last login</th>
				<th>
					enchant.js course
				</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
			<? foreach($users as $user): ?>
				<? foreach($lessons as $lesson): ?>
					<? if($user->id == $lesson->student_id): ?>
						<tr id="user_<? echo $user->id; ?>">
							<th class="number"><? echo $user->id; ?></th>
							<td>
								<p><?= $user->firstname; ?> <?= $user->middlename; ?> <?= $user->lastname; ?></p>
								<p class="email"><? echo Html::anchor("admin/students/detail/{$user->id}", $user->email); ?></p>
							</td>
							<td><? if($user->place == 1){echo "Grameen"; }else{echo "Online School"; } ?></td>
							<td><? if($user->last_login != 0) echo date("M d, Y. H:i:s", $user->last_login); ?></td>
							<td class="html-course">
								<table>
									<tr>
										<th title="Chapter 1 to 7" style="padding: 2px;">Q1</th>
										<th title="Chapter 8 to 16" style="padding: 2px;">Q2</th>
										<th title="Chapter 17 to 24" style="padding: 2px;">Q3</th>
										<th title="JavaScript" style="padding: 2px;">Q4</th>
									</tr>
									<tr>
									<?
										$id = $user->id;
										$charge = $user->charge_html;
									?>
										<td title="Chapter 1 to 7" style="padding: 0;"><input id="html1_<?= $id; ?>" type="checkbox" onclick="changeCourse1(<?= $id; ?>)" <? if($charge == 1 or strlen($charge) > 1) echo "checked"; ?>></td>
										<td title="Chapter 8 to 16" style="padding: 0;"><input id="html2_<?= $id; ?>" type="checkbox" onclick="changeCourse2(<?= $id; ?>)" <? if(strlen($charge)==2 or strlen($charge) > 2) echo "checked"; ?>></td>
										<td title="Chapter 17 to 24" style="padding: 0;"><input id="html3_<?= $id; ?>" type="checkbox" onclick="changeCourse3(<?= $id; ?>)" <? if(strlen($charge)==3 or strlen($charge) > 3) echo "checked"; ?>></td>
										<td title="JavaScript" style="padding: 0;"><input id="html4_<?= $id; ?>" type="checkbox" onclick="changeCourse4(<?= $id; ?>)" <? if(strlen($charge) == 4) echo "checked"; ?>></td>
									</tr>
								</table>
								<script>
									if(!$("#html1_<? echo $id; ?>").is(':checked')){
										$("#html2_<? echo $id; ?>").attr("disabled", true);
										$("#html3_<? echo $id; ?>").attr("disabled", true);
										$("#html4_<? echo $id; ?>").attr("disabled", true);
									}
									if($("#html1_<? echo $id; ?>").is(':checked')){
										$("#html3_<? echo $id; ?>").attr("disabled", true);
										$("#html4_<? echo $id; ?>").attr("disabled", true);
									}
									if($("#html2_<? echo $id; ?>").is(':checked')){
										$("#html4_<? echo $id; ?>").attr("disabled", true);
										$("#html1_<? echo $id; ?>").attr("disabled", true);
										$("#html3_<? echo $id; ?>").attr("disabled", false);
									}
									if($("#html3_<? echo $id; ?>").is(':checked')){
										$("#html1_<? echo $id; ?>").attr("disabled", true);
										$("#html2_<? echo $id; ?>").attr("disabled", true);
										$("#html3_<? echo $id; ?>").attr("disabled", false);
										$("#html4_<? echo $id; ?>").attr("disabled", false);
									}
									if($("#html4_<? echo $id; ?>").is(':checked')){
										$("#html1_<? echo $id; ?>").attr("disabled", true);
										$("#html2_<? echo $id; ?>").attr("disabled", true);
										$("#html3_<? echo $id; ?>").attr("disabled", true);
									}

									$(document).ready(function(){
										$("#html1_<? echo $id; ?>").click(function(){
											if(!$("#html1_<? echo $id; ?>").is(':checked')){
												$("#html2_<? echo $id; ?>").attr("disabled", true);
											}else{
												$("#html2_<? echo $id; ?>").attr("disabled", false);
											}
										});
										$("#html2_<? echo $user->id; ?>").click(function(){
											if(!$("#html2_<? echo $id; ?>").is(':checked')){
												$("#html3_<? echo $id; ?>").attr("disabled", true);
												$("#html1_<? echo $id; ?>").attr("disabled", false);
											}else{
												$("#html1_<? echo $id; ?>").attr("disabled", true);
												$("#html3_<? echo $id; ?>").attr("disabled", false);
											}
										});
										$("#html3_<? echo $id; ?>").click(function(){
											if(!$("#html3_<? echo $id; ?>").is(':checked')){
												$("#html4_<? echo $id; ?>").attr("disabled", true);
												$("#html2_<? echo $id; ?>").attr("disabled", false);
											}else{
												$("#html4_<? echo $id; ?>").attr("disabled", false);
												$("#html2_<? echo $id; ?>").attr("disabled", true);
											}
										});
										$("#html4_<? echo $id; ?>").click(function(){
											if(!$("#html4_<? echo $id; ?>").is(':checked')){
												$("#html4_<? echo $id; ?>").attr("disabled", true);
												$("#html3_<? echo $id; ?>").attr("disabled", false);
											}else{
												$("#html4_<? echo $id; ?>").attr("disabled", false);
												$("#html3_<? echo $id; ?>").attr("disabled", true);
											}
										});
									});
								</script>
							</td>
							<td><button class="button yellow right" onclick="deleteUser(<? echo $id; ?>)"><i class="fa fa-times"></i>Delete</button></td>
						</tr>
					<? endif; ?>
				<? endforeach; ?>
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

	function changeCourse1(id){

		$.ajax({
			url: '/admin/api/htmlcourse1.json',
			type: 'POST',
			data: {
				"id": id
			},

			complete: function(){

			},
			success: function(res) {
			}
		})
	}
	function changeCourse2(id){

		$.ajax({
			url: '/admin/api/htmlcourse2.json',
			type: 'POST',
			data: {
				"id": id
			},

			complete: function(){

			},
			success: function(res) {
			}
		})
	}
	function changeCourse3(id){

		$.ajax({
			url: '/admin/api/htmlcourse3.json',
			type: 'POST',
			data: {
				"id": id
			},

			complete: function(){

			},
			success: function(res) {
			}
		})
	}
	function changeCourse4(id){

		$.ajax({
			url: '/admin/api/htmlcourse4.json',
			type: 'POST',
			data: {
				"id": id
			},

			complete: function(){

			},
			success: function(res) {
			}
		})
	}

	// floating menus left
	$(function(){
		$('.left').css('float','left');
	});
</script>
