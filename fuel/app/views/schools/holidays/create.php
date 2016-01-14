<div id="contents-wrap">
	<div id="main">
		<p class="view-events"><? echo Html::anchor("grameencom/holidays/all", '<i class="fa fa-fw fa-calendar"></i> View Created Holidays'); ?></p>
		<h3>Create Holiday</h3>
		<section class="content-wrap">
			<form action="" method="post" enctype="multipart/mime">
				<ul class="forms">
					<li>
						Holiday Date:
						<select name="month" id="month">
							<?
							$y = "";
							$m = "";
							$d = "";
							$months = Config::get("statics.months", []);
							for($i = 1; $i <= 12; $i++): ?>
								<option <? if(Session::get_flash("month", 0) == $i) echo "selected"; ?> value="<? echo $i; ?>"><? echo $months[$i - 1]; ?></option>
							<? endfor; ?>
						</select>
						<select name="day" id="day">
							<? for($i = 1; $i <= 31; $i++): ?>
								<option <? if(Session::get_flash("day", 0) == $i) echo "selected"; ?> value="<? echo $i; ?>"><? echo $i; ?></option>
							<? endfor; ?>
						</select>
						<select name="year" id="year">
							<? for($i = date("Y"); $i >= 1920; $i--): ?>
								<option <? if(Session::get_flash("year", 0) == $i) echo "selected"; ?> value="<? echo $i; ?>"><? echo $i; ?></option>
							<? endfor; ?>
						</select>
					</li>
					<li>
						Holiday Name: <input type="text" name="title" value="" required>
					</li>
					
					<li style="width: 40%;">
						<div class="li_starttime">
							Start Time:
							<select name="starttime" class="starttime">
								<option value="<?=strtotime("10:00:00"); ?>" selected>10:00 AM</option>
							</select>
						</div>
						<div class="li_endtime">
							End Time:
							<select name="endtime" class="endtime">
								<option value="<?=strtotime("17:59:00"); ?>" selected>5:59 AM</option>
							</select>
						</div>
						<label class="whole-day">
							Whole Day: <input type="checkbox" name="allday" value="<?= strtotime($y . '-'. $m . '-' . $d); ?>" checked>
						</label>
					</li>
					<li>
						Details:<textarea name="body"  rows="20" cols="100"></textarea>
					</li>
				</ul>
			<p class="button-area">
				<button class="button" name="action" value="save">Save</button>
			</p>
			<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
			</form>
		</section>
	</div>
</div>


<script>
	$(function(){
			var y = $('#year');
			var m = $('#month');
			var d = $('#day');
			y.on('change', function(){
				alert(y.val() + '-' + m.val() + '-' + d.val());
				//$('.starttime').append('<option <?php echo 'selected';?>>hehe</option>');
				$.ajax({
					type: "POST",
					url: "/grameencom/api/holiday.json",
					data: "id=453&action=test",
					beforeSend: function(){
						
					},
					complete: function(){ 
					},
					success: function(html){ 
						$("#mydiv").append(html);
					}
				});
			});
	});
</script>

