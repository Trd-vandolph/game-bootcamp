<div id="side">
	<nav>
		<ul>
			<li><? echo Html::anchor('/teachers/', '<i class="fa fa-fw fa-newspaper-o"></i> Dashboard'); ?></li>
		</ul>
	</nav>
	<h3>LESSON</h3>
	<nav>
		<ul>
			<li><? echo Html::anchor('/teachers/lesson/reserved', '<i class="fa fa-fw fa-table"></i> Reserved Schedule'); ?></li>
			<li><? echo Html::anchor('/teachers/lesson/add', '<i class="fa fa-fw fa-plus-circle"></i> Schedule Lesson'); ?></li>
			<li><? echo Html::anchor('/teachers/lesson/histories', '<i class="fa fa-fw fa-history"></i> History'); ?></li>
			<li><? echo Html::anchor('/teachers/textbooks', '<i class="fa fa-fw fa-book"></i> Textbook'); ?></li>
		</ul>
	</nav>
	<h3> MENU</h3>
	<nav>
		<ul>
			<li><? echo Html::anchor('/teachers/documents', '<i class="fa fa-fw fa-file"></i> Documents</a>'); ?></li>
			<li><? echo Html::anchor('/teachers/news', '<i class="fa fa-fw fa-info-circle"></i> Information'); ?></li>
			<!-- li><? echo Html::anchor('/teachers/forum', '<i class="fa fa-fw fa-users"></i> Forum'); ?></li-->
			<li><? echo Html::anchor('/teachers/contactforum', '<i class="fa fa-fw fa-envelope"></i> Contact'); ?></li>
		</ul>
	</nav>
</div>