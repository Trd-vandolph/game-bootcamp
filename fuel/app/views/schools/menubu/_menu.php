<div id="side">
	<nav>
		<ul>
			<li><? echo Html::anchor('/students/', '<i class="fa fa-fw fa-newspaper-o"></i> Dashboard'); ?></li>
		</ul>
	</nav>
	<h3>LESSON</h3>
	<nav>
		<ul>
			<? if(isset($donetrial) && count($donetrial) < 1  && count($pasts) < 1): ?>
				<? if($user->place == 0): ?>
					<li><? echo Html::anchor('/students/lesson/add?course=-1', '<i class="fa fa-fw fa-calendar"></i> <span>Lesson Schedule</span><br><span>(Home Course)</span>'); ?></li>
				<? else: ?>
					<li><? echo Html::anchor('/students/lesson/add?course=-1', '<i class="fa fa-fw fa-calendar"></i> <span>Lesson Schedule</span><br><span>(Grameen Course)</span>'); ?></li>
				<? endif; ?>
			<? elseif(isset($donetrial) && count($donetrial) == 1 && count($pasts) >= 0 && count($pasts) <= 23): ?>
				<? if($user->place == 0): ?>
					<li><? echo Html::anchor('/students/lesson/add?course=0', '<i class="fa fa-fw fa-calendar"></i> <span>Lesson Schedule</span><br><span>(Home Course)</span>'); ?></li>
				<? else: ?>
					<li><? echo Html::anchor('/students/lesson/add?course=0', '<i class="fa fa-fw fa-calendar"></i> <span>Lesson Schedule</span><br><span>(Grameen Course)</span>'); ?></li>
				<? endif; ?>
			<? elseif(isset($donetrial) && count($pasts) >= 24 && count($pasts) <= 32): ?>
				<? if($user->place == 0): ?>
					<li><? echo Html::anchor('/students/lesson/add?course=1', '<i class="fa fa-fw fa-calendar"></i> <span>Lesson Schedule</span><br><span>(Home Course)</span>'); ?></li>
				<? else: ?>
					<li><? echo Html::anchor('/students/lesson/add?course=0', '<i class="fa fa-fw fa-calendar"></i> <span>Lesson Schedule</span><br><span>(Grameen Course)</span>'); ?></li>
				<? endif; ?>
			<? else: ?>
				<? if($user->place == 0): ?>
					<li><? echo Html::anchor('/students/lesson/add', '<i class="fa fa-fw fa-calendar"></i> <span>Lesson Schedule</span><br><span>(Home Course)</span>'); ?></li>
				<? else: ?>
					<li><? echo Html::anchor('/students/lesson/add', '<i class="fa fa-fw fa-calendar"></i> <span>Lesson Schedule</span><br><span>(Grameen Course)</span>'); ?></li>
				<? endif; ?>
			<? endif; ?>
			
			<li><? echo Html::anchor('/students/lesson/histories', '<i class="fa fa-fw fa-history"></i> Learning History'); ?></li>
			<li><? echo Html::anchor('/students/textbooks', '<i class="fa fa-fw fa-book"></i> Textbook'); ?></li>
			<?php /* <li><a href="#"><i class="fa fa-fw fa-graduation-cap"></i> How to Take Lesson</a></li> */ ?>
		</ul>
	</nav>
	<h3> MENU</h3>
	<nav>
		<ul>
			<?php /* <li><a href="#"><i class="fa fa-fw fa-credit-card"></i> New Course</a></li> */ ?>
			<li><? echo Html::anchor('/students/teachers', '<i class="fa fa-fw fa-search"></i> Tutors'); ?></li>
			<li><? echo Html::anchor('/students/documents', '<i class="fa fa-fw fa-file"></i> Documents'); ?></li>
			<li><? echo Html::anchor('/students/news', '<i class="fa fa-fw fa-info-circle"></i> Information'); ?></li>
			<li><? echo Html::anchor('/students/forum', '<i class="fa fa-fw fa-users"></i> Forum'); ?></li>
			<li><? echo Html::anchor('/students/contactforum', '<i class="fa fa-fw fa-envelope"></i> Contact'); ?></li>
			<li><? echo Html::anchor('/faq', '<i class="fa fa-fw fa-question-circle"></i> FAQ', array('class' => 'blank')); ?></li>
		</ul>
	</nav>
</div>
<script>
	$(function(){ $('#side > nav:nth-child(3) > ul > li:nth-child(1) a > span:eq(1)').css('marginLeft','22px'); });
</script>