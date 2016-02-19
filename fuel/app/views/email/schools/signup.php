Dear  <?= $name; ?>,<br>

<? if($user->place == 0){?>
	<br>
	Hello and welcome to Game-BootCamp!<br><br>
	Your registration has been completed.<br><br>
	Please find attached Course Information that shows you how to take a free trial lesson.<br><br>
<? }else{ ?>
	<br>
	Hello and welcome to Game-BootCamp!<br><br>
	Your registration has been completed.<br><br>
	Please find attached Course Information for further details of learning at Grameen Communications.<br><br>
	Course Information shows you how to take a free trial lesson. <br><br>
<? } ?>
<br>
▼Your registration<br><br>
Email address: <?= $user->email; ?><br>
<br>
Password:  password you have set<br><br>
Gender: <? if($user->sex == 1){echo "Female";}else{echo "Male";}?><br>
<br>
Booking email: <? if($user->need_reservation_email == 1){echo "On";}else{echo "Off";}?><br>
<br>
News email: <? if($user->need_news_email == 1){echo "On";}else{echo "Off";}?><br>
<br>
Timezone: <?= $user->timezone; ?><br>
<br>
<br>
▼Please see "My page".<br>
<br>
Log-in:  <?= Config::get("statics.url"); ?>/schools/<br>
<?= View::forge("email/footer"); ?>
