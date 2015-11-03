<?php echo Asset::css("jquery.remodal.css"); ?>
<?php echo Asset::js("jquery.remodal.js"); ?>
<div id="ajax-loading-screen"><span class="loading-icon "> <span class="default-skin-loading-icon"></span> </span>
</div>
<div class="col span_12 light left">
		<div class="vc_span2 wpb_column column_container col no-extra-padding" data-hover-bg="" data-animation="" data-delay="0">
			<div class="wpb_wrapper">

			</div>
		</div>

		<div class="vc_span8 wpb_column column_container col no-extra-padding" data-hover-bg="" data-animation="" data-delay="0">
			<div class="wpb_wrapper">

				<div class="wpb_text_column wpb_content_element ">
					<div class="wpb_wrapper">
						<h1 style="text-transform: uppercase; text-shadow: rgba(0, 0, 0, 0.4) 1px 1px 3px; text-align: center;" class="editable"><? echo Session::get('header'); ?></h1>
						<p style="text-align: center;"><a class="nectar-button large accent-color has-icon regular-button" href="/parents" data-color-override="false" data-hover-color-override="false" data-hover-text-color-override="#fff"><span><? echo Session::get('headButton'); ?></span> <i class="icon-button-arrow"></i></a></p>

					</div>
				</div>
			</div>
		</div>

		<div class="vc_span2 wpb_column column_container col no-extra-padding" data-hover-bg="" data-animation="" data-delay="0">
			<div class="wpb_wrapper">

			</div>
		</div>
</div>
<div id="slideshow">
	<div class="slideshow slideshow-1"></div>
	<div class="slideshow slideshow-2"></div>
	<div class="slideshow slideshow-3"></div>
	<div class="slideshow slideshow-4"></div>
	<div class="slideshow slideshow-5"></div>
	<div class="slideshow slideshow-6"></div>
	<div class="slideshow slideshow-7"></div>
</div>
<div id="ajax-content-wrap">
	<div class="container-wrap">
		<div class="container main-content">
			<div class="row">


				<div id="top-about-content">
					<div>
						<ul>
							<li><? echo Session::get('aboutList1'); ?></li>
							<li><? echo Session::get('aboutList2'); ?></li>
							<li><? echo Session::get('aboutList3'); ?></li>
						</ul>
					</div>
				</div>
				<div id="fws_55b22746735ec" class="wpb_row vc_row-fluid full-width-section standard_section" style="padding: 80px 244px 100px; margin-left: -244px; visibility: visible; background-color: #E21348;">
				<h3 style="text-align: center;"><? echo Session::get('gameHeader'); ?></h3>
				<br>
			    <div class="col span_12 dark ">
			        <div class="col span_3 centered-text one-fourths clear-both" data-animation="" data-delay="0">
			            <div>
							<img src="../assets/img/front/game1.gif" alt="catch the banana">
							<a data-remodal-target="choose1" href="#"><p>Click to Play</p></a>
			            </div>
			            <h3>Catch the Banana</h3>
			            <a class="nectar-button medium accent-color" href="/course#1st-game" data-color-override="false"><span>View Game Info</span> </a>
			        </div>
			        <div class="col span_3 centered-text one-fourths right-edge" data-animation="" data-delay="0">
			            <div>
				            <img src="../assets/img/front/game2.gif" alt="snow fight">
				            <a data-remodal-target="choose2" href="#"><p>Click to Play</p></a>
			            </div>
			            <h3>Snow Fight</h3>
			            <a class="nectar-button medium accent-color" href="/course#2nd-game" data-color-override="false"><span>View Game Info</span> </a>
			        </div>
			        <div class="col span_3 centered-text one-fourths clear-both" data-animation="" data-delay="0">
			            <div>
				            <img src="../assets/img/front/game3.gif" alt="superbear">
				            <a data-remodal-target="choose3" href="#"><p>Click to Play</p></a>
			            </div>
			            <h3>Super Bear</h3>
			            <a class="nectar-button medium accent-color" href="/course#3rd-game" data-color-override="false"><span>View Game Info</span> </a>
			        </div>
			    </div>
				</div>
				</div>
				<div id="fws_55b08d66d8a64" class="wpb_row vc_row-fluid full-width-section parallax_section    " style="background-color: #ffffff; padding-top: 70px; padding-bottom: 60px; ">
					<div class="col span_12 dark left">
						<div class="vc_span4 wpb_column column_container col centered-text no-extra-padding has-animation" data-hover-bg="" data-animation="fade-in" data-delay="0">
							<div class="wpb_wrapper">
								<div id="fws_55b08d66d8ede" class="wpb_row vc_row-fluid standard_section    " style="padding-top: 0px; padding-bottom: 0px; ">
									<div class="col span_12  ">
										<div class="vc_span12 wpb_column column_container col no-extra-padding has-animation" data-hover-bg="" data-animation="fade-in" data-delay="600">
											<div class="wpb_wrapper">
												<div class="wpb_text_column wpb_content_element ">
													<div class="wpb_wrapper">
														<p><img style="height: 10em;" class="aligncenter size-full wp-image-3122 feature1-image" src="assets/img/feature1.png" alt="what-is-bootcamp" width="98" height="86" /></p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="wpb_text_column wpb_content_element ">
									<div class="wpb_wrapper">
										<h2><? echo Session::get('titleFeature1'); ?></h2>
										<p><? echo Session::get('bodyFeature1'); ?>
											<br />
											<a title="Program" href="/course" target="_blank">See More</a></p>
									</div>
								</div>
							</div>
						</div>
						<div class="vc_span4 wpb_column column_container col centered-text no-extra-padding has-animation" data-hover-bg="" data-animation="fade-in" data-delay="200">
							<div class="wpb_wrapper">
								<div id="fws_55b08d66d9865" class="wpb_row vc_row-fluid standard_section    " style="padding-top: 0px; padding-bottom: 0px; ">
									<div class="col span_12  ">
										<div class="vc_span12 wpb_column column_container col no-extra-padding has-animation" data-hover-bg="" data-animation="fade-in" data-delay="800">
											<div class="wpb_wrapper">
												<div class="wpb_text_column wpb_content_element ">
													<div class="wpb_wrapper">
														<p style="margin-bottom: 20px;"><img style="height: 9em;" class="aligncenter size-full wp-image-3024 feature2-image" src="assets/img/feature2.png" alt="man-blue" width="108" height="86" /></p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="wpb_text_column wpb_content_element ">
									<div class="wpb_wrapper">
										<h2><? echo Session::get('titleFeature2'); ?></h2>
										<p><? echo Session::get('bodyFeature2'); ?>
											<br />
											<a title="Program" href="/tutor" target="_blank">See More</a></p>
									</div>
								</div>
							</div>
						</div>
						<div class="vc_span4 wpb_column column_container col no-extra-padding" data-hover-bg="" data-animation="" data-delay="0">
							<div class="wpb_wrapper">
								<div id="fws_55b08d66da11c" class="wpb_row vc_row-fluid standard_section    " style="padding-top: 0px; padding-bottom: 0px; ">
									<div class="col span_12  ">
										<div class="vc_span12 wpb_column column_container col centered-text no-extra-padding has-animation" data-hover-bg="" data-animation="fade-in" data-delay="800">
											<div class="wpb_wrapper">
												<div class="wpb_text_column wpb_content_element ">
													<div class="wpb_wrapper">
														<p><img style="height: 10em;" class="aligncenter size-full wp-image-3123 feature3-image" src="assets/img/feature3.png" alt="success" width="70" height="86" /></p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="wpb_text_column wpb_content_element ">
									<div class="wpb_wrapper">
										<h2><? echo Session::get('titleFeature3'); ?></h2>
										<p><? echo Session::get('bodyFeature3'); ?>
										<br />
											<a title="Program" href="/operatingcompany" target="_blank">See More</a>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="full-width-div">
						<div id="top-person-influence">
							<div align="center" class="person 1st-person">
								<span class="name-title"><strong>Steve Jobs</strong></span>
								<p class="person-title">Apple’s co-founder</p>
								<img src="../assets/img/common/steve-jobs.jpg" alt="Steve Jobs" width="200">
								<blockquote>“I think everybody in this country should learn how to program a computer because it teaches you how to think.”</blockquote>
							</div>
							<div align="center" class="person 2nd-person">
								<span class="name-title"><strong>Mitch Resnick</strong></span>
								<p class="person-title">Professor of Learning Research, MIT Media Lab</p>
								<a href="http://www.ted.com/talks/mitch_resnick_let_s_teach_kids_to_code" target="_blank"><img src="../assets/img/common/Mitchel_Resnick.png" alt="Mitch Resnick" width="200"></a>
								<a href="http://www.ted.com/talks/mitch_resnick_let_s_teach_kids_to_code" target="_blank">Click here to view his speech</a>
								<blockquote>"Coding isn’t just for computer whizzes. It’s for everyone. Let's teach kids to code"</blockquote>
							</div>
						</div>
					</div>
			<!--/row-->
		</div>
		<!--/container-->
	</div>
</div>
<div class="remodal" data-remodal-id="choose1">
	<div class="modal-event">
		<section id="wrap" class="content-wrap" style="text-align: center;">
			<div id="choose-remodal-header">
				<h3>Catch the Banana</h3>
				<script type="text/javascript" src="http://9leap.net/games/4607/embed.js"></script>
			</div>
		</section>
	</div>
</div>
<div class="remodal" data-remodal-id="choose2">
	<div class="modal-event">
		<section id="wrap" class="content-wrap" style="text-align: center;">
			<div id="choose-remodal-header">
				<h3>Snow Fight</h3>
				<script type="text/javascript" src="http://9leap.net/games/4614/embed.js"></script>
			</div>
		</section>
	</div>
</div>
<div class="remodal" data-remodal-id="choose3">
	<div class="modal-event">
		<section id="wrap" class="content-wrap" style="text-align: center;">
			<div id="choose-remodal-header">
				<h3>Super Bear</h3>
				<script type="text/javascript" src="http://9leap.net/games/4629/embed.js"></script>
			</div>
		</section>
	</div>
</div>
<!--/ajax-content-wrap-->
<script>
	$(function() {
		$("#slideshow > div.slideshow:gt(0)").hide();

		setInterval(function() {
			$('#slideshow > div.slideshow:first')
				.fadeOut(2000)
				.next()
				.fadeIn(2000)
				.end()
				.appendTo('#slideshow');
			},  4000);

		$("#header-space").css("height", $("#header-outer").height());

		$(window).resize(function (){
			$("#header-space").css("height", $("#header-outer").height() + 13);
		});

		resizeHeight();

		function resizeHeight() {
			var origBodyWidth = 1349;
			var div = $('#ajax-content-wrap');
			var currentBodyWidth = $('body').width();
			var diff = origBodyWidth - currentBodyWidth;
			var neg = -1 * (diff/2);

			div.css('margin-top', neg);
		}

		$(window).resize( function () {
			resizeHeight();
		});

	});
</script>
