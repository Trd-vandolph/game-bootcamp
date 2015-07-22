<br>
We confirmed that we receive your payment through 
<? 
if($pay->pay_method == 1) {
	echo "Cash ";
}elseif($pay->pay_method == 2) {
	echo "Remittance "; 
}elseif($pay->pay_method == 3) {
	echo "Credit Card ";
}else{
	echo "Cash ";
}
?> 
for 
<? if($pay->method == 1) {
	echo "<i>the whole coverage</i>";
}else {
	if($pay->paid == 1){
		echo "Quarter 1: (HTML/CSS Chapter 1-8) ";
	}elseif($pay->paid == 11){
		echo "Quarter 2: (HTML/CSS Chapter 9-16) ";
	}elseif($pay->paid == 111){
		echo "Quarter 3: (HTML/CSS Chapter 17-24) ";
	}elseif($pay->paid == 1111){
		echo "Quarter 4: (JavaScript Chapter 1-8) ";
	}
}
?> 
and because of this, you can now book a lesson on our website. 
<br><br>
Thank you very much.
<br><br>
▼My Page<br><br>
Log-in:  <?= Config::get("statics.url"); ?>/students/<br>
<?= View::forge("email/footer"); ?>