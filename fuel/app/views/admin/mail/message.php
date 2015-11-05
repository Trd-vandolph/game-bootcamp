<div id="contents-wrap">
	<div id="main">
		<h4>
			<table style="width: 100%">
				<tr>
					<td>
						To: <?php
							if ($mail->for_all == 1) {
								echo "Teachers and Students, including disabled News Emails (Critical Message)";
							} elseif ($mail->for_students == 1 && $mail->for_teachers == 0) {
								echo "Students (Enabled News Emails only)";
							} elseif ($mail->for_teachers == 1 && $mail->for_students == 0) {
								echo "Teachers (Enabled News Emails only)";
							} elseif ($mail->for_students == 1 && $mail->for_teachers == 1) {
								echo "Teachers and Students (enabled News Emails only)";
							}
						?>
					</td>
					<td>
						<div style="float: right;">Sent: <? echo date("H:i:s M d, Y", $mail->created_at); ?></div>
					</td>
				</tr>
			</table>
		</h4>
		<br>
		<?= $mail->title; ?><br><br>
		<section class="feedback">
			<?= htmlspecialchars_decode($mail->body); ?>
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
