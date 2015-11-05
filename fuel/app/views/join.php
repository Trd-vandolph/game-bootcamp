<?
	$documents = Model_Document::query()->where('type', 1)->where('deleted_at', 0)->limit(1)->get_one();
	$query1 = Model_Document::find($documents->id);
	$documents = Model_Document::query()->where('type', 2)->where('deleted_at', 0)->limit(1)->get_one();
	$query2 = Model_Document::find($documents->id);
	$doc1 = "/contents/".$query1->path;
	$doc2 = "/contents/".$query2->path;
	$open = Input::get('open', NULL);
	if(!Auth::check()) {
		if($open != 0) {?>
			<input type="text" value="<? if($open==1){echo "1"; }elseif($open==2){echo "2";} ?>" id="openDoc" hidden/>
	<?	}
	}else {
		if(isset($student)){
			$place = $student->place
			?>
			<input type="text" value="<? if($place==0){echo "1"; }elseif($place==1){echo "2";} ?>" id="docOpen" hidden/>
	<?	}
	}
?>

<section id="contents" class="join">
	<p class="sub-catch">Take the following steps to join the course.</p>
	<div class="sub-catch howjoin">
		<ol class="intruct">
			<li><h3>Choose Course</h3><p>Choose "Home Course" or "<a class="open" href="/grameen">Grameen Course</a>"</p></li>
			<li><h3>Sign Up</h3><p>Go to "SIGNUP" and register your profile to <a class="open"  href="/students/signup">Home Course</a> or <a class="open" href="/students/signup/?g=1">Grameen Course</a></p></li>
			<li><h3>Read Course Information</h3><p>After registering your profile on "SIGNUP", you will see a message that you can get "Course Information". Download and read it to know how to book a lesson.<br>You can also get "Course Information" through this <a class="open doc">link</a> after you log-in</p></li>
			<li><h3>Take Trial Lesson</h3><p>Before you decide to start the course, take a free trial lesson with one of our <a class="open" href="/tutors">tutors.</a></p></li>
			<li><h3>Pay Course Fee</h3><p>If you want to start the course, pay <a class="open" href="/coursefee">course fee.</a></p></li>
			<li><h3>Book First Lesson</h3><p>Once we confirm your payment, you can book the first lesson; Chapter 1/ HTML&CSS.</p></li>
		</ol>
	</div>
</section>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div id="dialogoverlay"></div>
<div id="dialogbox">
	<div>
		<div id="dialogboxhead"></div>
		<div id="dialogboxbody"></div>
		<div id="dialogboxfoot"></div>
	</div>
</div>
<script>
	//custom confirm
	function CustomConfirm(){
		this.render = function(dialog, id){
			var winW = window.innerWidth;
			var winH = window.innerHeight;
			var dialogoverlay = document.getElementById('dialogoverlay');
			var dialogbox = document.getElementById('dialogbox');
			var baseURL = window.location.protocol + "//" + window.location.host + "/";
			if(id == 1) {
				var button = '<button onclick="Confirm.login()">Log-in</button> <button id="close" onclick="Confirm.close()">Close</button>';
			}else{
				var button = '<button onclick="Confirm.docu()">Yes</button><button id="close" onclick="Confirm.close()">Close</button></div>';
			}
			dialogoverlay.style.display = "block";
			dialogoverlay.style.height = winH+"px";
			dialogbox.style.left = (winW/2) - (550 * .5)+"px";
			dialogbox.style.top = "100px";
			dialogbox.style.display = "block";
			document.getElementById('dialogboxhead').innerHTML = "<strong>Confirm your action</strong>";
			document.getElementById('dialogboxbody').innerHTML = dialog;
			document.getElementById('dialogboxfoot').innerHTML = button;
		}
		this.login = function(){
			window.open("/students/signin/?d=1", "_self");
			document.getElementById('dialogbox').style.display = "none";
			document.getElementById('dialogoverlay').style.display = "none";
		}
		this.docu = function(){
			var val = 	document.getElementById('docOpen').value;
			if (val == 1) {
				window.open("<?=$doc1 ?>", "_blank");
			}else if(val == 2) {
				window.open("<?=$doc2 ?>", "_blank");
			}
			document.getElementById('dialogbox').style.display = "none";
			document.getElementById('dialogoverlay').style.display = "none";
		}
		this.close = function(){
			document.getElementById('dialogbox').style.display = "none";
			document.getElementById('dialogoverlay').style.display = "none";
		}
	}
	var Confirm = new CustomConfirm();
	//end confirm
		$(function(){
		var open = $('.open');
		var doc = $('.doc');
		var openDoc = $('#openDoc');
		var docOpen = $('#docOpen');
 		if(openDoc.val() == 1) {
			window.open("<?=$doc1 ?>", "_blank");
		}else if (openDoc.val() == 2) {
			window.open("<?=$doc2 ?>", "_blank");
		}
		doc.click(function(){
			<? if(!Auth::check()) {?>
				Confirm.render("You must log-in first to your account before continuing.", 1);
			<?}else {?>
				Confirm.render('Once you click "Yes", another tab will be open to view Course Information.', 2);
			<? }?>
		});
		open.css({
			'color' : 'rgb(192, 26, 26)',
			'fontWeight' : 'bold',
		});
		open.mouseover(function(){
			open.css('cursor', 'pointer');
		});
	});
</script>
