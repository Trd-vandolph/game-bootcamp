Dear  <?= $name; ?>,<br>

<? if($user->place == 0){?>
	<br>
	Hello and welcome to OliveCode!<br><br>
	Your registration has been completed.<br><br>
	Please find attached Course Information that shows you how to take a free trial lesson.<br><br>
	If you like to start the course, send your message to support@olivecode.com.<br>
	We will come back to you as soon as possible. <br>
<? }else{ ?>
	<br>
	Hello and welcome to OliveCode!<br><br>
	Your registration has been completed.<br><br>
	Please find attached Course Information for further details of learning at Grameen Communications.<br><br>
	Course Information shows you how to take a free trial lesson. <br><br>
	If you like to start the course, send your message to support@olivecode.com.<br>
	We will come back to you as soon as possible. <br>
<? } ?>
<br>
▼Your registration<br><br>
First name: <?= $user->firstname; ?><br>
<br>
Middle name:  <?= $user->middlename; ?><br>
<br>
Last name:  <?= $user->lastname; ?><br>
<br>
Email address: <?= $user->email; ?><br>
<br>
Password:  password you have set<br><br>
Gender: <? if($user->sex == 1){echo "Female";}else{echo "Male";}?><br>
<br>
Birthday: <?= Config::get("statics.months", [])[$ymd[1]-1]; ?> <?= $ymd[2]; ?>, <?= $ymd[0]; ?><br>
<br>
Gmail address: <?= $user->google_account; ?><br>
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
Log-in:  <?= Config::get("statics.url"); ?>/students/<br>
<?= View::forge("email/footer"); ?>