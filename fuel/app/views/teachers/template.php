<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="keywords" content="Game-bootcamp, Online Computer Programming Course, Kids Programming, enchantJS, Online School, Javascript kids , Programming,JavaScript, Japan, Singapore, Private Lesson, Edoo, Olivecode" />
	<meta name="description" content="Game Bootcamp is a 3-month online programming course for 8 to 15-year-old children." />
	<link rel="shortcut icon" href="/assets/img/common/favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">
	<meta property="og:title" content="Game-bootcamp | 3-month online programming course for 8 to 15-year-old children">
	<meta property="og:description" content="Game Bootcamp is a 3-month online programming course for 8 to 15-year-old children.">
	<meta property="og:url" content="http://www.game-bootcamp.com/">
	<meta property="og:image" content="http://game-bootcamp.com/assets/img/logo/logo2_b.png">
	<meta property="og:site_name" content="Game-BootCamp">
	<? echo Asset::css("common.css"); ?>
	<? echo Asset::css("teacher.css"); ?>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<? echo Asset::css("jquery.remodal.css"); ?>
	<? echo Asset::css("clndr.css"); ?>
	<title><? echo $title; ?> | Game-BootCamp | Get Your Kids the Most Powerful Skill in 21st Century</title>
</head>
<body>
<header>
	<h1><?php echo Html::anchor('/',Asset::img('logo/logo3_c.png', array('alt'=> 'Game-bootcamp', 'style'=>'width: 100%;'))); ?></h1>
	<nav>
		<div class="toggle"><i class="fa fa-bars"></i></div>
		<ul>
			<? if($auth_status): ?>
				<li><? echo Html::anchor('/teachers/profile', '<i class="fa fa-user"></i> Profile'); ?></li>
				<li><? echo Html::anchor('/teachers/setting', '<i class="fa fa-cog"></i> Setting'); ?></li>
				<li><? echo Html::anchor('/teachers/?logout=1', '<i class="fa fa-sign-out"></i> Logout');
					?></li>
			<? endif; ?>
		</ul>
	</nav>
</header>
<? if($auth_status): ?>
<section id="user-data">
	<figure><img src="/assets/img/pictures/s_<?= $user->getImage(); ?>" alt="<?= $name; ?>"></figure>
	<div class="reserve">
		<? echo Html::anchor('/teachers/lesson/add', '<i class="fa fa-plus-circle"></i> '); ?>
	</div>
	<div class="profile">
		<p class="name"><? echo $name; ?> </p>
		<ul class="clearfix">
			<li>
				<h3>This month</h3>
				<?
					$year = date("Y");
					$month = date("m");
					$lessontimes = Model_Lessontime::find("all", [
						"where" => [
							["teacher_id", $this->user->id],
							["deleted_at", 0],
							["freetime_at", ">=", strtotime("{$year}-{$month}-01")],
							["freetime_at", "<", strtotime("{$year}-{$month}-01 +1 month")]
						],
					]);
					$done = 0;
					$reserved = 0;
					foreach($lessontimes as $lessontime){
						if($lessontime->status == 2){
							$done++;
						}
						$reserved++;
					}

					$lastmonth = Model_Lessontime::count([
						"where" => [
							["teacher_id", $this->user->id],
							["deleted_at", 0],
							["status", 2],
							["freetime_at", ">=", strtotime("{$year}-{$month}-01 -1 month")],
							["freetime_at", "<", strtotime("{$year}-{$month}-01")]
						],
					]);
				?>
				<span><?= $reserved; ?></span> classes are reserved, <span><?= $done; ?></span> classes done.
			</li>
			<li>
				<h3>Last month</h3>
				<span><?= $lastmonth; ?></span> classes done
			</li>
		</ul>
		<p class="enrolled"></p>
	</div>
</section>
<? endif; ?>
<? echo $content; ?>
<script type="text/javascript">
$(function(){
	$("header .toggle").click(function(){
		$("header nav ul").slideToggle();
			return false;
	});
	$(window).resize(function(){
		var win = $(window).width();
		var p = 640;
		if(win > p){
			$("header nav ul").show();
		} else {
			$("header nav ul").hide();
		}
	});
});
</script>
</body>
</html>
