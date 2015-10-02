<section id="contents" class="operatingcompany">
	<div class="content-operating-company content-text">
		<div id="content">
			<div id="first-content" class="content-company">
				<div class="picture-content">
					<a href="http://www.edoo.co.jp" target="_blank"><img alt="Edoo Logo" src="../assets/img/front/edoo_logo.png" /></a><br>
					<div>
						<a href="http://www.edoo.co.jp" target="_blank">www.edoo.co.jp</a>
					</div>
				</div>
				<div class="text-content">
					<p class="title">
						Edoo
					</p>
					<p class="bold-title"></p>
					<p class="body-content">
						Game bootcamp is operated by Edoo Inc.
					</p>
					<p>
						Edoo is a Japanese education company established to support neglected people and the next generation people through education around the world.
					</p>
					<p>
						The management of Edoo strongly believes education can change one's life. Mission of Edoo is to realize potential of people who are passionate about learning.
					</p>
				</div>
			</div>
			<div id="second-content" class="content-company">
				<div class="picture-content">
					<a href="http://www.olivecode.com" target="_blank"><img alt="OliveCode Logo" src="../assets/img/front/logo2.png" /></a><br>
					<div>
						<a href="http://www.olivecode.com" target="_blank">www.olivecode.com</a>
					</div>
				</div>
				<div class="text-content">
					<p class="title">
						OliveCode
					</p>
					<p class="bold-title"></p>
					<p class="body-content">
						Edoo launched OliveCode, a job-guaranteed online programming school for young Bangladeshi jointly with Grameen Communications, one of the group companies of Grameen Bank, a Nobel Peace Prize-winning micro-finance organization in Bangladesh.
					</p>
				</div>
			</div>

			<div class="student_container">
				<div id="students">
				<p class="catch">Students</p>
				<div class="detail">
				<ul>
					<li class="student01">
						<img src="/assets/img/front/mazed.png" alt="photo" height="180" width="180">
						<p class="name">Mazedur Rahman</p>
						<h4><strong>"Learning programming enhances my logical thinking and also helps me make a right decision".</strong></h4>
						<div class="read">
							<a href="http://www.olivecode.com/voice1" target="_blank"><span><strong>Read More</strong></span></a>
						</div>
					</li>
					<li class="student02">
						<img src="/assets/img/front/sakib.png" alt="photo" height="180" width="180">
						<p class="name">Sakib Hasan</p>
						<h4><strong>"Learning the basics of how to code on OliveCode has improved my problem solving skills".</strong></h4>
						<div class="read">
							<a href="http://www.olivecode.com/voice2" target="_blank"><span><strong>Read More</strong></span></a>
						</div>
					</li>
				</ul>
				</div>
				</div>
			</div>

			<div id="third-content" class="content-company">
				<div class="picture-content">
					<a href="http://www.grameencommunications.org" target="_blank"><img alt="Grameen Communication Logo" src="../assets/img/front/GC.png" /></a><br>
					<div>
						<a href="http://www.grameencommunications.org" target="_blank">www.grameencommunications.org</a>
					</div>
				</div>
				<div class="text-content">
					<p class="title">
						Grameen Communications
					</p>
					<p class="bold-title"></p>
					<p class="body-content">
						Grameen Communications is a leading IT company in Bangladesh specializing in micro-finance software solutions. gBanker, a flagship software product for micro-finance is adopted by more than 70 national and international organizations all over the world.
					</p>
				</div>
			</div>
			<div id="fourth-content" class="content-company">
				<div class="picture-content">
					<a href="http://www.olivecode.com/grameen" target="_blank"><img alt="Grameen and OliveCode Logo" src="../assets/img/front/banner.jpg" /></a>
				</div>
				<div class="text-content">
					<p class="title">
						Grameen Communicatons &<br>
						OliveCode
					</p>
					<p class="bold-title"></p>
					<p class="body-content">
						Grameen communications values a curriculum of OliveCode and collaborates with Edoo to operate the first job-guaranteed online programming school in Bangladesh.
					</p>
					<p>
						Grameen Communications and Edoo executed an agreement on joint-initiative to grow OliveCode for the purpose of  raising programmers and creating job opportunities for poor young Bangladeshi in IT industry.
					</p>
				</div>
				<div class="picture-content">
					<img src="../assets/img/front/DSC_0766.jpg" alt="Signing"/><br>
					<div>
						<a href="http://www.olivecode.com/grameen" target="_blank">www.olivecode.com/grameen</a>
						<div>
							<i>Grameen Communications and Edoo executed an agreement in June 2015 on joint-initiative to grow.</i>
						</div>
					</div>
				</div>
				<div class="text-content">
					<p>
						While Edoo offers an online teaching, Grameen Communications offers its training center for poor young people who don't have PC and stable Internet access at home.
					</p>
					<p>
						The number of students has been growing since inception of the course. The graduates of the course are hired by a software development company that is affiliated with Edoo and given job opportunities as professional programmer.
					</p>
					<p>
						Edoo now supports the next generation kids with teaching programming by making the most of its expertise fostered by opearting OliveCode.
					</p>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	$(function () {
		var originalHeight = $('section.operatingcompany #fourth-content .text-content').height();
		var changeTop = $('section.operatingcompany #fourth-content > div:nth-child(4)');

		dynamicHeight();

		function dynamicHeight() {
			if($('body').width() < 1180) {
					var recentHeight = $('section.operatingcompany #fourth-content .text-content').height();

			//		alert(recentHeight);
					var diff = recentHeight - originalHeight;

			//		alert(diff);

					var sum = 400 + diff;
					changeHeight.css('top', sum);
			}
		}

		$(window).resize(function (){
			dynamicHeight();
		});

	});
</script>
