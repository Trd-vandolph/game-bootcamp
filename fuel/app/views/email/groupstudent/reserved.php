Dear  <?= $name; ?>,<br>
<br>
Your lesson has been booked.<br>
<br>
Tutor: <?= $reservation->teacher->firstname; ?> <?= $reservation->teacher->middlename; ?> <?= $reservation->teacher->lastname; ?><br>
<br>
Course: <?php echo Model_Lessontime::getCourse($reservation->language); ?><br>
<br>
Number: <?php echo $reservation->number; ?><br>
<br>
Date:  <? echo date("d M Y", $reservation->freetime_at); ?><br>
<br>
Time:  <? echo date("A h:i", $reservation->freetime_at); ?><br>
<br>
▼Please see "My page".<br>
<br>
Log-in:  <?= Config::get("statics.url"); ?>/students/<br>
<?= View::forge("email/footer"); ?>