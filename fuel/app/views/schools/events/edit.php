<div id="contents-wrap">
	<div id="main">
		<p class="view-events"><? echo Html::anchor("grameencom/top", '<i class="fa fa-chevron-left"></i> Go back'); ?></p>
		<h3>Edit Information</h3>
		<section class="content-wrap">
			<form action="" method="post" enctype="multipart/mime">
				<ul class="forms">
					<li>
						Event Name: <input type="text" name="title" value="<?= $events->title; ?>" required>
					</li>
					<li>
					<?
					$url = $_SERVER['REQUEST_URI'];
					
					if(preg_match("/\/(\d+)$/",$url,$matches)){$end=$matches[1];}

					$edit = Model_Events::query()->where('id', $end)->limit(1)->get_one();
					$date = Model_Events::find($edit->id);

					if($date->allday != NULL || $date->allday != 0){
						$day = date("Y-m-d", $date->allday);
						$time_start = date("H:i:s",$date->allday);
					}else{
						$day = date("Y", $date->start_time)."-".date("m", $date->start_time)."-".date("d", $date->start_time);
						$time_start = $date->start_time;
						$time_end = $date->end_time;
					}
					
					?>
						Start Time:
						<select name="starttime" class="starttime">
							<option value="<?=strtotime($day." 10:00:00"); ?>"
								<? if($time_start == strtotime($day." 10:00:00")){
										echo "selected";
									} ?>
							>10:00 AM</option>
							<option value="<?=strtotime($day." 11:00:00"); ?>"
								<? if($time_start == strtotime($day." 11:00:00")){
										echo "selected";
									} ?>
							>11:00 AM</option>
							<option value="<?=strtotime($day." 12:00:00"); ?>"
								<? if($time_start == strtotime($day." 12:00:00")){
										echo "selected";
									} ?>
							>12:00 AM</option>
							<option value="<?=strtotime($day." 13:00:00"); ?>"
								<? if($time_start == strtotime($day." 13:00:00")){
										echo "selected";
									} ?>
							>1:00 PM</option>
							<option value="<?=strtotime($day." 14:00:00"); ?>"
								<? if($time_start == strtotime($day." 14:00:00")){
										echo "selected";
									} ?>
							>2:00 PM</option>
							<option value="<?=strtotime($day." 15:00:00"); ?>"
								<? if($time_start == strtotime($day." 15:00:00")){
										echo "selected";
									} ?>
							>3:00 PM</option>
							<option value="<?=strtotime($day." 16:00:00"); ?>"
								<? if($time_start == strtotime($day." 16:00:00")){
										echo "selected";
									} ?>
							>4:00 PM</option>
							<option value="<?=strtotime($day." 17:00:00"); ?>"
								<? if($time_start == strtotime($day." 17:00:00")){
										echo "selected";
									} ?>
							>5:00 PM</option>
						</select>
						End Time:
						<select name="endtime" class="endtime" value="<?= $events->end_time; ?>">
							<option value="<?=strtotime($day." 10:59:00"); ?>"
								<? if(isset($time_end) && $time_end == strtotime($day." 10:59:00")){
										echo "selected";
									} ?>
							>10:59 AM</option>
							<option value="<?=strtotime($day." 11:59:00"); ?>"
								<? if(isset($time_end) && $time_end == strtotime($day." 11:59:00")){
										echo "selected";
									} ?>
							>11:59 PM</option>
							<option value="<?=strtotime($day." 12:59:00"); ?>"
								<? if(isset($time_end) && $time_end == strtotime($day." 12:59:00")){
										echo "selected";
									} ?>
							>12:59 PM</option>
							<option value="<?=strtotime($day." 13:59:00"); ?>"
								<? if(isset($time_end) && $time_end == strtotime($day." 13:59:00")){
										echo "selected";
									} ?>
							>1:59 PM</option>
							<option value="<?=strtotime($day." 14:59:00"); ?>"
								<? if(isset($time_end) && $time_end == strtotime($day." 14:59:00")){
										echo "selected";
									} ?>
							>2:59 PM</option>
							<option value="<?=strtotime($day." 15:59:00"); ?>"
								<? if(isset($time_end) && $time_end == strtotime($day." 15:59:00")){
										echo "selected";
									} ?>
							>3:59 PM</option>
							<option value="<?=strtotime($day." 16:59:00"); ?>"
								<? if(isset($time_end) && $time_end == strtotime($day." 16:59:00")){
										echo "selected";
									} ?>
							>4:59 PM</option>
							<option value="<?=strtotime($day." 17:59:00"); ?>"
								<? if(isset($time_end) && $time_end == strtotime($day." 17:59:00")){
										echo "selected";
									} ?>
							>5:59 PM</option>
						</select>
						<label class="whole-day">
							Whole Day: <input class="checkbox" type="checkbox" name="allday" value="<?= strtotime($day); ?>">
						</label>
					</li>
					<li>
						Details:<textarea name="body"  rows="20" cols="100"><?= $events->body; ?></textarea>
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
	<?$allday = $events->allday;?>
	<? if($allday != NULL || $allday !=0 ){ ?>
			$('.checkbox').attr('checked','checked');
	<? } ?>
	
 	if ($('.checkbox').is(':checked')) {
		$('.endtime > option:nth-child(8)').attr('selected','selected');
	}
	
	$('.endtime').on('change', function(){
		$('.checkbox').removeAttr('checked');
	});

	$('.endtime').on('change', function(){
		if($('.starttime > option:nth-child(1)').is(':selected') && $('.endtime > option:nth-child(8)').is(':selected')){
			$('.checkbox').prop('checked',true);
		}
	});
	
	//whole day checkbox
	$('.whole-day').on('click' ,function(){
		if ($('.checkbox').is(':checked')) {
			$('.starttime > option:nth-child(1)').attr('selected','selected');
			$('.endtime > option:nth-child(8)').attr('selected','selected');
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
			enable();
			$.proxy(disable, $('.starttime'))();
		} else if($('.starttime > option:nth-child(2)').is(':selected')) {
			$('.endtime > option:nth-child(2)').attr('selected','selected');
			enable();
			$.proxy(disable, $('.starttime'))();
		} else if($('.starttime > option:nth-child(3)').is(':selected')) {
			$('.endtime > option:nth-child(3)').attr('selected','selected');
			enable();
			$.proxy(disable, $('.starttime'))();
		} else if($('.starttime > option:nth-child(4)').is(':selected')) {
			$('.endtime > option:nth-child(4)').attr('selected','selected');
			enable();
			$.proxy(disable, $('.starttime'))();
		} else if($('.starttime > option:nth-child(5)').is(':selected')) {
			$('.endtime > option:nth-child(5)').attr('selected','selected');
			enable();
			$.proxy(disable, $('.starttime'))();
		} else if($('.starttime > option:nth-child(6)').is(':selected')) {
			$('.endtime > option:nth-child(6)').attr('selected','selected');
			enable();
			$.proxy(disable, $('.starttime'))();
		} else if($('.starttime > option:nth-child(7)').is(':selected')) {
			$('.endtime > option:nth-child(7)').attr('selected','selected');
			enable();
			$.proxy(disable, $('.starttime'))();
		} else if($('.starttime > option:nth-child(8)').is(':selected')) {
			$('.endtime > option:nth-child(8)').attr('selected','selected');
			enable();
			$.proxy(disable, $('.starttime'))();
		} else if($('.starttime > option:nth-child(9)').is(':selected')) {
			$('.endtime > option:nth-child(9)').attr('selected','selected');
			enable();
			$.proxy(disable, $('.starttime'))();
		} else if($('.starttime > option:nth-child(10)').is(':selected')) {
			$('.endtime > option:nth-child(10)').attr('selected','selected');
			enable();
			$.proxy(disable, $('.starttime'))();
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
});
</script>
