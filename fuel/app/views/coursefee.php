<? if(!Auth::check()) {
		$paymentText = 'Sign up ';
		$paymentLink = '/students/signup';
	}else {
		$paymentText = 'Go To Payment ';
		$paymentLink = '/students/course';
	}
?>
<section id="contents" class="coursefee">
	<div class="coursefee-content content-text">
		<div id="content">
			<p class="sub-title">Course Fee</p>
			<div id="cf-illustration">
				<div id="first-section">
					<div class="payment">
						<div class="header">One-time</div>
						<div class="body">
							<div class="amount" style="text-align: center">
								<p>
									<strong>US$300</strong><br>
									for 12 lessons
								</p>
							</div>
						</div>
						<div class="footer"><p class="button"><a href="<?php echo $paymentLink; ?>"><?php echo $paymentText; ?></a></p></div>
					</div>
					<div class="payment">
						<div class="header">Installment</div>
						<div class="body">
							<div class="amount" align="center">
								<p><strong>US$110</strong><br>
								every 4 lessons
							</p>
							</div>
						</div>
						<div class="footer"><p class="button"><a href="<?php echo $paymentLink; ?>"><?php echo $paymentText; ?></a></p></div>
					</div>
				</div>
				<div id="second-section">
					<div>
						<img src="../assets/img/front/coursefee.png" alt="course-cycle" />
					</div>
				</div>
			</div>
			<br><br>
			<? if(!Auth::check()) {
					$redirectCredit = "/students/signin/?p=1&g=3";
				}else {
					$redirectCredit = "/students/courses/";
				}
			?>
			<p class="sub-title">Payment</p>
			<div id="coursefee-content1">
				<div id="first-content">
					<a href="http://www.paypal.com"><img src="../assets/img/front/paypal.png" alt="Paypal Logo"/></a>
				</div>
				<div id="second-content">
					<br>
						<a href="http://www.paypal.com"><p class="p-left">PayPal</p></a>
					<br><br>
						<p>PayPal is a global online payment service.</p>
						<p>You can use most of the major credit cards including VISA, Master, American Express.</p>
						<p>Choose either one-time or installment payment.</p>
						<a href="<?=$redirectCredit; ?>"><button class="button">Go to Payment</button></a>
				</div>
			</div>
		</div>
	</div>
</section>
