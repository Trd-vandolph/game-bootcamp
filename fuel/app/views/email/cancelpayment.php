<br>
We're very sorry that you're payment was been denied due to the reason: 
<?
	echo "<strong>".$cancel->reason."</strong>. ";
?> 
We ask you to contact our email support so we could talk with this matter. 
<br><br>
Thank you very much.
<br><br>
▼My Page<br><br>
Log-in:  <?= Config::get("statics.url"); ?>/students/<br>
<?= View::forge("email/footer"); ?>