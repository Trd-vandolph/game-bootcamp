Dear  <?= $name; ?>,<br>
<br>
Student has cancelled your lesson.<br>
<br>
Student: <?= $reservation->student->firstname; ?> <?= $reservation->student->middlename; ?> <?= $reservation->student->lastname; ?><br>
<br>
Date:  <? echo date("d M Y", $reservation->freetime_at); ?><br>
<br>
Time:  <? echo date("A h:i", $reservation->freetime_at); ?><br>
<br>
▼Please see "My page".<br>
<br>
Log-in:  <?= Config::get("statics.url"); ?>/teachers/<br>
<?= View::forge("email/footer"); ?>