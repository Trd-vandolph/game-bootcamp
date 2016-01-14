<? 
	$viewEvent = 0;
	if(Input::get('view', '0') != 0){
		$view = Input::get('view', '0');
		$viewEvent = 1;
	}
	
	$today = Input::get('year')."-".Input::get('day')."-".Input::get('month');
?>
<div id="contents-wrap">
	<div id="main">
		<p class="view-events"><? echo Html::anchor("grameencom/top", '<i class="fa fa-chevron-left"></i> Go back'); ?></p>
		<h3>Events Created</h3>
		<section id="draft">
			<table class="list-base" width="100%" border="0" cellpadding="0" cellspacing="0">
				<thead>
					<th>Event Title</th>
					<th>Date and Time of Event</th>
					<th></th>
				</thead>
				<? if($viewEvent == 0){ ?>
					<? foreach($events as $new): ?>
						<? if ($new->deleted_at == 0): ?>
							<? if($today == date("Y-d-m", $new->start_time)): ?>
								<tr id="events_<?php echo $new->id?>">
									<td>
										<a href="/grameencom/events/message/<?= $new->id; ?>" title="View Event Details">
											<strong><?= $new->title; ?></strong>
										</a>
									</td>
									<td>
										<strong><?= date('H:i A', $new->start_time); ?> - <?= date('H:i A', $new->end_time); ?>, <?= date('l jS \of F Y ', $new->start_time); ?></strong>
									</td>
									<td>
										<button class="button gray right" onclick="deleteEvents(<? echo $new->id; ?>)">
											<i class="fa fa-times"></i> Remove Event
										</button>
										<? echo Html::anchor("grameencom/events/edit/{$new->id}", '<i class="fa fa-cog"></i> Edit Event', [  "class" => "button green right draft-button"]); ?>
									</td>
								</tr>
							<? endif; ?>
						<? endif; ?>
					<? endforeach; ?>
				<? }else{ ?>
					<? foreach($events as $new): ?>
						<? if ($new->deleted_at == 0): ?>
								<? if($new->id == $view):?>
									<tr id="events_<?php echo $new->id?>">
										<td>
											<a href="/grameencom/events/message/<?= $new->id; ?>" title="View Event Details">
												<strong><?= $new->title; ?></strong>
											</a>
										</td>
										<td>
											<strong><?= date('H:i A', $new->start_time); ?> - <?= date('H:i A', $new->end_time); ?>, <?= date('l jS \of F Y ', $new->start_time); ?></strong>
										</td>
										<td>
											<button class="button gray right" onclick="deleteEvents(<? echo $new->id; ?>)">
												<i class="fa fa-times"></i> Remove Event
											</button>
											<? echo Html::anchor("grameencom/events/edit/{$new->id}", '<i class="fa fa-cog"></i> Edit Event', [  "class" => "button green right draft-button"]); ?>
										</td>
									</tr>
								<? endif; ?>
						<? endif; ?>
					<? endforeach; ?>
				<? } ?>
			</table>
			<? echo $pager ?>
		</section>
	</div>
</div>
<script type="text/javascript">
	//remove from list
	function deleteEvents(id){

		if(confirm('Are you sure you want to delete the Event from the list?')){
			$.ajax({
				url: '/grameencom/api/delevents.json',
				type: 'POST',
				data: {
					"id": id
				},

				complete: function(){

				},
				success: function(res) {
					$("#events_" + id).hide();
				}
			})
		}
	}

 	$(function(){
 	 	var t = $(this);
 		var tableBase = $('table.list-base');
 		var a = $('table.list-base tr a');
 		var th = $('table th');
 		var th1 = $('table.list-base th:nth-child(1)');
 		var th2 = $('table.list-base th:nth-child(2)');
 		var th3 = $('table.list-base th:nth-child(3)');
 		var th4 = $('table.list-base th:nth-child(4)');
 		var editDraft = $('.draft-button');

 		//responsive table
 		tableBase.css('width','100%');
 		a.on('mouseover', function(){
 			t.css('textDecoration','underline');
 	 	});

 		//adding table head titles
 		th.css({
	 		'background' : '#9A9492',
	 		'color' : '#fff',
	 		'border-right' : 'none',
	 		'text-align' : 'left',
	 		'padding' : '15px 20px'
 	 	});
 		th1.css('border-radius' , '3px 0 0 3px');
 		th2.css('padding','15px 0');
 		th3.add(th4).css('border-radius' , '0 3px 3px 0');
 		editDraft.css('padding','10px 30px');
		$('#draft tr td:eq(0)').css('width','34%');
	});
</script>