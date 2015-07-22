<div id="contents-wrap">
	<div id="main">
		<h3>Contact from Students</h3>
		<p class="link-more"><? echo Html::anchor('/admin/contactforum', 'See Contact <i class="fa fa-angle-right"></i>'); ?></p>
		<section class="feedback">
			<ul class="list-base">
				<? foreach($contacts as $contact): ?>
					<li><a href="/admin/contactforum/detail/<?= $contact->id; ?>"><? if($contact->is_read == 0): ?><span class="icon-new">New</span><? endif; ?><?= $contact->title; ?> <strong><?= date("H:i M d, Y.", $contact->created_at); ?></strong> posted by <?= $contact->user->firstname; ?> <?= $contact->user->middlename; ?> <?= $contact->user->lastname; ?></a></li>
				<? endforeach; ?>
			</ul>
		</section>
		<a name="cal"></a>
		<section>
			<div id="contents-wrap">
				<div id="main" class="new-m">
				<h3>Events Created</h3>
				<p class="link-more"><? echo Html::anchor('/admin/top', ' <i class="fa fa-undo"></i> Switch to Home Calendar'); ?></p>
				<section id="draft">
					<table class="list-base" width="100%" border="0" cellpadding="0" cellspacing="0">
						<thead>
							<th>Event Title</th>
							<th>Date and Time of Event</th>
							<th></th>
						</thead>
							<? foreach($events as $new): ?>
								<? if ($new->deleted_at == 0): ?>
										<tr id="events_<?php echo $new->id?>">
											<td>
												<a href="/admin/grameencom/events/message/<?= $new->id; ?>" title="View Event Details">
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
												<? echo Html::anchor("admin/grameencom/events/edit/{$new->id}", '<i class="fa fa-cog"></i> Edit Event', [  "class" => "button green right draft-button"]); ?>
											</td>
										</tr>
								<? endif; ?>
							<? endforeach; ?>
						</table>
						<p class="view-events rt"><? echo Html::anchor("admin/grameencom/top", '<i class="fa fa-chevron-left"></i> Go back'); ?></p>
					<? echo $pager ?>
				</section>
			</div>
		</section>
	</div>
	<? echo View::forge("admin/_menu"); ?>
</div>
<script type="text/javascript">
	//remove from list
	function deleteEvents(id){

		if(confirm('Are you sure you want to delete the Event from the list?')){
			$.ajax({
				url: '/admin/api/delevents.json',
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