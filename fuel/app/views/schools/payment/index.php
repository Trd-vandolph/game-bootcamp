<? $type = Input::get('type', 0); ?>
<form action="" method="post" enctype="multipart/form-data">
<? foreach($student as $students): ?>
<script>
$(function(){
	<?	
		$paid = $students->charge_html; 
		if($paid != 0) {?>
			<? if (strlen($paid) > 0 and strlen($paid) < 4) { ?>
					//alert();
					$('#method option:nth-child(1)').css('display', 'none');
					$('#method option:nth-child(2)').attr('selected','selected');
				
			<?} else {?>
					alert("We can't redirect you to payment page because you already paid full.");
					window.location.href = "/students/top";
			<?} ?>
	<? }?>
});
</script>
	
<div id="contents-wrap">
	<div id="main">
		<h3>Payment</h3>
			<div class="pay-content">
				<div id="first-block">
					<div id="first-left">
						<p>Date: </p>
						<p>Name: </p>
						<p>Place of learning: </p>
					</div>
					<div id="first-right">
						<p>
						<?
							$now = date("Y-m-d H:i:s");
							echo date('F d, Y') ;
						?>
						</p>
						<p><?=$students->firstname." ".$students->middlename." ".$students->lastname; ?></p>
						<p>
						<?
							if($students->place == 1){
								echo "Grameen Communication";
							}else {
								echo "Home";
							}
						?>
						</p>
						
						<!-- Hidden values -->
						<input type="text" name="date" value="<?=strtotime($now); ?>" hidden />
						<input type="text" name="studentId" value="<?=$students->id; ?>" hidden />
					
					</div>
				</div>
				<div id="second-block">
					<div id="second-left">
						<p>Type: </p>
						<p>Method: </p>
						<p class="quarter">Quarter to pay: </p>
						<p>Amount: </p>
						<p>Upload receipt: </p>
					</div>
					<div id="second-right">
						<p>
							<select name="type">
								<option value="1" <? if($type == 1 || $type == 4){echo "selected"; } ?>>Cash</option>
								<option value="2" <? if($type == 2){echo "selected"; } ?>>Remittance</option>
								<option value="3" <? if($type == 3){echo "selected"; } ?>>Credit Card</option>
							</select>
						</p>
						<p>
							<select id="method" name="method">
								<option value="1">Full</option>
								<option value="2">Installment</option>
							</select>
						</p>
						<?
							$count = strlen($paid);
							$q1 = 0; $q2 = 0; $q3 = 0; $q4 = 0;
							
							if($paid != 0 && $count > 0) {
								if($count == 1) {
									$q1 = 1;
								}elseif($count == 2) {
									$q1 = 1;
									$q2 = 2;
								}elseif($count == 3) {
									$q1 = 1;
									$q2 = 2;
									$q3 = 3;
								}elseif($count == 4) {
									$q1 = 1;
									$q2 = 2;
									$q3 = 3;
									$q4 = 4;
								}
							}
						?>
						<p class="quarter">
							<select name="quarter">
								<optgroup label="HTML/CSS">
									<option value="1" <? if($q1 == 1){echo "disabled"; } ?>>Quarter 1 (Chapter 1 - 7)</option>
									<option value="11" <? if($q2 == 2){echo "disabled"; } ?>>Quarter 2 (Chapter 8 - 16)</option>
									<option value="111" <? if($q3 == 3){echo "disabled"; } ?>>Quarter 3 (Chapter 17 - 24)</option>
								</optgroup>
								<optgroup label="Javascript">
									<option value="1111" <? if($q4 == 4){echo "disabled"; } ?>>Quarter 4 (Chapter 1 - 8)</option>
								</optgroup>
							</select>
						</p>
						<p><input type="text" name="amount" id="amount" required></p>
						<p><input type="file" name="photo"></p>
					</div>
				</div>
				<p class="button-area">
					<button name="action" value="submit" class="button" href="">Submit <i class="fa fa-upload"></i></button>
				</p>
			</div>		
	</div>
<? endforeach; ?>
</form>
	<? echo View::forge("students/_menu")->set($this->get()); ?>
</div>
<script>
	$(function(){
		var method = $('#method');
		var quarter = $('.quarter');		
		
		if(methodVal != 1) {
			quarter.css('display', 'block');
		}else {
			quarter.css('display', 'none');
		}
		
		method.on('change', function(){
			var methodVal = $('#method').val();
			if(methodVal != 1) {
				quarter.css('display', 'block');
			}else {
				quarter.css('display', 'none');
			}
		});

		 $('#second-right').on('keydown', '#amount', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||/65|67|86|88/.test(e.keyCode)&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
			
	});
</script>
