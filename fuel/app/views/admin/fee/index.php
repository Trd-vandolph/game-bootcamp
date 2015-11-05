<div id="contents-wrap">
	<div id="main">
		<h3>Teacher's fee</h3>
		<div>
			<div style="float: right; margin: 10px;">
				<form action="" method="get" id="search_form">
					<select name="month" onchange="$('#search_form').submit();">
						<? for($i = 1; $i <= 12; $i++): ?>
							<option <? if($month == $i) echo "selected" ?> value="<? echo $i;
							?>"><?
								echo $i;
								?></option>
						<? endfor; ?>
						?>
					</select>
					<select name="year" onchange="$('#search_form').submit();">
						<? for($i = 2015; $i <= date("Y"); $i++): ?>
							<option <? if($year == $i) echo "selected" ?> value="<? echo $i;
							?>"><?
							echo $i;
							?></option>
						<? endfor; ?>
						?>
					</select>
				</form>
			</div>
		</div>
		<table class="table-base" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<th>Teacher</th>
				<th>Grade</th>
				<th>Num of Lesson</th>
				<th>Fee</th>
				<th>Paid or not</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
			<? foreach($teachers as $teacher): ?>
				<?
				if($teacher->fee == null){
					$teacher->fee = Model_Fee::forge();
					$teacher->fee->user_id = $teacher->id;
					$teacher->fee->year = $year;
					$teacher->fee->month = $month;
					$teacher->fee->save();
				}
				?>
				<tr>
					<td><?= $teacher->firstname; ?> <?= $teacher->middlename; ?> <?= $teacher->lastname; ?></td>
					<td>
						<select id="grade_<?= $teacher->fee->id; ?>" onchange="changePrice(<?= $teacher->fee->id; ?>,<?= $teacher->count; ?>)">
							<option value="1" <? if($teacher->fee->grade == 1) echo "selected" ?>>1</option>
							<option value="2" <? if($teacher->fee->grade == 2) echo "selected" ?>>2</option>
							<option value="3" <? if($teacher->fee->grade == 3) echo "selected" ?>>3</option>
							<option value="4" <? if($teacher->fee->grade == 4) echo "selected" ?>>4</option>
							<option value="5" <? if($teacher->fee->grade == 5) echo "selected" ?>>5</option>
						</select>
					</td>
					<td><?= $teacher->count; ?></td>
					<td>$<? if($teacher->type == 0){
							echo "<span id=\"price_{$teacher->fee->id}\">";
							switch($teacher->fee->grade){
								case 1:
									echo $grade->grade_1 * $teacher->count;
									break;
								case 2:
									echo $grade->grade_2 * $teacher->count;
									break;
								case 3:
									echo $grade->grade_3 * $teacher->count;
									break;
								case 4:
									echo $grade->grade_4 * $teacher->count;
									break;
								case 5:
									echo $grade->grade_5 * $teacher->count;
									break;
							}
							echo '</span>';
						}else{
							echo "<input id=\"fulltime_{$teacher->fee->id}\" value=\"{$teacher->fee->fulltime}\">";
						}?></td>
					<td><select id="is_paid_<?= $teacher->fee->id; ?>">
							<option value="0" <? if($teacher->fee->is_paid == 0) echo "selected" ?>>No</option>
							<option value="1" <? if($teacher->fee->is_paid == 1) echo "selected" ?>>Yes</option>
					</select></td>
					<td><button class="button" onclick="changeFee(<?= $teacher->fee->id; ?>)">Set <i class="fa fa-chevron-right"></i></button></td>
				</tr>
			<? endforeach; ?>
			</tbody>
		</table>
	</div>
	<? echo View::forge("admin/_menu"); ?>
</div>
<script>
	function changeFee(id){
		if(confirm('Do you want to change the data?')){
			$.ajax({
				url: '/admin/api/changefee.json',
				type: 'POST',
				data: {
					"id": id,
					"grade": $("#grade_" + id).val(),
					"fulltime": $("#fulltime_" + id).val(),
					"is_paid": $("#is_paid_" + id).val()
				},
				complete: function(){
				},
				success: function(res) {
				}
			})
		}
	}
	var grade = [<?= $grade->grade_1;?>,<?= $grade->grade_2;?>,<?= $grade->grade_3;?>,<?= $grade->grade_4;?>,<?= $grade->grade_5;?>];
	function changePrice(id, count){
		$("#price_" + id).html(count * grade[$("#grade_" + id).val() - 1]);
	}
</script>
