<select name="zone" required="" onchange="changeZone()" id="zone">
	<? $i = 0; foreach(Config::get("timezone.zone") as $zone): ?>
		<option value="<?= $i++; ?>"><?= $zone; ?></option>
	<? endforeach; ?>
</select>
<select name="timezone" required="" id="timezone">
</select>
<script>
	var zone = [];
	<? $i = 0; foreach(Config::get("timezone.zone") as $zone): ?>
	zone[<?= $i++; ?>] = ["<?= implode('","' ,array_keys(Config::get("timezone.{$zone}"))); ?>"];
	<? endforeach; ?>

	function changeZone(){
		var list = $("#timezone");
		list.empty();
		for(var i = 0; i < zone[$("#zone").val()].length; i++){
			list.append('<option>' + zone[$("#zone").val()][i] + '</option>');
		}
	}

	function changeTimeZone(timezone){
		for(var i = 0; i < zone.length; i++){
			var index = zone[i].indexOf(timezone);
			if(index != -1){
				$("#zone").val(i);
				changeZone();
				$("#timezone").val(zone[i][index]);
			}
		}
	}
	<? if($user == ""): ?>
	changeTimeZone("Bangladesh");
	<? else: ?>
	changeTimeZone("<?= Session::get_flash("timezone", $user->timezone) ?>");
	<? endif; ?>
</script>