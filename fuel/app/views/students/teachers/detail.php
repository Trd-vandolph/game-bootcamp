<div id="contents-wrap">
	<div id="main">
		<h3><?= $user->firstname; ?> <?= $user->middlename . " "; ?><?= $user->lastname; ?></h3>
		<div class="content-wrap teacher-profile">
				<div class="photo">
					<? if($user->img_path != "") echo '<img src="/assets/img/pictures/m_'.$user->img_path.'">';?>
				</div>
				<div class="detail">
					<!--
					<div class="buttons">
					<a href="#" class="fav"><i class="fa fa-star"></i></a>
					</div>
					-->	
					<aside><? if($user->html5 == 1): ?>HTML/CSS<? endif; ?>　<? if($user->javascript == 1): ?>JavaScript<? endif; ?></aside>
					<div class="text">
						<? echo nl2br($user->pr); ?>
					</div>
				</div>
		</div>
	<?php /*
		<section class="content-wrap">
			<ul class="forms">
				<li>
					<h4>Name</h4>
					<div>
						
					</div>
				</li>
				<li>
					<h4>Email address</h4>
					<div>
						<? echo $user->email; ?>
					</div>
				</li>
				<li>
					<h4>Gender</h4>
					<div>
						<?
						if($user->sex == 1){
							echo "Female";
						}else{
							echo "Male";
						}
						?>
					</div>
				</li>
				<li>
					<h4>Birthday</h4>
					<div>
						<?= date("M d, Y.", strtotime($user->birthday)); ?>
					</div>
				</li>

				<li>
					<h4>Gmail address</h4>
					<div>
						<? echo $user->google_account; ?>
					</div>
				</li>
				<li>
					<h4>PR</h4>
					<div>
						<? echo nl2br($user->pr); ?>
					</div>
				</li>
				<li>
					<h4>Educational background</h4>
					<div>
						<? echo $user->educational_background; ?>
					</div>
				</li>
			</ul>
		</section>
		*/ ?>
	</div>
	<? echo View::forge("students/_menu")->set($this->get()); ?>
</div>