<div id="contents-wrap">
	<div id="main">
		<h3>Contact from Students</h3>
		<p class="link-more"><? echo Html::anchor('/admin/contactforum', 'See Contact <i class="fa fa-angle-right"></i>'); ?></p>
		<section class="feedback">
			<ul class="list-base">
				<? foreach($contacts as $contact): ?>
					<li><a href="/admin/contactforum/detail/<?= $contact->id; ?>"><? if($contact->is_read == 0): ?><span class="icon-new">New</span><? endif; ?><?= $contact->title; ?> <strong><?= date("H:i M d, Y.", $contact->created_at); ?></strong> posted by <?= $contact->user->firstname; ?> <?= $contact->user->middlename; ?> <?= $contact->user->lastname; ?></a></li>
				<? endforeach; ?>
			</ul>
		</section>
		<a name="cal"></a>
		<section>
			<div id="contents-wrap">
				<div id="main" class="new-m">
					<p class="view-events"><? echo Html::anchor("admin/grameencom/events/all", '<i class="fa fa-fw fa-calendar"></i> View Created Events'); ?></p>
					<h3>Reserved Students</h3>
						<?$day = Input::get('year')."-".Input::get('month')."-".Input::get('day');?>
						<? $today = Input::get('year')."-".Input::get('day')."-".Input::get('month'); ?>
						<table class="table-base" width="100%" border="0" cellpadding="0" cellspacing="0">
							<thead>
							<tr>
								<th>Student's Name</th>
								<th>Student's Lesson Chapter</th>
								<th>Student's Lesson Schedule</th>
								<th>Student's Tutor</th>
								<th>Status</th>
							</tr>
			
							</thead>
							<tbody>
							<? $a = 0; $res = []; ?>
							<? foreach($view as $views): ?>
								<? if($today == date("Y-d-m", $views->freetime_at)): ?>
									<tr class="course1">
										<td>
											<span class="detail"><? if($views->student != null) echo ucwords($views->student->firstname . " " . $views->student->middlename . " ". $views->student->lastname); ?></span>
											<p class="email"><? echo Html::anchor("admin/grameencom/students/detail/{$views->student->id}", "View Profile"); ?></p>
										</td>
										<td><span class="icon-course1"><?php echo Model_Lessontime::getCourse($views->language); ?></span><?= $views->number; ?> / 24 Lessons</td>
										<td><p class="date"><? echo date("A h:i ~ h:45, (D) j M Y ", $views->freetime_at); ?></p></td>
										<td>
											<span class="detail"><? if($views->teacher != null) echo ucwords($views->teacher->firstname . " " . $views->teacher->middlename . " ". $views->teacher->lastname); ?></span>
											<p class="email"><? echo Html::anchor("#{$views->teacher->id}", "View Profile"); ?></p>
										</td>
										<td><span>Reserved</span></td>
									</tr>
									<? $res[$a] = $views->freetime_at; $a++; ?>
								<? endif; ?>
							<? endforeach; ?>
							</tbody>
						</table>
				</div>
			</div>
		</section>
	</div>
	<? echo View::forge("admin/_menu"); ?>
</div>
<? foreach($view as $views): ?>
	<div class="remodal" data-remodal-id="<?= "{$views->teacher->id}"; ?>">
		<div id="contents-wrap">
			<div id="main">
				<h3>Profile</h3>
				<div id="contents" class="content-wrap">
					<ul class="tutors_list_l clearfix">
						<li class="<?= ($views->teacher->firstname == 'vandolph' || $views->teacher->firstname == 'Vandolph') ? 'show' : 'hide'?>">
							<div class="photo">
								<img src="/assets/img/front/tutor_01.png" alt="tutor photo">
							</div>
							<h4>Vandolph C. Reyes</h4>
							<aside>HTML / CSS / JavaScript</aside>
							<div class="text">Van graduated from Southwestern University with a diploma of Bachelor of Science Major in Information Technology. He was awarded as Researcher of the Year, elected as Ambassador President for the whole College of Computer Studies, and consistently on the Dean’s list. After graduation, he became a software engineer specializing in HTML, CSS and JavaScript and has worked on multiple projects of Web application. He is into sports, well rounded, flexible, a good communicator, and a person you can easily get along with.</div>
						</li>
						<li class="<?= ($views->teacher->firstname == 'leo alexander' || $views->teacher->firstname == 'Leo Alexander') ? 'show' : 'hide'?>">
							<div class="photo">
								<img src="/assets/img/front/tutor_03.jpg" alt="tutor photo">
							</div>
							<h4>Leo Alexander Suganob</h4>
							<aside>HTML / CSS / JavaScript</aside>
							<div class="text">Leo graduated from System Technology Institute with a Diploma in Bachelor of Science in Information Technology. He was once awarded as an Outstanding Senior Programmer of the year by leading a group of programmers during their thesis proposal and was on the Dean's list since his first year of college until he graduated. As a computer enthusiast, he keep seeking and exploring more knowledge about computers, especially in web development. He works as a Web Developer in the Philippines.</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
<? endforeach; ?>
<?= Asset::js("jquery.remodal.js"); ?>
<script>
	//tutors modal
	$('.hide').css('display','none');
	$('.show').css('display','block');
	$('ul.tutors_list_l li').css({
		'width':'auto',
		'float':'none',
		'textAlign':'left'
	});
</script>