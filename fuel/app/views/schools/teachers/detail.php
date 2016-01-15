<div id="contents-wrap">
	<div id="main">
		<h3><?= $user->firstname; ?> <?= $user->middlename . " "; ?><?= $user->lastname; ?></h3>
		<div class="content-wrap teacher-profile">
				<div class="photo">
					<? if($user->img_path != "") echo '<img src="/assets/img/pictures/m_'.$user->img_path.'">';?>
				</div>
				<div class="detail">
					<aside><? if($user->html5 == 1): ?>HTML/CSS<? endif; ?>　<? if($user->javascript == 1): ?>JavaScript<? endif; ?></aside>
					<div class="text">
						<? echo nl2br($user->pr); ?>
					</div>
				</div>
		</div>
	</div>
	<? echo View::forge("schools/_menu")->set($this->get()); ?>
</div>
