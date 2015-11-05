<div id="contents-wrap">
	<div id="main">
		<h3>Credit Card Payment</h3>
		<div class="content-wrap payment">
			<p class="catchcopy">Choose payment option</p>
			<ul class="select-course">
				<li>
					<table id="course-paypal-payment">
						<tr>
							<td class="choices">
								<p class="price"><span>US$400</span>for 12 lessons</p>
								<? if($id != null): ?>
								<div class="paypal-link">
									<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
										<input type="hidden" name="cmd" value="_s-xclick">
										<input type="hidden" name="hosted_button_id" value="VKUELYDYMMJP4">
										<table>
											<tr><td><input type="hidden" name="on0" value="user"></td></tr><tr><td><input type="hidden" name="os0" value="<?= $id; ?>"></td></tr>
										</table>
										<input type="submit" value="Buy Now" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
										<img alt="" border="0" src="https://www.paypalobjects.com/ja_JP/i/scr/pixel.gif" width="1" height="1">
									</form>
								</div>
								<? endif; ?>
							</td>
							<td valign="middle">
								<strong>OR</strong>
							</td>
							<td class="choices">
								<p class="price"><span>US$150</span>every 4 lessons</p>
								<? if($id != null): ?>
									<div class="paypal-link">
										<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
											<input type="hidden" name="cmd" value="_s-xclick">
											<input type="hidden" name="hosted_button_id" value="3BTSSRRJF2X8C ">
											<table>
												<tr><td><input type="hidden" name="on0" value="user"></td></tr><tr><td><input type="hidden" name="os0" value="<?= $id; ?>"></td></tr>
											</table>
											<input type="submit" value="Buy Now" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
											<img alt="" border="0" src="https://www.paypalobjects.com/ja_JP/i/scr/pixel.gif" width="1" height="1">
										</form>
									</div>
								<? endif; ?>
							</td>
						</tr>
					</table>
					<p class="paypal"><img src="http://pics.ebaystatic.com/aw/pics/uk/paypal/imgLockup.gif" alt="paypal"></p>
				</li>
			</ul>
		</div>
	</div>
	<? echo View::forge("students/_menu")->set($this->get()); ?>
</div>
