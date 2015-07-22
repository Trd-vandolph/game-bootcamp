<? 
if (Input::get('g', 0) == 2) {
	$g = "Home | Remittance";
}

if (Input::get('e', 0) == 2) {
	$e = 1;
}

if(isset($student)) {
	$check = $student->charge_html;
}
?>
<input id="check" type="text" name="check" <? if(isset($check)) { ?>value="<?=$check; ?>" <? }else {echo 'value=""';} ?> hidden />
<input id="error" type="text" name="error" value="<? if(isset($e)){echo $e; } ?>" hidden />
<section id="contents" class="fee">
	<h3 style="border: none;"><?=$g; ?></h3>
	<div class="remit-steps remit-first">
		<h4>Choose one-time or installment payment</h4>
			<table>
				<tr>
					<td width="40%" style="border: none;"><p class="firstOpt"><strong>One-Time</strong><br> BDT 16,000</p></td>
					<td width="60%" style="border: none;">
						<p>
						<strong>Installment</strong>
						</p>
						<p style="text-align: left; margin-left: 10px">
						BDT 4,000   before booking lesson 1 / HTML&CSS<br>
						BDT 4,000   before booking lesson 9 / HTML&CSS<br>
						BDT 4,000   before booking lesson 17 / HTML&CSS<br>
						BDT 4,000   before booking lesson 1 / JavaScript<br>
						</p>
					</td>
				</tr>
			</table>
	</div>
	<div class="remit-steps remit-second">
		<h4>Go to MoneyGram agency</h4>
		<a href="https://secure.moneygram.com/locations"><img title="Visit site" src="/assets/img/front/moneygram.png" height="60"></a>
		<br><br>
		<p style="width: 345px; margin: auto;">Find your nearest MoneyGram agency here: <a href="https://secure.moneygram.com/locations">https://secure.moneygram.com/locations</a></p>
	</div>
	<div class="remit-steps remit-third">
		<h4>Send money to:  </h4>
		<p style="width: 200px; text-align:left; margin: auto;"><strong>Name:</strong> Hiroto Ihara</p>
		<p style="width: 200px; text-align:left; margin: auto;"><strong>Country:</strong> Japan</p>
		<h4 id="send">And get 8-digit Reference Number from the agency.</h4>
		<p><strong>Note: </strong>Note you have to pay fees charged by the agency. </p>
	</div>
	<div class="remit-steps remit-fourth">
		<h4>Click the button below after sending money and input 8-digit</h4>
		<h4 id="ref">Reference Number.</h4>
		<a class="how" data-remodal-target="done" href="#">Payment is done</a>
	</div>
	<div class="remit-steps remit-fifth">
		<h4>Once we confirm money comes to our account, you can book a lesson.</h4>
	</div>
</section>
<?= Asset::js("base.js"); ?>
<?= Asset::js("jquery.remodal.js"); ?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<? if(isset($student)) { ?>
	<div class="remodal" data-remodal-id="done" style="max-width: 900px;">
		<div class="modal-event">
			<section class="content-wrap" style="text-align: center;">
				
				<? $studentID = $student->id; ?>
				<? $paymethod = Input::get('g', 0); ?>
				<? $now = date("Y-m-d H:i:s") ?>
				<? $paid = $student->charge_html."1"; ?>
				<? if($student->charge_html != NULL && $student->charge_html != 0){$method = 2;}else{$method=1;} ?>
				
				<form action="" method="post" enctype="multipart/form-data">
					<? if($method == 1) { ?>
						Choose which type of payment (Click below)
					<? }elseif($method == 2) { ?>
						Since you started paying through Installment, you can only choose Installment. (Click below)
					<? } ?>
							<table width="100%;">
								<? if($method == 1) { ?>
									<tr>
										<td class="bordered first-left" width="48%"><p><strong>One-Time</strong><br> BDT 16,000</p></td>
										<td width="4%"><strong>or</strong></td>
										<td class="bordered first-right" width="48%">
											<p>
												<strong>Installment</strong>
											</p>
											<p style="text-align: left; margin-left: 30px;">
												BDT 4,000   before lesson 1 / HTML&CSS<br>
												BDT 4,000   before lesson 9 / HTML&CSS<br>
												BDT 4,000   before lesson 17 / HTML&CSS<br>
												BDT 4,000   before lesson 1 / JavaScript<br>
											</p>
										</td>
									</tr>
								<? }else { ?>
									<tr>
										<td colspan="3" class="bordered first-right" width="48%">
											<p>
												<strong>Installment</strong>
											</p>
											<p>
												BDT 4,000   before lesson 1 / HTML&CSS<br>
												BDT 4,000   before lesson 9 / HTML&CSS<br>
												BDT 4,000   before lesson 17 / HTML&CSS<br>
												BDT 4,000   before lesson 1 / JavaScript<br>
											</p>
										</td>
									</tr>
								<? } ?>
								<tr>
									<td colspan="3" style="height: 30px;"><hr style="border: solid 2px #7aae2a;"></td>
								</tr>
								<tr>
									<td style="text-align: right;"><strong>Enter Reference Number:</strong></td>
									<td width="1%"></td>
									<td style="text-align: left;">
										<input type="text" class="digit" id="refno1" style="width: 10px; min-width: 10px;" />
										-
										<input type="text" class="digit" id="refno2" style="width: 10px; min-width: 10px;" />
										-
										<input type="text" class="digit" id="refno3" style="width: 10px; min-width: 10px;" />
										-
										<input type="text" class="digit" id="refno4" style="width: 10px; min-width: 10px;" />
										-
										<input type="text" class="digit" id="refno5" style="width: 10px; min-width: 10px;" />
										-
										<input type="text" class="digit" id="refno6" style="width: 10px; min-width: 10px;" />
										-
										<input type="text" class="digit" id="refno7" style="width: 10px; min-width: 10px;" />
										-
										<input type="text" class="digit" id="refno8" style="width: 10px; min-width: 10px;" />
									</td>
								</tr>
							</table>
						<input type="text" name="date" value="<?=strtotime($now); ?>" hidden />
						<input type="text" name="studentId" value="<?=$studentID; ?>" hidden />
						<input type="text" name="paymethod" value="<?=$paymethod; ?>" hidden />
						<input type="text" name="quarter" value="<?=$paid; ?>" hidden />
						<input type="text" id="pay-method" name="pay-method" hidden/>
						<input type="text" id="refno" name="refno" hidden/>
						<p class="button-area" style="margin: 15px 0px 0px 0px;">
							<a class="submit-button" id="sub">Submit <i class="fa fa-upload"></i></a>
							<button name="action" value="submit" class="button" href="" id="submit" hidden />
					</p>
				</form>
			</section>
		</div>
	</div>
<? } ?>
<div id="dialogoverlay"></div>
<div id="dialogbox">
  <div>
    <div id="dialogboxhead"></div>
    <div id="dialogboxbody"></div>
    <div id="dialogboxfoot"></div>
  </div>
</div>
<script>


$(function(e){
	
	var border = $('.bordered');
	var firstLeft = $('.first-left');
	var firstRight = $('.first-right');
	var button = $('.button');
	var pay = $('.how');
	var check = $('#check').val();
	var error = $('#error').val();
	var payMethod = $('#pay-method');
	var submit = $('#submit');
	var sub = $('#sub');
	var refno = $('#refno');

	var digit = $('.digit');
	var refno1 = $('#refno1');
	var refno2 = $('#refno2');
	var refno3 = $('#refno3');
	var refno4 = $('#refno4');
	var refno5 = $('#refno5');
	var refno6 = $('#refno6');
	var refno7 = $('#refno7');
	var refno8 = $('#refno8');

	$("#refno2, #refno3, #refno4, #refno5, #refno6, #refno7, #refno8").attr("disabled", true);

	sub.click(function(){
		Confirm.render("Are you sure you want to submit this payment information?", 2);
	});
	
	digit.keyup(function() {
		if(refno1.val().length > 0) { 
			refno2.removeAttr("disabled");
			refno2.focus();
		}else{
			refno2.attr("disabled", true);
		}
		if(refno2.val().length > 0) {
			refno3.removeAttr("disabled");
			refno3.focus();
		}else{
			refno3.attr("disabled", true);
		}
		if(refno3.val().length > 0) { 
			refno4.removeAttr("disabled");
			refno4.focus();
		}else{
			refno4.attr("disabled", true);
		}
		if(refno4.val().length > 0) {
			refno5.removeAttr("disabled");
			refno5.focus();
		}else{
			refno5.attr("disabled", true);
		}
		if(refno5.val().length > 0) {
			refno6.removeAttr("disabled");
			refno6.focus();
		}else {
			refno6.attr("disabled", true);
		}
		if(refno6.val().length > 0) { 
			refno7.removeAttr("disabled");
			refno7.focus();
		}else{
			refno7.attr("disabled", true);
		}
		if(refno7.val().length > 0) { 
			refno8.removeAttr("disabled");
			refno8.focus();
		}else{
			refno8.attr("disabled", true);
		}
		refno.val(refno1.val() + refno2.val() + refno3.val() + refno4.val() + refno5.val() + refno6.val() + refno7.val() + refno8.val())
	});
	$(".digit").keypress(function (e) {
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			Alert.render('You must enter numbers only. Please try again');
			return false;
		}
	});
	submit.click(function(e){
			if(refno.val().length != 8) {
	 			if(payMethod.val().length < 1) {
	 	 			Alert.render("You need to select a type of payment.");
	 	 			return false;
	 			}else {
				Alert.render("You must enter 8 digits to proceed.");
				return false;
	 			}
	 		}
	});

	if(check == "1111") {
		Alert.render("Payment of this account is already completed. Thank you.");
		window.location="/students/top";
	}
	if(error == 1) {
		Alert.render("There's already a pending payment on this quarter. Kindly wait for the admin to confirmed it. Thank you.");
		window.location="/students/top";
	}
	 <? if(!Auth::check()) {?>
		pay.click(function(){
	 		pay.removeAttr('data-remodal-target href');
			var yes =  Confirm.render("You must log-in first to your account before continuing.", 1);
		});
<? 	}?>

	button.click(function(){button.css('color','black')})
	
	firstLeft.click(function(){
		payMethod.val("1");
		firstLeft.css({
			'borderColor' : '#7aae2a' ,
		})
		firstRight.css({'borderColor' : '#f7f7f7' ,})
	});

	firstRight.click(function(){
		payMethod.val("2");
		firstRight.css({
			'borderColor' : '#7aae2a' ,
		})
		firstLeft.css({'borderColor' : '#f7f7f7' ,})
	});

	
	$('#signup-button').css('display','none');
});

//custom alert

function CustomAlert(){
    this.render = function(dialog){
        var winW = window.innerWidth;
        var winH = window.innerHeight;
        var dialogoverlay = document.getElementById('dialogoverlay');
        var dialogbox = document.getElementById('dialogbox');
        dialogoverlay.style.display = "block";
        dialogoverlay.style.height = winH+"px";
        dialogbox.style.left = (winW/2) - (550 * .5)+"px";
        dialogbox.style.top = "100px";
        dialogbox.style.display = "block";
        document.getElementById('dialogboxhead').innerHTML = "<strong>Message</strong>";
        document.getElementById('dialogboxbody').innerHTML = dialog;
        document.getElementById('dialogboxfoot').innerHTML = '<button onclick="Alert.ok()">OK</button>';
    }
	this.ok = function(){
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
	}
}
var Alert = new CustomAlert();

//end alert	

//custom confirm
function CustomConfirm(){
	this.render = function(dialog,id){
		var winW = window.innerWidth;
	    var winH = window.innerHeight;
		var dialogoverlay = document.getElementById('dialogoverlay');
	    var dialogbox = document.getElementById('dialogbox');
		dialogoverlay.style.display = "block";
	    dialogoverlay.style.height = winH+"px";
		dialogbox.style.left = (winW/2) - (550 * .5)+"px";
	    dialogbox.style.top = "100px";
	    dialogbox.style.display = "block";
		
		document.getElementById('dialogboxhead').innerHTML = "<strong>Confirm your action</strong>";
	    document.getElementById('dialogboxbody').innerHTML = dialog;
		document.getElementById('dialogboxfoot').innerHTML = '<button onclick="Confirm.yes(\''+id+'\')">Yes</button> <button onclick="Confirm.no()">Cancel</button>';
	}
	this.no = function(){
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
	}
	this.yes = function(id){
		
		if(id == 1) {
			window.location="/students/signin/?p=1&g=" + <?= Input::get('g', 0); ?>
		}else if(id == 2) {
			$(function(){
				$('#submit').trigger("click");
			});
		}
	}
}
var Confirm = new CustomConfirm();
//end confirm

</script>
