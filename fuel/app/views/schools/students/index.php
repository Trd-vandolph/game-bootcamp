<div id="contents-wrap">
	<div id="main">
		<h3>Students</h3>
		<div class="search-table">
			<p class="link-more table-top"><? echo Html::anchor("schools/students/add", '<i class="fa fa-plus-circle"></i> Add'); ?></p>
			<form action="" method="get" id="search_form">
				<input name="search_text" type="text" value="<? echo Input::get("search_text", ""); ?>" placeholder="Search Student"/>
			</form>
		</div>
		<table class="table-base" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<th>ID</th>
				<th>name / email</th>
				<th>class</th>
				<th>date enrolled</th>
				<th>enchant.js course</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
			<!-- use $result if searching students, else use $users -->
			<? (Input::get("search_text", "")) ? $arr = $result : $arr = $users; ?>
			<? foreach($arr as $user): ?>
			<tr id="user_<? echo $user->id; ?>">
				<th class="number"><? echo $user->id; ?></th>
				<td>
					<p><?= $user->firstname; ?> <?= $user->middlename; ?> <?= $user->lastname; ?></p>
					<p class="email"><? echo Html::anchor("schools/students/detail/{$user->id}", $user->email); ?></p>
				</td>
				<td><? getClass($user->id); ?></td>
				<td><? getEnroll($user->id); ?></td>
				<td class="html-course">
					<table>
						<tr>
							<th title="1st month">1st</th>
							<th title="2nd month">2nd</th>
							<th title="3rd month">3rd</th>
						</tr>
						<tr>
						<?
							$id = $user->id;
							$charge = $user->charge_html;
						?>
							<td title="1st month"><input id="html1_<?= $id; ?>" type="checkbox" onclick="changeCourse1(<?= $id; ?>)" <? if($charge == 1 or strlen($charge) > 1) echo "checked"; ?>></td>
							<td title="2nd month"><input id="html2_<?= $id; ?>" type="checkbox" onclick="changeCourse2(<?= $id; ?>)" <? if(strlen($charge)==2 or strlen($charge) > 2) echo "checked"; ?>></td>
							<td title="3rd month"><input id="html3_<?= $id; ?>" type="checkbox" onclick="changeCourse3(<?= $id; ?>)" <? if(strlen($charge)==3 or strlen($charge) > 3) echo "checked"; ?>></td>
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
						});
					</script>
				</td>
				<td><button class="button yellow right" onclick="deleteUser(<? echo $id; ?>)"><i class="fa fa-times"></i>Delete</button></td>
			</tr>
			<? endforeach; ?>
			</tbody>
		</table>
		<!-- show pager if search_text > 10 -->
		<? if(Input::get('search_text','')){ echo ''; if(count($result) > 10){ echo $pager;	}	} else { echo $pager; } ?>
	</div>
	<? echo View::forge("schools/_menu"); ?>
</div>

<?
	//PHP FUNCTION
	function getClass($id) {
		$class = Model_Classroom::find("all", [
			"where" => [
				["deleted_at", 0]
			]
		]);
		foreach($class as $cl) {
			$a = Model_Classroom::find($cl->id);
			$studs = $a->students_id;

			$arr = explode(",", $studs);

			if(in_array($id, $arr)) {
				echo $a->classname;
			}
		}
	}
	function getEnroll($id) {
		$stud = Model_User::find($id);

		echo date("M d, Y", $stud->created_at);
	}
?>

<script>

	$(function(){
		$('.search-table .left').css('float','left');
		$('.html-course tr th').add('.html-course tr td').css('padding','2px');
	});

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
</script>
