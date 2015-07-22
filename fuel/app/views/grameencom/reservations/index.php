<div id="contents-wrap">
	<div id="main">
		<p class="view-events"><? echo Html::anchor("grameencom/events/all", '<i class="fa fa-plus-circle"></i> View Created Events'); ?></p>
		<h3>Add Events</h3>
		<section class="content-wrap">
			<?
				$day = Input::get('year')."-".Input::get('month')."-".Input::get('day');
				$res = [];
				foreach($view as $views){
					if($day == date("Y-m-d", $views->freetime_at)){
						$res[] =  $views->freetime_at;
					}
				}
			?>
			<form action="" method="post" enctype="multipart/mime">
				<ul class="forms">
					<li>
						<? $date_event = array(
								"01" => "01", "02" => "02", "03" => "03", "04" => "04",
								"05" => "05", "06" => "06", "07" => "07", "08" => "08",
								"09" => "09", "10" => "10", "11" => "11", "12" => "12"
						);	?>
						<h4> Day: <? echo date("F d, Y", strtotime($day)) ?></h4>
					</li>
					<li>
						Event Name: <input class="title" type="text" name="title" value="" required autocomplete="off">
					</li>
					<li style="width: 40%;">
						<div class="li_starttime">
							Start Time:
							<select name="starttime" class="starttime">
								<option value="<?=strtotime($day." 10:00:00"); ?>"
								<? foreach($res as $reserved){
										if($reserved == strtotime($day." 10:00:00")){
											echo "disabled";
										}
									} ?>
								>10:00 AM</option>
								<option value="<?=strtotime($day." 11:00:00"); ?>"
								<? foreach($res as $reserved){
										if($reserved == strtotime($day." 11:00:00")){
											echo "disabled";
										}
									} ?>
								>11:00 AM</option>
								<option value="<?=strtotime($day." 12:00:00"); ?>"
								<? foreach($res as $reserved){
										if($reserved == strtotime($day." 12:00:00")){
											echo "disabled";
										}
									} ?>
								>12:00 AM</option>
								<option value="<?=strtotime($day." 13:00:00"); ?>"
								<? foreach($res as $reserved){
										if($reserved == strtotime($day." 13:00:00")){
											echo "disabled";
										}
									} ?>
								>1:00 PM</option>
								<option value="<?=strtotime($day." 14:00:00"); ?>"
								<? foreach($res as $reserved){
										if($reserved == strtotime($day." 14:00:00")){
											echo "disabled";
										}
									} ?>
								>2:00 PM</option>
								<option value="<?=strtotime($day." 15:00:00"); ?>"
								<? foreach($res as $reserved){
										if($reserved == strtotime($day." 15:00:00")){
											echo "disabled";
										}
									} ?>
								>3:00 PM</option>
								<option value="<?=strtotime($day." 16:00:00"); ?>"
								<? foreach($res as $reserved){
										if($reserved == strtotime($day." 16:00:00")){
											echo "disabled";
										}
									} ?>
								>4:00 PM</option>
								<option value="<?=strtotime($day." 17:00:00"); ?>"
								<? foreach($res as $reserved){
										if($reserved == strtotime($day." 17:00:00")){
											echo "disabled";
										}
									} ?>
								>5:00 PM</option>
							</select>
						</div>
						<div class="li_endtime">
							End Time:
							<select name="endtime" class="endtime">
								<option value="<?=strtotime($day." 10:59:00"); ?>">10:59 AM</option>
								<option value="<?=strtotime($day." 11:59:00"); ?>">11:59 AM</option>
								<option value="<?=strtotime($day." 12:59:00"); ?>">12:59 PM</option>
								<option value="<?=strtotime($day." 13:59:00"); ?>">1:59 PM</option>
								<option value="<?=strtotime($day." 14:59:00"); ?>">2:59 PM</option>
								<option value="<?=strtotime($day." 15:59:00"); ?>">3:59 PM</option>
								<option value="<?=strtotime($day." 16:59:00"); ?>">4:59 PM</option>
								<option value="<?=strtotime($day." 17:59:00"); ?>">5:59 PM</option>
							</select>
						</div>
						<label class="whole-day">
							Whole Day: <input class="checkbox" type="checkbox" name="allday" value="<?= strtotime($day); ?>">
						</label>
					</li>
					<li>
						Details:<textarea name="body"  rows="20" cols="100"></textarea>
					</li>
				</ul>
			<p class="button-area">
				<button class="button" name="action" value="draft">Save</button>
			</p>
			<? echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
			</form>
		</section>
	</div>
</div>
<script>
	//whole day checkbox
	$('.whole-day').on('click', function(){
		if ($('.checkbox').is(':checked')) {
			<? if(count($res)>0): ?>
				alert("Sorry, You can't create whole day event here. There's a class reservation on this day.")
				$('.checkbox').removeAttr('checked');
			<? else: ?>
				$('.starttime > option:nth-child(1)').attr('selected','selected');
				$('.endtime > option:nth-child(8)').attr('selected','selected');
			<? endif; ?>
		} else {
			$('.starttime > option:nth-child(1)').removeAttr('selected');
			$('.endtime > option:nth-child(8)').removeAttr('selected');
		}
	});

	//create array of option values
	var optionValues = [];
	$('.endtime option').each(function() {
		optionValues.push($(this).val());
	});

	//disable end time if lower than selected start time
	function disable(){
		var val = $(this).val();
		for (var i = 0; i < optionValues.length; i++) {
			if (optionValues[i] <= val) {
				$('.endtime option').each(function() {
					if($(this).val() == optionValues[i]){
						$(this).attr('disabled','disabled');
					}
				});
			}
		}
	}
	//enable all option
	function enable(){
		$('.endtime option').each(function() {
			$(this).removeAttr('disabled');
		});
	}
	
	//If I choose 1:00 PM as Start Time, End Time should appear from 2:00 PM.
	$('.starttime').on('change', function(){
		if($('.starttime > option:nth-child(1)').is(':selected')){
			$('.endtime > option:nth-child(1)').attr('selected','selected');
			enable(); $.proxy(disable, $('.starttime'))();
		} else if($('.starttime > option:nth-child(2)').is(':selected')) {
			$('.endtime > option:nth-child(2)').attr('selected','selected');
			enable(); $.proxy(disable, $('.starttime'))();
		} else if($('.starttime > option:nth-child(3)').is(':selected')) {
			$('.endtime > option:nth-child(3)').attr('selected','selected');
			enable(); $.proxy(disable, $('.starttime'))();
		} else if($('.starttime > option:nth-child(4)').is(':selected')) {
			$('.endtime > option:nth-child(4)').attr('selected','selected');
			enable(); $.proxy(disable, $('.starttime'))();
		} else if($('.starttime > option:nth-child(5)').is(':selected')) {
			$('.endtime > option:nth-child(5)').attr('selected','selected');
			enable(); $.proxy(disable, $('.starttime'))();
		} else if($('.starttime > option:nth-child(6)').is(':selected')) {
			$('.endtime > option:nth-child(6)').attr('selected','selected');
			enable(); $.proxy(disable, $('.starttime'))();
		} else if($('.starttime > option:nth-child(7)').is(':selected')) {
			$('.endtime > option:nth-child(7)').attr('selected','selected');
			enable(); $.proxy(disable, $('.starttime'))();
		} else if($('.starttime > option:nth-child(8)').is(':selected')) {
			$('.endtime > option:nth-child(8)').attr('selected','selected');
			enable(); $.proxy(disable, $('.starttime'))();
		} else if($('.starttime > option:nth-child(9)').is(':selected')) {
			$('.endtime > option:nth-child(9)').attr('selected','selected');
			enable(); $.proxy(disable, $('.starttime'))();
		} else if($('.starttime > option:nth-child(10)').is(':selected')) {
			$('.endtime > option:nth-child(10)').attr('selected','selected');
			enable(); $.proxy(disable, $('.starttime'))();
		}
	});

	//auto whole day
	$('.endtime').on('change', function(){
		if($('.endtime > option:nth-child(8)').is(':selected') && $('.starttime > option:nth-child(1)').is(':selected')){
			$('.checkbox').prop('checked', true);
		} else {
			$('.checkbox').removeAttr('checked');
		}
	});

	//remove auto whole day
	$('.starttime').on('change', function(){
		if($('.endtime > option:nth-child(8)').is(':selected') && $('.starttime > option:nth-child(1)').is(':selected')){
			$('.checkbox').prop('checked', true);
		} else {
			$('.checkbox').removeAttr('checked');
		}
	});

	//lengthen title and remove history
	$('.title').css('width','425px');
</script>
