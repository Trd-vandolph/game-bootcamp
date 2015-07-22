<div id="contents-wrap">
	<div id="main">
		<h3>User profile</h3>
		<section class="content-wrap">
			<ul class="forms">
				<li>
					<h4>Name</h4>
					<div>
						<?= $user->firstname; ?> <?= $user->middlename . " "; ?><?= $user->lastname; ?>
					</div>
				</li>
				<li>
					<h4>Email address</h4>
					<div>
						<? echo $user->email; ?>
					</div>
				</li>
				<li>
					<h4>Name</h4>
					<div>
						<? echo $user->firstname; ?>
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
			</ul>
		</section>
	</div>
	<? echo View::forge("teachers/_menu"); ?>
</div>