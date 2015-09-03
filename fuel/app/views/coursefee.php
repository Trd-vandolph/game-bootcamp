<section id="contents" class="coursefee">
	<div class="coursefee-content content-text">
		<div id="content">
			<p class="sub-title">Course Fee</p>
			<table cellspacing="0" id="table-coursefee">
				<thead>
					<tr>
						<th>Subject</th>
						<th>No. of Lesson</th>
						<th>Term</th>
						<th>Course Fee</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>enchant.js</td>
						<td>12</td>
						<td>3 months</td>
						<td>
							<table id="inside-coursefee">
								<tbody>
									<tr>
										<td>One-time payment</td>
										<td>US$300</td>
									</tr>
									<tr>
										<td>Installment Payment</td>
										<td>US$110 x 3 times</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
			<br><br>
			<? if(!Auth::check()) {
					$redirectCredit = "/students/signin/?p=1&g=3";
				}else {
					$redirectCredit = "/students/courses/";
				}
			?>
			<p class="sub-title">Payment</p>
				<br>
					<a href="http://www.paypal.com"><p class="p-left">PayPal</p></a>
				<br><br>
					<a href="http://www.paypal.com"><img src="../assets/img/front/paypal.png" alt="Paypal Logo"/></a>
				<br><br>
					<p>PayPal is a global online payment service.</p>
					<p>You can use most of the major credit cards including VISA, Master, American Express.</p>
					<p>Choose either one-time or installment payment.</p>
					<a href="<?=$redirectCredit; ?>"><button class="button">Go to Payment</button></a>
		</div>
	</div>
</section>