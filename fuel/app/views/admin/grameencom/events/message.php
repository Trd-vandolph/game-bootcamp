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
					<? echo Html::anchor("admin/grameencom/events/edit/{$events->id}", '<i class="fa fa-cog"></i> Edit Event', [  "class" => "view-events"]); ?>
					<h3>Created Event</h3>
					<section class="content-wrap">
						Event Name: <strong><?= $events->title; ?></strong><br><br><br>
						Start Time: <strong><?= date("H:i A", $events->start_time); ?></strong> End Time: <strong><?= date("H:i A",$events->end_time); ?></strong><br><br><br>
						Event Details: <br>
						<strong><?= htmlspecialchars_decode($events->body); ?></strong>
					</section>
				</div>
			</div>
			<p class="view-events rt"><? echo Html::anchor("admin/grameencom/top", '<i class="fa fa-chevron-left"></i> Go back'); ?></p>
		</section>
	</div>
	<? echo View::forge("admin/_menu"); ?>
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