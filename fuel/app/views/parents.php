<section id="contents" class="parents">
	<div class="letter content-text">
		<div class="letter-content">
			<div id="content">
				<div id="content-1">
					<div id="topic-parents">
						<p><strong><i>Dear Parents</i></strong>, What comes to your mind when you hear <strong style="color: red;">“Programming”?</strong></p>
					</div>
					<div id="answer-parents">
						<p>
							Just because your kids learn programming doesn’t mean your kids have to become a programmer.
						</p>
						<p>
							The same can be applied to other educations. Just because your kids learn arts and crafts, and music doesn’t mean they have to become a painter or musician.
						</p>
						<p>
							Do you know the real reason why kids need to learn programming?
						</p>
						<p>
							The 21st century is an era of rapid change.
						</p>
						<p>
							There is no single answer to address the issues that arise from an increasingly complex world. We need to come up with multiple solutions through trial and error to realize our idea. That’s what it takes to survive in the 21st century.
						</p>
						<p>
							However, realizing our idea requires logical thinking and creativity.
						</p>
						<p>
							Programming is structured and layered by sequence, selection, and iteration. Therefore, if you learn programming, you will naturally obtain an ability to critically analyze and logically think what you see.
						</p>
						<p>
							On top of this, there is no absolute single solution in programming.
						</p>
						<p>
							There is not a correct answer but multiple alternative answers. Programming is similar to LEGO. Programming helps you develop your creativity because you can code the program based on your own imagination.
						</p>
						<p>
							Of course, if you master programming, you can obtain an IT skill to freely control IT devices and to realize what you want to do.
						</p>
						<p>
							If your kids develop logical thinking and creativity, and obtain an ability to realize their idea, they can survive in the 21st century without doubt.
						</p>
						<p>
							Programming provides your kids with the idea on how to use their brain.
						</p>
					</div>
				</div>
				<div id="content-2">
					<div id="picture-parents">
						<div id="picture-enclose"><img src="../assets/img/common/hirotoihara1b.jpg" alt="Hiroto Ihara" width="400"></div>
						<div id="picture-caption">
							<p>
								<strong>Hiroto Ihara</strong>
							<br>
								Chief Executive Officer, Edoo Inc.
							</p>
						</div>
					</div>
					<div id="ihara-descriptions">
						<p id="ihara-desc-title">
							<strong>[Profile of Founder]</strong>
						</p>
						<p>
							When Hiroto first visited Bangladesh, one of the poorest countries in Asia in March 2014, he found so many young people were unemployed due to a lack of access to education. After the visit, he decided to support neglected people to realize their hidden potential. He established Edoo Inc. and started a job-guaranteed online programming school for young Bangladeshi in February 2015.
							<br><br>
							He also looks to raise the next generation through computer programming so that they can leverage an ability to think and create in the 21st century.
							<br><br>
							He was previously CFO and Executive Vice President at Everlife; a Japanese health supplement company, a director at CLSA Capital Partners; a Pan-Asian based private equity fund, and a director of international and investment banking division at Mizuho Financial Group in London/Tokyo.
							<br><br>
							He has a degree in Economics from Kyushu University, Japan and holds Executive MBA from INSEAD.
							<br><br>
							He has a wife and two kids.
							<br>
							<br>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	$(function (){
		origBodyWidth = 1349;

		adjustHeight();

		function adjustHeight() {
			recentBodyWidth = $('body').width();
			origHeight = 1070;
			origHeight1 = 800;
			var diff = origBodyWidth - recentBodyWidth;
			var sum = origHeight + diff;
			var sum1 = origHeight1 + diff;
			var unit = "px";

			$('#content-1').css('min-height', sum + unit);
			$('#content-2').css('min-height', sum1 + unit);

			if(recentBodyWidth <= 667){
				var sum2 = sum - 250;
				$('#content-2').css('min-height', sum2 + unit);
			}
		}

		$(window).resize(function() {
			adjustHeight();
		});
	});
</script>
