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
				<th>lesson progress</th>
				<th>date enrolled</th>
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
                    <td class="classroom-assigned"><?=$user->classroom->classname; ?></td>
					<td><?=$user->progress; ?>/12 enchant.js</td>
                    <td><? getEnroll($user->id); ?></td>
                    <td><button class="button yellow right" onclick="deleteUser(<? echo $user->id; ?>)"><i class="fa fa-times"></i>Delete</button></td>
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
	function getEnroll($id) {
		$stud = Model_User::find($id);

		echo date("M d, Y", $stud->created_at);
	}
?>

<script>

	$(function(){
		$('.search-table .left').css('float','left');
		$('.html-course tr th').add('.html-course tr td').css('padding','2px');
        
        var classroom = $('.classroom-assigned');
        
        classroom.each(function() {
           if($(this).html() == '') {
               $($(this)).append('<a href="/schools/classroom/add/"><p><i>Assign classroom</i></p></a>');
           }
        });
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
