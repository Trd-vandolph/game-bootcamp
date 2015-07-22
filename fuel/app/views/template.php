<!doctype html>
<html>
<head>
	<meta charset="UTF-8">

  <meta name="keywords" content="OliveCode,Online Computer Programming Course,Job Guaranteed,WordPress,HTML,CSS,Programming,Git,JavaScript,Bangladesh,Private Lesson,Edoo" />
  <meta name="description" content="OliveCode is the job guaranteed online computer programming course for Bangladeshi. It is a private lesson in English for 4 months, followed by 2-month internship at an IT company." />

	<link rel="shortcut icon" href="/assets/img/common/favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">

	<meta property="og:title" content="Olive code | Job Guaranteed Online Computer Programming Course for Bangladeshi">
	<meta property="og:description" content="OliveCode is the job guaranteed online computer programming course for Bangladeshi. It is a private lesson in English for 4 months, followed by 2-month internship at an IT company.">
	<meta property="og:url" content="http://www.olivecode.com/">
	<meta property="og:image" content="http://www.olivecode.com/assets/img/front/logo_front.png?1423213936">
	<meta property="og:site_name" content="OliveCode">

	<? echo Asset::css("front.css"); ?>
	<? echo Asset::css("blueberry.css"); ?>
	<? echo Asset::css("font-awesome.min.css"); ?>
	<? echo Asset::css("jquery.remodal.css"); ?>
	<!--[if IE]><script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->


	<link href='https://fonts.googleapis.com/css?family=Raleway:400,700,600,500,800,900,300,100,200' rel='stylesheet' type='text/css'>

	<title>Olive code | Job Guaranteed Online Computer Programming Course for Bangladeshi</title>
</head>
<body class='front-<? if($title == "Top"){ echo "index"; }else{ echo "lower"; }?>'>
<header>
	<nav>
		<? if($title != "Top"): ?>
			<h1><a href="/"><img src="/assets/img/front/logo_front_lower.png" alt="OliveCode"></a></h1>
		<? endif; ?>
		<div class="toggle"><i class="fa fa-bars"></i></div>
		<ul class="groval-menu">
			<li><a href="/about">About</a></li>
			<li><a href="/course">Course</a></li>
			<li><a href="/tutors">Tutors</a></li>
			<?php /* <li><a href="/voice">Voice of Students</a></li> */ ?>
			<li><a href="/flow">Course Flow</a></li>
			<li><a href="/grameen">Grameen</a></li>
			<li><a href="/coursefee">Course Fee</a></li>
			<li><a href="/join">How to Join</a></li>
			<li><a href="/faq">FAQ</a></li>
		</ul>
		<?php if($title != "Top"){ ?>
		<ul class="member-menu">
			<?php if(Auth::check()):?>
			<li class="signup"><a href="/students">MY PAGE</a></li>
			<li class="login"><a style="padding: 5px 26px;" href="/students/?logout=1">LOGOUT</a></li>
			<?php else: ?>
			<li class="signup"><a data-remodal-target="choose" href="#">SIGN UP</a></li>
			<li class="login"><a style="padding: 5px 32px !important" href="/students/signin">LOGIN</a></li>
			<?php endif; ?>
		</ul>
		<? }else{ ?>
		<ul class="member-menu">
			<?php if(Auth::check()):?>
			<li class="signup"><a href="/students">MY PAGE</a></li>
			<li class="login"><a href="/students/?logout=1">LOGOUT</a></li>
			<?php else: ?>
			<li class="signup"><a data-remodal-target="choose" href="#">SIGN UP</a></li>
			<li class="login"><a href="/students/signin">LOGIN</a></li>
			<?php endif; ?>
		</ul>
		<? } ?>
	</nav>
	<?php
		$hash = Input::get(md5('id'));
		$str = 'qw45e';
		$query = DB::query("UPDATE `users` SET `need_news_email` = 0 WHERE `id` = '$hash . $str'")->execute();
		if ($query): ?>
			<p  class="unsubscribe">
			You have been successfully unsubscribed from OliveCode mails,<br>
			If this was just an error, you may re-subscribe by logging-in to your account<br>
			and go to <b>settings > news email</b> and set it to ON.
			</p>
		<? endif;
	?>
	<? if($title == "Top"): ?>
		<h1><a href="/"><?php echo Asset::img('front/logo_front.png', array('alt'=>'OliveCode')); ?></a></h1>
	<? else: ?>
		<h2><?= $title; ?></h2>
		<aside><?= $sub; ?></aside>
	<? endif; ?>
</header>
<? if($title == "Course" || $title == "Tutors" || $title == "Course Flow" || $title == "Top"): ?>
<div style="padding: 10px 10px;">
	<a href="/grameen"><div style="margin-top:100px; width:100%;height: 120px;position: absolute; left: 0;"></div></a>
	<div id="banner" style="margin: 100px auto 40px auto; max-width: 720px;width: 100%; border-radius: 20px; border-style: solid; overflow: hidden; border-color: #7aae2a;">
		<img id="oc_banner" src="/assets/img/front/oc_banner.gif" style="max-width: 100%; height: auto;">
	</div>
</div>
<? endif; ?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

	$(function(){
		frame = $('iframe');
		banner = $('#banner');
		frame.css({
			'-webkit-border-radius':'20px',
			'-moz-border-radius':'20px',
			'borderRadius':'20px'
		});
		banner.css({
			'-webkit-border-radius':'20px',
			'-moz-border-radius':'20px',
			'borderRadius':'20px'
		});
	});
</script>
<? echo $content; ?>
<?php if(!Auth::check()):?>
<section id="signup-button">
	<p class="catch">Free Trial Lesson</p>
	<p>Take a free trial lesson by signing up as free student.<br>Programming beginners are welcome.<br>Experience and enjoy a private lesson of OliveCode.</p>
	<a class="button" data-remodal-target="choose" href="#">Take a Free Trial Lesson</a>
</section>
<?php endif; ?>
<div class="remodal" data-remodal-id="choose">
	<div class="modal-event">
		<section id="wrap" class="content-wrap" style="text-align: center;">
			<div id="choose-remodal-header"><h3>Which course would you like to sign up for?</h3></div>
			<div id="choose-remodal-button"><a href="/students/signup">Home Course</a><a href="/students/signup/?g=1">Grameen Course</a></div>
		</section>
	</div>
</div>
<footer>
	<? if($title == "Top"): ?>
	<div class="fb-like-page">
		<div>
			<a href="http://www.facebook.com/olivecode" target="_blank"><img src="/assets/img/front/facebook-label.jpg" alt="facebook-label"></a>
			<div class="fb-page" data-href="https://www.facebook.com/olivecode" data-width="500" data-hide-cover="false" data-show-facepile="false" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/olivecode"><a href="https://www.facebook.com/olivecode">OliveCode</a></blockquote></div></div>
		</div>
	</div>
	<? endif; ?>
	<nav>
		<ul>
			<?php if(Auth::check()):?>
			<li><a href="/students/contactforum">Contact Us</a></li>
			<?php else: ?>
			<li><a href="/contact">Contact Us</a></li>
			<?php endif; ?>
			<li><a href="/privacy">Privacy Policy</a></li>
			<li><a href="/terms">Agreement</a></li>
			<li><a href="http://www.edoo.co.jp/" class="blank">Operating Company</a></li>
		</ul>
	</nav>
	<p class="copyright">© 2015 Edoo Inc. All rights reserved.</p>
</footer>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<?php echo Asset::js('base.js'); ?>
<?php echo Asset::js('jquery.blueberry.js'); ?>
<?php echo Asset::js('jquery-contained-sticky-scroll.js'); ?>
<?php echo Asset::js("jquery.remodal.js"); ?>
<script type="text/javascript">
$(window).on('load resize', function(){
	$('#features ul').tiles(4,'h3'); //.tilesの中のdiv
	$('#features ul').tiles(4,'div'); //.tilesの中のdiv
	$('#features ul').tiles(4,'aside'); //.tilesの中のdiv

	$('#contents.flow ol').tiles(4,'h3'); //.tilesの中のdiv
	$('#contents.flow ol').tiles(4,'div'); //.tilesの中のdiv
});

$(function(){
	var baseURL = window.location.protocol + "//" + window.location.host + "/";
	var currentURL = window.location.href;
	var chooseCourse = $('#choose-course');
	var close = $('.remodal-close');

	close.removeAttr('href');

	chooseCourse.click(function(){
		Confirm.render("Which course would you like to sign-up?");
	});
	
	if(baseURL != currentURL) {
		$('.member-menu > li').css({
			'display' : 'block',
			'textAlign' : 'left',
		});

		$('.member-menu > li:nth-child(2)').css('marginTop', '-35px');
	}
	
	
	$(".toggle").click(function(){
		$(".groval-menu").slideToggle();
		return false;
	});
	$(window).resize(function(){
		var win = $(window).width();
		var p = 1080;
		if(win > p){
			$(".groval-menu").show();
		} else {
			$(".groval-menu").hide();
		}
	});

	$('#formButton').click(function(){
		var val = $("#email").val();

		if (val == "" || val == "Your E-mail address" ){
			var inst = $.remodal.lookup[$('[data-remodal-id=required_dialog]').data('remodal')];
			inst.open();
		}
		else{
			$.ajax({
				type: 'post',
				url: 'api/setemail.php',
				data: {
					'email': val
				},
				success: function(data){
					var inst = $.remodal.lookup[$('[data-remodal-id=confirm]').data('remodal')];
					inst.open();
				}
			});
		}
	});

	$(window).load(function() {
		$('.blueberry').blueberry({
			pager :false,
			interval :8000,
			duration :1000
		});
	});
	jQuery(document).ready(function(){
		jQuery('#contents.faq .side ul').containedStickyScroll({
			closeChar: ''
		});
	});

	//unsubscribe
	$('.unsubscribe').css({
		'text-align' : 'center',
		'padding' : '10px 0'
	});
});

//fb-like-page
(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	
</script>
</body>
</html>

