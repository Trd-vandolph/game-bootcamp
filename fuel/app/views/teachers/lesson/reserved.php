<div id="contents-wrap">
	<div id="main">
		<h3>Reserved</h3>
		<table class="table-base" width="100%" border="0" cellpadding="0" cellspacing="0" >
			<thead>
			<tr>
				<th>Student</th>
				<th>Language</th>
				<th>Lesson at</th>
				<th>Status</th>
				<th>Hangout url</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
			<? if($reservations != null): ?>
				<? foreach($reservations as $reservation): ?>
				<tr id="reservation_<? echo $reservation->id; ?>">
					<td><? if($reservation->student != null) echo Html::anchor("teachers/students/detail/{$reservation->student_id}", $reservation->student->firstname); ?></td>
					<td><?php echo Model_Lessontime::getCourse($reservation->language); ?></td>
					<td><? echo date("M d, Y. H:i:s", $reservation->freetime_at); ?></td>
					<td><? echo Config::get("statics.reservation_status", [])[$reservation->status]; ?></td>
					<td><a href="<? echo $reservation->url,$reservation->url;?>" target="_blank">Link</a></td>
					<td>
						<?php if($reservation->freetime_at <= time() + 600): ?>
						<? echo Html::anchor("teachers/lesson/edit/{$reservation->id}", 'Set hangout url', [ "style" => "height:14px; line-height:14px", "class" => "button green right"]); ?>
						<?php else: ?>
							You can set hangout url 10 minutes before.
						<?php endif; ?></td>
				</tr>
				<? endforeach; ?>
			<? endif; ?>
			</tbody>
		</table>
		<? echo $pager ?>
	</div>
	<? echo View::forge("teachers/_menu"); ?>
</div>
