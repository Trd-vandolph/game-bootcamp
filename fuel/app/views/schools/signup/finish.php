<?
	$documents = Model_Document::query()->where('type', 1)->where('deleted_at', 0)->limit(1)->get_one();
	if(count($documents) > 0) {
		$query = Model_Document::find($documents->id);
		$doc = "/contents/".$query->path;
	}else {
		$doc = NULL;
	}
?>
<div id="login">
	<div class="content-wrap_s">
		<p class="notice-text">Thank you. You have successfully signed up as a user.</p>
		<p class="button-area">
			<? echo Html::anchor("/students/", 'Top <i class="fa fa-chevron-right"></i>', ["class" => "button"]); ?>
		</p>
	</div>
</div>
<div id="dialogoverlay"></div>
<div id="dialogbox">
	<div>
		<div id="dialogboxhead"></div>
		<div id="dialogboxbody"></div>
		<div id="dialogboxfoot"></div>
	</div>
</div>
<script>

$(function(){
	Alert.render("Read Course Information to take a free trial lesson. Once you click OK, you will be redirected to Course Information.");
})
//custom alert

function CustomAlert(){
	this.render = function(dialog,id){
		var winW = window.innerWidth;
		var winH = window.innerHeight;
		var dialogoverlay = document.getElementById('dialogoverlay');
		var dialogbox = document.getElementById('dialogbox');
		dialogoverlay.style.display = "block";
		dialogoverlay.style.height = winH+"px";
		dialogbox.style.left = (winW/2) - (550 * .5)+"px";
		dialogbox.style.top = "100px";
		dialogbox.style.display = "block";
		document.getElementById('dialogboxhead').innerHTML = "<strong>Message</strong>";
		document.getElementById('dialogboxbody').innerHTML = dialog;
		document.getElementById('dialogboxfoot').innerHTML = '<button onclick="Alert.ok()">OK</button>';
	}
	this.ok = function(){
		document.getElementById('dialogbox').style.display = "none";
		document.getElementById('dialogoverlay').style.display = "none";
		window.open('<?=$doc; ?>', '_blank');
	}
}
var Alert = new CustomAlert();
//end alert
</script>
