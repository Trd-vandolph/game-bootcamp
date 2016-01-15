Dear  <?= $name; ?>,<br>
<br>
Your lesson has been cancelled.<br>
<br>
Tutor: <?= $reservation->teacher->firstname; ?> <?= $reservation->teacher->middlename; ?> <?= $reservation->teacher->lastname; ?><br>
<br>
Date:  <? echo date("d M Y", $reservation->freetime_at); ?><br>
<br>
Time:  <? echo date("A h:i", $reservation->freetime_at); ?><br>
<br>
▼Please see "My page".<br>
<br>
Log-in:  <?= Config::get("statics.url"); ?>/students/<br>
<?= View::forge("email/footer"); ?>