<div id="contents-wrap">
	<div id="main">
		<h3>Prices</h3>

		<div>
			<div style="float: right; margin: 10px;">
				<form action="" method="get" id="search_form">
					<select name="year" onchange="$('#search_form').submit();">
						<? for($i = 2015; $i <= date("Y"); $i++): ?>
							<option <? if(Input::get("year", date("Y")) == $i) echo "selected" ?> value="<? echo $i;
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
				<th>Month</th>
				<th>Grades</th>
			</tr>
			</thead>
			<tbody>
			<? for($i = 1; $i <= 12; $i++): ?>
				<?
				$grade = Config::get("prices");

				foreach($prices as $price){
					if($price->month == $i){
						$grade[0] = $price->grade_1;
						$grade[1] = $price->grade_2;
						$grade[2] = $price->grade_3;
						$grade[3] = $price->grade_4;
						$grade[4] = $price->grade_5;
					}
				}
				?>
				<form action="" method="post">
				<input type="hidden" name="month" value="<?= $i; ?>">
				<tr>
					<th class="number"><?= $i; ?></th>
					<td class="grades">
						<ul>
							<li>Grade1 : $<input type="text" value="<?= $grade[0]; ?>" name="grade_1"></li>
							<li>Grade2 : $<input type="text" value="<?= $grade[1]; ?>" name="grade_2"></li>
							<li>Grade3 : $<input type="text" value="<?= $grade[2]; ?>" name="grade_3"></li>
							<li>Grade4 : $<input type="text" value="<?= $grade[3]; ?>" name="grade_4"></li>
							<li>Grade5 : $<input type="text" value="<?= $grade[4]; ?>" name="grade_5"></li>
						</ul>
						<button class="button green right">Submit <i class="fa fa-chevron-right"></i></button>
					</td>
				</tr>
				</form>
			<? endfor; ?>
			</tbody>
		</table>
	</div>
	<? echo View::forge("admin/_menu"); ?>
</div>
<script>
	function deleteContent(id){

		if(confirm('Do you want to delete the data?')){
			$.ajax({
				url: '/admin/api/delcontent.json',
				type: 'POST',
				data: {
					"id": id
				},

				complete: function(){

				},
				success: function(res) {
					$("#content_" + id).hide();
				}
			})
		}
	}
</script>