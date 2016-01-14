<div id="contents-wrap">
	<div id="main">
		<? echo Html::anchor("grameencom/events/edit/{$events->id}", '<i class="fa fa-cog"></i> Edit Event', [  "class" => "view-events"]); ?>
		<h3>Created Event</h3>
		<section class="content-wrap">
			Event Name: <strong><?= $events->title; ?></strong><br><br><br>
			Start Time: <strong><?= date("H:i A", $events->start_time); ?></strong> End Time: <strong><?= date("H:i A",$events->end_time); ?></strong><br><br><br>
			Event Details: <br>
			<strong><?= htmlspecialchars_decode($events->body); ?></strong>
		</section>
	</div>
</div>
<script>
	$(function(){
		var message = $('.feedback > p');

		message.css({
			'maxWidth':'1400px',
			'wordWrap':'break-word'
		});
	});
</script>