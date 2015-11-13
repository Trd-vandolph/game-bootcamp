Dear  <?= $name; ?>,<br>
<br>
Hello and welcome to Game-bootcamp!<br>
Your registration has been completed.<br>
<br>
▼Your registration<br>
First name: <?= $user->firstname; ?><br>
<br>
Middle name:  <?= $user->middlename; ?><br>
<br>
Last name:  <?= $user->lastname; ?><br>
<br>
Email address: <?= $user->email; ?><br>
<br>
Password:  password you have set<br>
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
PR: <?= $user->pr; ?><br>
<br>
Educational background: <?= $user->educational_background; ?><br>
<br>
<br>
▼Please see "My page".<br>
<br>
Log-in:  <?= Config::get("statics.url"); ?>/teachers/<br>
<?= View::forge("email/footer"); ?>
