<div id="contents-wrap">
	<div id="main">
		<div class="search-table" style="float: right; padding: 20px 0;">
			<form action="" method="get" id="search_form">
				Search <input name="search_text" type="text" value="<? echo Input::get("search_text", ""); ?>"/>
			</form>
		</div>
		<h3>Paying Students</h3>
		<table class="table-base" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<th>Student's Name</th>
				<th>Place registered</th>
				<th>Last Login</th>
				<th>Course Progress</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
			<? (Input::get("search_text", "")) ? $arr = $result : $arr = $students; ?>
			<? foreach($arr as $user): ?>
			<?
				$progress = Model_Lessontime::find("all",[
						"where" => [
								["student_id", $user->id],
								["deleted_at", 0],
								["status", 2],
								["language", "!=", -1], 
						],
				]);
			?>
			<tr id="user_<? echo $user->id; ?>">
				<td>
					<p style="text-transform: capitalize;"><?= $user->firstname; ?> <?= $user->middlename; ?> <?= $user->lastname; ?></p>
					<p class="email"><? echo Html::anchor("grameencom/students/detail/{$user->id}", $user->email); ?></p>
				</td>
				<td><? if($user->place == 1){echo "Grameen"; }else{echo "Online School"; } ?></td>
				<td><? if($user->last_login != 0) echo date("M d, Y. H:i:s", $user->last_login); ?></td>
				<td><strong style="color: red;"><?php echo count($progress)."/32 "; ?></strong><i>HTML/CSS/JavaScript</i></td>
			</tr>
			<? endforeach; ?>
			</tbody>
		</table>
		<? if(Input::get('search_text','')){ echo ''; if(count($result) > 10){ echo $pager;	}	} else { echo $pager; } ?>
	</div>
</div>
<script>
	$(function(){
		$('.search-table .left').css('float','left');
		$('.html-course tr th').add('.html-course tr td').css('padding','2px');
	});
</script>
