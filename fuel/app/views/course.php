<section id="contents" class="course">
	<div class="course-content content-text">
		<div id="content">
			<br>
			<br>
			<img class="no-shadow" src="../assets/img/front/months.png" /><br>
			<div id="under-timeline">
				<div id="1st-content">
					<table>
						<tr>
							<td>
								<p class="lesson-content">
									Lesson 1 ~ 4
								</p>
							</td>
							<td>
								<p class="lesson-content">
									Lesson 5 ~ 8
								</p>
							</td>
							<td>
								<p class="lesson-content">
									Lesson 9 ~ 12
								</p>
							</td>
						</tr>
					</table>
				</div>
				<div id="2nd-content">
					<p>
						The course is tailored for beginners at the age of 8 - 15 years and consists of private lesson and home-study.
						<br>
						<br>
						Experienced tutors in the Philippines conduct a private lesson.
						<br>
						<br>
						Students will learn how to code games for three months by taking a lesson once a week.
						<br>
						<br>
						Lesson is provided from 10:00 to 24:00 (Philippines time) Monday through Friday. Students can choose the most convenient lesson time.
						<br>
						<br>
						The length of each lesson is 45 minutes.
						<br>
						<br>
						Original textbooks are made by our experienced engineers.
					</p>
				</div>
			</div>
			<div id="games-container">

				<div id="1st-game">
					<p class="p-left game-title" id="p-1st">1st month - Catch The Banana</p>
					<div class="game-table">
						<div class="game-row">
							<div class="game-cell">
								<img class="img-left" src="../assets/img/front/game1.png" alt="Catch The Banana"/>
							</div>
							<div class="game-cell">
								<p><strong>Name: </strong> Catch The Banana</p>
								<p><strong>Description: </strong> All you need to do is catch bananas as long as you can. Don't allow 20 bananas to reach to ground or else the game is over. </p>
								<p><strong>Key Points: </strong> Moving object from left to right using computer's mouse, Random places of objects, Scoring.</p>
							</div>
						</div>
					</div>
				</div>

				<div id="2nd-game">
					<p class="p-left game-title" id="p-2nd">2nd month - Snow Fight</p>
					<div class="game-table">
						<div class="game-row">
							<div class="game-cell">
								<img class="img-left" src="../assets/img/front/game3.png" alt="Snow Fight"/>
							</div>
							<div class="game-cell">
								<p><strong>Name: </strong> Snow Fight</p>
						    <p><strong>Description: </strong> Shoot white bears as long as you wanted. Don't let them hit you for over three times or else the game is over.</p>
						    <p><strong>Key Points: </strong> Create shooting object, Score if hit the enemy, Disappear when hit, Game over when hit by Enemy object.</p>
							</div>
						</div>
					</div>
				</div>

				<div id="3rd-game">
					<p class="p-left game-title" id="p-3rd">3rd month - Super Bear</p>
					<div class="game-table">
						<div class="game-row">
							<div class="game-cell">
								<img class="img-left" src="../assets/img/front/game2.png" alt="Super Bear"/>
							</div>
							<div class="game-cell">
								<p><strong>Name: </strong> Super Bear</p>
								<p><strong>Description: </strong> The same way super mario does his thing. You should reach the finish line without falling or get hit by obstacles.</p>
								<p><strong>Key Points: </strong> Make a running motion, Make a full width map, Game over when hit the bottom, Score base on distance travel, Make sound effects</p>
							</div>
						</div>
					</div>
				</div>

			</div>

			<div id="enchantJS">
				<p class="p-left"><a href="http://enchantjs.com/" target="_blank">Enchant JS</a></p>
				<div class="1st-content">
					<p>We teach students enchant.js.</p>
					<p>echant.js is a game engine that enables students to create a program by writing simple codes and can work on Windows, Mac OS, iOS, and Android.</p>
					<p>The reason we chose enchant.js is it is built on the basis of HTML and JavaScript.</p>
					<p>As HTML and JavaScript are the first programming languages to be mastered in the world of programming, students can apply what they learn in our course to other advanced programming smoothly. Mastering enchant.js makes it easier for students to go a step further to the next stage.</p>
				</div>
				<div class="2nd-content">
					<a href="http://enchantjs.com/" target="_blank"><img src="../assets/img/front/enchant_logo.png" alt="enchant.js" /></a>
				</div>
			</div>

			<div id="9leap">
				<p class="p-left"><a href="http://9leap.net/info/about?sessionLang=en" target="_blank">9leap</a></p>
				<div class="1st-content">
					<a href="http://9leap.net/info/about?sessionLang=en" target="_blank"><img src="../assets/img/front/9leap_logo.jpg" alt="9leap"/></a>
				</div>
				<div class="2nd-content">
					<p>9leap is a game sharing site not only for posting games kids have made but for playing games others have posted. There are over 1,000 games posted on the site.</p>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	$(function (){

		exchange();

		function exchange() {
			var first = $('#enchantJS .1st-content');
			var last = $('#enchantJS .2nd-content');

			if($('body').width() <= 500) {
				last.after(first);
			}
		}

		$(window).resize(function (){
			exchange();
		});

	});
</script>
