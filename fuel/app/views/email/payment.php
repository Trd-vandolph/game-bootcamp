▼Payment Details<br><br>
Full name: <?= $user->firstname." ".$user->middlename." ".$user->lastname; ?><br>
<br>
Email address: <?= $user->email; ?><br>
<br>
Place of Learning: <? if($user->place == 0){ echo "Online School"; }else {echo "Grameen Communication"; } ?> <br>
<br>
Date: <?=date("F d,Y H:i", $pay->paid_at)?><br><br>
Payment Method: 
<? 
if($pay->pay_method == 1) {
	echo "Home [Cash]";
}elseif($pay->pay_method == 2) {
	echo "Home [Remittance]"; 
}elseif($pay->pay_method == 3) {
	echo "Home [Credit Card]";
}else{
	echo "Grameen [Cash]";
}
?>
<br><br>
Type of Payment: 
<?
if($pay->method == 1) {
	echo "<i>One-time payment</i>";
}else {
	echo "<i>Installment</i> | ";
		if($pay->paid == 1){
			echo "Quarter 1: (HTML/CSS Chapter 1-8)";
		}elseif($pay->paid == 11){
			echo "Quarter 2: (HTML/CSS Chapter 9-16)";
		}elseif($pay->paid == 111){
			echo "Quarter 3: (HTML/CSS Chapter 17-24)";
		}elseif($pay->paid == 1111){
			echo "Quarter 4: (JavaScript Chapter 1-8)";
		}
	}
?>
<br><br>
<? 
if($pay->method == 2) {
	echo "Reference Number: #".$pay->ref_no."<br><br>";
}
?>
▼My Page<br><br>
Log-in:  <?= Config::get("statics.url"); ?>/students/<br>
<?= View::forge("email/footer"); ?>