<?
if (Input::get('g', 0) == 1) {
	$g = "Home Course | Cash";
}elseif (Input::get('g', 0) == 4) {
	$g = "Grameen Course | Cash";
}

if (Input::get('e', 0) == 2) {
	$e = 1;
}

if(isset($student)) {
	$check = $student->charge_html;
}
?>
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
function initialize() {
	var mapProp = {
		center:new google.maps.LatLng(23.802838, 90.361081),
		zoom: 18,
		mapTypeId:google.maps.MapTypeId.ROADMAP
	};
	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>

<input id="check" type="text" name="check" <? if(isset($check)) { ?>value="<?=$check; ?>" <? }else {echo 'value=""';} ?> hidden />
<input id="error" type="text" name="error" value="<? if(isset($e)){echo $e; } ?>" hidden />
<section id="contents" class="fee">
	<h3 style="border: none;"><?=$g; ?></h3>
	<div class="pay-steps first">
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
						BDT 4,000   before booking lesson 8 / HTML&CSS<br>
						BDT 4,000   before booking lesson 16 / HTML&CSS<br>
						BDT 4,000   before booking lesson 1 / JavaScript<br>
					</p>
				</td>
			</tr>
		</table>
	</div>
	<div class="pay-steps second">
		<h4>Call Training Help Desk of Grameen Communications for appointment.</h4>
		<p>Training Help Desk Tel:+88-01713-371-440 <br>
		Attention: Mr. Md Safat Noor</p>
	</div>
	<div class="pay-steps third">
		<h4>Bring cash to Grameen Communications.  </h4>
			<p>Location: Grameen Bank Bhaban, 9th Floor, Mirpur-2, Dhaka-1216, Bangladesh</p>
			<br>
			<div id="googleMap" style="margin: auto; width:500px;height:380px;"></div>
	</div>
	<div class="pay-steps fourth">
		<h4>Get a receipt of the payment from Grameen Communications.</h4>
	</div>
	<div class="pay-steps fifth">
		<h4>Send a photo of the receipt by clicking the button below.</h4>
		<a class="how" data-remodal-target="upload" href="#">Payment is done</a>
	</div>
	<div class="pay-steps sixth">
		<h4>Once we confirm your photo of receipt, you can book a lesson.</h4>
	</div>
</section>
<?= Asset::js("base.js"); ?>
<?= Asset::js("jquery.remodal.js"); ?>
<? if(isset($student)) { ?>
	<div class="remodal" data-remodal-id="upload">
		<div class="modal-event">
			<section id="wrap" class="content-wrap" style="text-align: center;">
				<form action="" method="post" enctype="multipart/form-data" id="info">
					<? $studentID = $student->id; ?>
					<? $paymethod = Input::get('g', 0); ?>
					<? $now = date("Y-m-d H:i:s") ?>
					<? $paid = $student->charge_html."1"; ?>
					<? if($student->charge_html != NULL && $student->charge_html != 0){$method = 2;}else{$method=1;} ?>

					<?
						if($student->charge_html == 0) {
							$installment = "Quarter 1 (HTML/CSS Chapter 1-8)";
						}elseif($student->charge_html != 0 && strlen($student->charge_html) == 1){
							$installment = "Quarter 2 (HTML/CSS Chapter 9-16)";
						}elseif($student->charge_html != 0 && strlen($student->charge_html) == 2){
							$installment = "Quarter 3 (HTML/CSS Chapter 17-24)";
						}elseif($student->charge_html != 0 && strlen($student->charge_html) == 3){
							$installment = "Quarter 4 (JavaScript Chapter 1-8)";
						}elseif($student->charge_html != 0 && strlen($student->charge_html) == 4){
							$installment = "Nothing to display";
						}
					?>

					<input type="text" name="date" value="<?=strtotime($now); ?>" hidden />
					<input type="text" name="studentId" value="<?=$studentID; ?>" hidden />
					<input type="text" name="paymethod" value="<?=$paymethod; ?>" hidden />
					<input type="text" name="quarter" value="<?=$paid; ?>" hidden />
					<input type="text" name="g" value="<?=Input::get('g',0); ?>" hidden />

					Choose a type of payment
					<select name="method">
						<option
						<?  if($method == 1){
								echo "selected";
							}else {
								echo 'style="display: none;"';
							}
						?> value="1" >One-time</option>
						<optgroup label="Installment">
							<option
							<?  if($method == 2){
									echo "selected";
								}
							?> value="2"><?=$installment; ?></option>
						</optgroup>
					</select>
					<br><br>
					Upload receipt
					<input type="file" name="photo" style="margin-bottom: 20px;" id="file"><br>
					<hr style="border: solid 2px #7aae2a; margin-bottom: 20px;">
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
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
$(function(){
	var border = $('.bordered');
	var firstLeft = $('.first-left');
	var firstRight = $('.first-right');
	var button = $('.button');
	var pay = $('.how');
	var check = $('#check').val();
	var error = $('#error').val();
	var submit = $('#submit');
	var sub = $('#sub');
	var file = $('#file');
	sub.click(function(){
		if(file.val() == ""){
			Alert.render("You need to upload the receipt", 2);
		}else {
			Confirm.render("Are you sure you want to submit this payment information?", 2);
		}
	});

	if(check == "1111") {
		Alert.render("Payment of this account is already completed. Thank you.", 1);
	}
	if(error == 1) {
		Alert.render("There's already a pending payment on this quarter. Kindly wait for the admin to confirmed it. Thank you.", 1);
	}
	 <? if(!Auth::check()) {?>
	 		pay.click(function(){
		 		pay.removeAttr('data-remodal-target href');
				var yes =  Confirm.render("You must log-in first to your account before continuing.", 1);
			});
	<? 	}?>

	firstLeft.mouseenter(function(){firstLeft.css({'cursor' : 'pointer' ,})});

	firstRight.mouseenter(function(){firstRight.css({'cursor' : 'pointer' ,})});

	button.click(function(){button.css('color','black')})

	firstLeft.click(function(){
		firstLeft.css({
			'borderColor' : '#7aae2a' ,
			'borderRadius' : '10px' ,
			'cursor' : 'pointer' ,
		})
		firstRight.css({'borderColor' : '#f7f7f7' ,})
	});

	firstRight.click(function(){
		firstRight.css({
			'borderColor' : '#7aae2a' ,
			'borderRadius' : '10px' ,
			'cursor' : 'pointer' ,
		})
		firstLeft.css({'borderColor' : '#f7f7f7' ,})
	});

	$('#signup-button').css('display','none');
});

//custom alert

	function CustomAlert(){
		this.render = function(dialog,id){
			var winW = window.innerWidth;
			var winH = window.innerHeight;
			var dialogoverlay = document.getElementById('dialogoverlay');
			var dialogbox = document.getElementById('dialogbox');
			dialogoverlay.style.Sdisplay = "block";
			dialogoverlay.style.height = winH+"px";
			dialogbox.style.left = (winW/2) - (550 * .5)+"px";
			dialogbox.style.top = "100px";
			dialogbox.style.display = "block";
			document.getElementById('dialogboxhead').innerHTML = "<strong>Message</strong>";
			document.getElementById('dialogboxbody').innerHTML = dialog;
			document.getElementById('dialogboxfoot').innerHTML = '<button onclick="Alert.ok(\''+id+'\')">OK</button>';
		}
		this.ok = function(id){
			document.getElementById('dialogbox').style.displayS = "none";
			document.getElementById('dialogoverlay').style.display = "none";

			if(id == 1) {
				window.location="/students/top";
			}else{
				return false;
			}

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
