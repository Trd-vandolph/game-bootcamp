<div id="contents-wrap">
	<div id="main">
		<h3>Payment</h3>
		<section class="content-wrap">
		<? foreach($payment as $payments): ?>
			<fieldset>
				<legend align="center"><h5 style="padding: 0 0 0 0;">Student Information</h5></legend>
				<?
				$student = Model_User::find("first", [
						"where" => [
								["id", $payments->student_id],
						]
				]);
				?>
				<table width="100%" cellpadding="10px" cellspacing="10px">
					<tbody>
						<tr>
							<td><strong>Name: </strong></td>
							<td><?=$student->firstname." ".$student->middlename." ".$student->lastname; ?></td>
						</tr>
						<tr>
							<td><strong>Place of Learning</strong></td>
							<td><? if($student->place == 1) {echo "Grameen Communicaton";}else{echo "Online School"; } ?></td>
						</tr>
						<tr>
							<td><strong>Lesson Progress</strong></td>
							<td>
								<? if($student->charge_html == 1): ?>
									<?
									$html = Model_Lessontime::count([
										"where" => [
											["language", 0],
											["student_id", $student->id],
											["status", 2],
											["deleted_at", 0]
										],
									]);

									$javascript = Model_Lessontime::count([
										"where" => [
											["language", 1],
											["student_id", $student->id],
											["status", 2],
											["deleted_at", 0]
										],
									]);
									?>
								HTML / CSS / JavaScript Course (<?= $html + $javascript; ?>/32)
								<? elseif($student->charge_html == 11): ?>
									<?
									$html = Model_Lessontime::count([
										"where" => [
											["language", 0],
											["student_id", $student->id],
											["status", 2],
											["deleted_at", 0]
										],
									]);

									$javascript = Model_Lessontime::count([
										"where" => [
											["language", 1],
											["student_id", $student->id],
											["status", 2],
											["deleted_at", 0]
										],
									]);
									?>
								HTML / CSS / JavaScript Course (<?= $html + $javascript; ?>/32)
								<? elseif($student->charge_html == 111): ?>
									<?
									$html = Model_Lessontime::count([
										"where" => [
											["language", 0],
											["student_id", $student->id],
											["status", 2],
											["deleted_at", 0]
										],
									]);

									$javascript = Model_Lessontime::count([
										"where" => [
											["language", 1],
											["student_id", $student->id],
											["status", 2],
											["deleted_at", 0]
										],
									]);
									?>
								HTML / CSS / JavaScript Course (<?= $html + $javascript; ?>/32)
								<? elseif($student->charge_html == 1111): ?>
									<?
									$html = Model_Lessontime::count([
										"where" => [
											["language", 0],
											["student_id", $student->id],
											["status", 2],
											["deleted_at", 0]
										],
									]);

									$javascript = Model_Lessontime::count([
										"where" => [
											["language", 1],
											["student_id", $student->id],
											["status", 2],
											["deleted_at", 0]
										],
									]);
									?>
								HTML / CSS / JavaScript Course (<?= $html + $javascript; ?>/32)
								<? else:?>
								No Lessons learned yet
								<? endif ?>
							</td>
						</tr>
					</tbody>
				</table>
			</fieldset>
			<br>
			<fieldset>
				<legend align="center"><h5 style="padding: 0 0 0 0;">Details</h5></legend>
				<table width="100%" cellpadding="10px" cellspacing="10px">
					<tbody>
						<tr>
							<td><strong>Date: </strong></td>
							<td><?=date("F d, Y H:i", $payments->paid_at); ?></td>
						</tr>
						<tr>
							<td><strong>Payment Method:</strong></td>
							<td>
								<?
									if($payments->pay_method == 1){
										echo "<i>Home</i> | Cash";
									}elseif($payments->pay_method == 2){
										echo "<i>Home</i> | Remittance";
									}elseif($payments->pay_method == 3){
										echo "<i>Home</i> | Credit Card";
									}elseif($payments->pay_method == 4){
										echo "<i>Grameen</i> | Cash ";
									}
								?>
							</td>
						</tr>
						<tr>
							<td><strong>Type of Payment:</strong></td>
							<td>
								<?
									if($payments->method == 1) {
										echo "<i>One-time payment</i>";
									}else {
										echo "<i>Installment</i> | ";
										if(strlen($payments->paid) == 1){
											echo "Quarter 1 (HTML/CSS Chapter 1-8)";
										}elseif(strlen($payments->paid) == 2){
											echo "Quarter 2 (HTML/CSS Chapter 9-16)";
										}elseif(strlen($payments->paid) == 3){
											echo "Quarter 3 (HTML/CSS Chapter 17-24)";
										}elseif(strlen($payments->paid) == 4){
											echo "Quarter 4 (JavaScript Chapter 1-8)";
										}
									}
								?>
							</td>
						</tr>
						<? if($payments->pay_method != 2) { ?>
							<tr>
								<td><strong>Receipt: </strong></td>
								<td width="70%">
									<figure><a href="/contents/receipt/<?=$payments->receipt; ?>"><img title="Click to open in full size" style="width: 40%" src="/contents/receipt/<?= $payments->receipt; ?>"></a></figure>
								</td>
							</tr>
						<? } else { ?>
							<tr>
								<td><strong>Reference Number: </strong></td>
								<td>
									<i>#<?=$payments->ref_no; ?></i>
								</td>
							</tr>
						<? } ?>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<form action="" method="post" enctype="multipart/form-data">
								<td colspan="2" align="center">
									<button name="action" value="submit" class="confirm" href="">Confirm <i class="fa fa-check-circle"></i></button>
									<a data-remodal-target="deny" class="delete" href="#">Cancel <i class="fa fa-times"></i></a>
								</td>
								<input type="text" name="payid" value="<?=$payments->id; ?>" hidden/>
							</form>
						</tr>
					</tbody>
				</table>
			</fieldset>
		<? endforeach; ?>
		</section>
		<?= Asset::js("base.js"); ?>
		<?= Asset::js("jquery.remodal.js"); ?>
	<div class="remodal" data-remodal-id="deny">
		<div class="modal-event">
			<section class="content-wrap" style="text-align: center;">
				<form action="" id="cancel" method="post" enctype="multipart/form-data">
					<input type="text" name="paymentID" value="<?=Input::get('id', 0); ?>" hidden>
					Why do you want to cancel this payment?<br><br>
					<textarea name="explain" class="reason"></textarea>
					<button onclick="$('#cancel').submit();" name="action" value="ok" class="ok" href="">Okay <i class="fa fa-check-circle"></i></button>
				</form>
			</section>
		</div>
	</div>
	</div>
<? echo View::forge("admin/_menu"); ?>
