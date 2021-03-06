<!doctype html>
<html lang="en-US" prefix="og: //ogp.me/ns#">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
	<meta name="keywords" content="Game-bootcamp, Online Computer Programming Course, Kids Programming, enchantJS, Online School, Javascript kids , Programming,JavaScript, Japan, Singapore, Private Lesson, Edoo, Olivecode" />
	<meta name="description" content="Game Bootcamp is a 3-month online programming course for 8 to 15-year-old children." />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Game Bootcamp" />
	<meta property="og:description" content="GET YOUR KIDS THE MOST POWERFUL SKILL IN 21ST CENTURY" />
	<meta property="og:url" content="//www.game-bootcamp.com/">
	<meta property="og:site_name" content="Game BootCamp" />
	<meta property="og:image" content="//game-bootcamp.com/assets/img/logo/logo2_b.png">
	<link rel="shortcut icon" href="/assets/img/common/favicon.ico">

	<? echo Asset::css("template.css"); ?>
	<? echo Asset::js("reum.js"); ?>
	<? echo Asset::css("js_composer_front1ac1.css"); ?>
	<link rel='stylesheet' id='options_typography_Open+Sans-300-css' href='//fonts.googleapis.com/css?family=Open+Sans:300' type='text/css' media='all' />
	<? echo Asset::css("rgs11b8.css"); ?>
	<? echo Asset::css("font-awesome.minf39e.css"); ?>
	<? echo Asset::css("steadysetsf39e.css"); ?>
	<? echo Asset::css("lineconf39e.css"); ?>
	<? echo Asset::css("style11b8.css"); ?>
	<? echo Asset::css("responsive11b80.css"); ?>
	<? echo Asset::js("modernizr61da.js"); ?>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
	<script src="//code.jquery.com/jquery-2.0.3.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<? echo Asset::js("top.jquery.js"); ?>
	<? echo Asset::js("bootstrap-editable.js"); ?>
	<? echo Asset::js("bootstrap-editable.min.js"); ?>
	<title> Game-BootCamp </title>

	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-66637497-2', 'auto');
		ga('send', 'pageview');
	</script>
</head>

<body class="home page page-id-3227 page-template-default wpb-js-composer js-comp-ver-3.7.3 vc_responsive" data-responsive="1">
	<div id="header-space"></div>
	<div id="header-outer" data-transparent-header="false" class="transparent" data-full-width="false" data-using-secondary="0" data-using-logo="1" data-logo-height="82" data-header-resize="1">
		<div id="search-outer" class="nectar">
			<div id="search">
				<div class="container">
					<div id="search-box">
						<div class="col span_12">
							<form action="//bootcamp.csp.edu/" method="GET">
								<input type="text" name="s" value="Start Typing..." data-placeholder="Start Typing..." />
							</form>
						</div>
					</div>
					<div id="close"><a href="#"><span class="icon-salient-x" aria-hidden="true"></span></a></div>
				</div>
			</div>
		</div>
		<header id="top">
			<div class="container">
				<div class="row">
					<? if(Auth::check()): ?>
						<ul class="member-menu">
							<li class="signup"><a href="/students" class="editable">My Page</a></li>
							<li class="login"><a href="/students/?logout=1" class="editable">Log Out</a></li>
						</ul>
					<? else: ?>
						<ul class="member-menu">
							<li class="signup"><a href="/students/signup" class="editable"><? echo Session::get('memSettings1'); ?></a></li>
							<li class="login"><a href="/students/signin" class="editable"><? echo Session::get('memSettings2'); ?></a></li>
						</ul>
					<? endif; ?>
					<div class="col span_3">
						<a id="logo" href="/">
							<img class="" alt="CSP Bootcamp" src="assets/img/logo/logo2_c.png" />
							<img class="starting-logo " alt="CSP Bootcamp" src="assets/img/logo/logo2-trans.png" />
							<img class="starting-logo dark-version " alt="CSP Bootcamp" src="assets/img/logo/logo2_b.png" />
						</a>
					</div>
					<div class="col span_9 col_last">
						<a href="#mobilemenu" id="toggle-nav"><i class="icon-reorder"></i></a>
						<nav>
							<ul class="sf-menu">
								<li><a href="/"><? echo Session::get('menu1'); ?></a>
								</li>
								<li><a href="/parents"><? echo Session::get('menu2'); ?></a>
								</li>
								<li><a href="course"><? echo Session::get('menu4'); ?></a>
								</li>
								<li><a href="/tutor"><? echo Session::get('menu5'); ?></a>
								</li>
								<li><a href="/operatingcompany"><? echo Session::get('menu6'); ?></a>
								</li>
								<li><a href="/coursefee"><? echo Session::get('menu7'); ?></a>
								</li>
								<li><a href="/howtojoin"><? echo Session::get('menu8'); ?></a>
								</li>
								<li><a href="/faq"><? echo Session::get('menu9'); ?></a>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</header>
		<div class="ns-loading-cover"></div>
	</div>
	<div id="mobile-menu">
		<div class="container">
			<ul>
				<li><a href="/"><? echo Session::get('menu1'); ?></a>
				</li>
				<li><a href="/parents"><? echo Session::get('menu2'); ?></a>
				</li>
				<li><a href="/course"><? echo Session::get('menu4'); ?></a>
				</li>
				<li><a href="/tutor"><? echo Session::get('menu5'); ?></a>
				</li>
				<li><a href="/operatingcompany"><? echo Session::get('menu6'); ?></a>
				</li>
				<li><a href="/coursefee"><? echo Session::get('menu7'); ?></a>
				</li>
				<li><a href="/howtojoin"><? echo Session::get('menu8'); ?></a>
				</li>
				<li><a href="/faq"><? echo Session::get('menu9'); ?></a>
				</li>
			</ul>
		</div>
	</div>
	<? echo $content ?>
	<div id="fws_55b227467453e" class="wpb_row vc_row-fluid full-width-section standard_section	" style="padding: 80px 102px 80px; margin-left: -102px; visibility: visible; background-color: #E60039!important;">
		<div class="col span_12 light">
			<a class="nectar-button large see-through" href="/students/signup" data-color-override="false">
				<span>Take a Free Trial Lesson</span><br><br>
				<span align="center" class="signup-text">
					By signing up as free student, you can have your lesson.<br>
					Programming beginners are welcome.<br>
					Experience and enjoy a private lesson of Game-Bootcamp.
				</span>
				<span class="signup-button">Sign Up</span>
			</a>
		</div>
	</div>
	<div id="footer-outer">
		<nav>
			<ul>
				<li><a href="/students/contactforum">Contact Us</a></li>
				<li><a href="/privacy">Privacy Policy</a></li>
				<li><a href="/terms">Terms of Use</a></li>
			</ul>
		</nav>
		<p class="copyright">© 2015 Edoo Inc. All rights reserved.</p>
	</div>
	<a id="to-top"><i class="icon-angle-up"></i></a>
	<? echo Asset::js( "top.jquery.js"); ?>
	<? echo Asset::js( "superfishb493.js"); ?>
	<? echo Asset::js( "nicescrolle248.js"); ?>
	<? echo Asset::js( "sticky5152.js"); ?>
	<? echo Asset::js( "prettyPhoto11b8.js"); ?>
	<? echo Asset::js( "appear5152.js"); ?>
	<? echo Asset::js( "init11b8.js"); ?>
	<? echo Asset::js( "nectar-love5152.js"); ?>

	<script>
		var baseURL = window.location.origin + "/";
		var currentURL = window.location.href;

		var toggleNav = document.getElementById("toggle-nav");
		var space = document.getElementById("header-space");
		var count = 0;


		toggleNav.addEventListener("click", function() {
			space.style.display = "block";
			count++;
		})

		window.addEventListener('resize', function() {
		})

		if (baseURL == currentURL) {
			$('#header-space').css('display', 'none');
			window.onscroll = function (e) {
				$('#header-outer, div#search-outer').attr('style', 'background-color: #014099 !important');
			}

			var $win = $(window);
			$win.scroll(function () {
				if ($win.scrollTop() == 0) {
					//alert('Scrolled to Page Top');
					$('#header-outer, div#search-outer').attr('style', 'background-color: rgba(1, 64, 153, 0.1) !important');
				} else if ($win.height() + $win.scrollTop()
					== $(document).height()) {
					//alert('Scrolled to Page Bottom');
				}
			});
		} else {
			$('#header-outer, div#search-outer').attr('style', 'background-color: #014099 !important');
		}


/*
		var a = $( window ).width();

		if(a < 1045 ) {
			$('#mobile-menu').appendTo('#header-outer');
		}
*/


		$(function() {
			function resizeSpace() {
				if(baseURL == currentURL) {
					var headerSpace = $('#header-space');
					var headerOuter = $('#header-outer').height();

					headerSpace.css('height', headerOuter);
				}else {
					var otherpage = $('#fws_55b227467453e');
					otherpage.css('padding','80px 2px!important');
				}
			}

			var memLink1 = '<?php if(Auth::check()){echo "/students"; }else{echo "/students/signup";}?>';
			var memLink2 = '<?php if(Auth::check()){echo "/students/?logout=1"; }else{echo "/students/signin";}?>';

			var memText1 = '<?php if(Auth::check()){echo "My Page"; }else{echo "Sign Up";}?>';
			var memText2 = '<?php if(Auth::check()){echo "Log Out"; }else{echo "Log In";}?>';

			var mem1 = "<li class='menu-item menu-item-type-post_type menu-item-object-page menu-item-2721'><a href="+ memLink1 +" id='mem1' class='mem'>"+ memText1 +"</a></li>";
			var mem2 = "<li class='menu-item menu-item-type-post_type menu-item-object-page menu-item-2721'><a href="+ memLink2 +" id='mem2' class='mem'>"+ memText2 +"</a></li>";

			addMemSettings();
			removeDuplicate();
			resizeSpace();

			function removeDuplicate() {
				var seen = {};
				$('a.mem').each(function() {
				var txt = $(this).text();
				if (seen[txt])
					$(this).remove();
				else
					seen[txt] = true;
				});
			}

			function addMemSettings() {
				if ( $(window).width() < 691) {
					var ul = $("#mobile-menu > div > ul");
					ul.append(mem1);
					ul.append(mem2);
				}else {
					$( "#mem1" ).detach();
					$( "#mem2" ).detach();
				}
			}
			$(window).resize(function () {
				addMemSettings();
				removeDuplicate();
				resizeSpace();
			});
		});
	</script>
</body>

</html>
