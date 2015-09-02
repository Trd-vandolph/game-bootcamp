<!doctype html>
<html>
<head>
	<meta charset="UTF-8">

  <meta name="keywords" content="OliveCode,Online Computer Programming Course,Job Guaranteed,WordPress,HTML,CSS,Programming,Git,JavaScript,Bangladesh,Private Lesson,Edoo" />
  <meta name="description" content="OliveCode is the job guaranteed online computer programming course for Bangladeshi. It is a private lesson in English for 4 months, followed by 2-month internship at an IT company." />

  <link rel="shortcut icon" href="/assets/img/common/game_b.ico">
  <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">

  <meta property="og:title" content="Olive code | Job Guaranteed Online Computer Programming Course for Bangladeshi">
  <meta property="og:description" content="OliveCode is the job guaranteed online computer programming course for Bangladeshi. It is a private lesson in English for 4 months, followed by 2-month internship at an IT company.">
  <meta property="og:url" content="http://www.olivecode.com/">
  <meta property="og:image" content="http://www.olivecode.com/assets/img/front/logo_front.png?1423213936">
  <meta property="og:site_name" content="OliveCode">

	<?= Asset::css("common.css"); ?>
	<?= Asset::css("student.css"); ?>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <!--[if IE]><script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<?= Asset::css("jquery.remodal.css"); ?>
	<title><? echo $title; ?> | Olive code | Job Guaranteed Online Computer Programming Course for Bangladeshi</title>
</head>
<body>
<header>
	<h1><?php echo Html::anchor('/',Asset::img('logo/logo3_c.png', array('alt'=> 'Game-bootcamp', 'style'=>'width: 100%;'))); ?></h1>
	<nav>
		<div class="toggle"><i class="fa fa-bars"></i></div>
		<ul>
			<? if($auth_status): ?>
				<li><? echo Html::anchor('/students/profile', '<i class="fa fa-user"></i> Profile'); ?></li>
				<li><? echo Html::anchor('/students/setting', '<i class="fa fa-cog"></i> Setting'); ?></li>
				<li><? echo Html::anchor('/students/?logout=1', '<i class="fa fa-sign-out"></i> Logout'); ?></li>
			<? endif; ?>
		</ul>
	</nav>
</header>
<? if($auth_status): ?>
	<section id="user-data">
		<figure><img src="/assets/img/pictures/s_<?= $user->getImage(); ?>" alt="<?= $name; ?>"></figure>
		<div class="profile">
			<p class="name"><? echo $name; ?></p>
			<p class="enrolled">
				<? if($user->charge_html == 1): ?>
					<?
					$html = Model_Lessontime::count([
						"where" => [
							["language", 0],
							["student_id", $this->user->id],
							["status", 2],
							["deleted_at", 0],
							["category", 1]
							
						],
					]);
					?>
				enchant.js Course (<?= $html; ?>/12)
				<? elseif($user->charge_html == 11): ?>
					<?
					$html = Model_Lessontime::count([
						"where" => [
							["language", 0],
							["student_id", $this->user->id],
							["status", 2],
							["deleted_at", 0],
							["category", 1]
						],
					]);
					?>
				enchant.js Course (<?= $html; ?>/12)
				<? elseif($user->charge_html == 111): ?>
					<?
					$html = Model_Lessontime::count([
						"where" => [
							["language", 0],
							["student_id", $this->user->id],
							["status", 2],
							["deleted_at", 0],
							["category", 1]
						],
					]);
					?>
				enchant.js Course (<?= $html; ?>/12)
				<? endif ?>
			</p>
		</div>
		<div class="reserve">
			<?
				$pasts = Model_Lessontime::find("all", [
						"where" => [
								["student_id", $this->user->id],
								["status", 2],
								["language", Input::get("course", 0)],
								["deleted_at", 0]
						]
				]);
				
				$donetrial = Model_Lessontime::find("all", [
					"where" => [
							["student_id", $this->user->id],
							["status", 2],
							["language", Input::get("course", -1)],
							["deleted_at", 0]
					]
				]);
			?>
			<? if(count($donetrial) < 1  && count($pasts) < 1): ?>
				<? echo Html::anchor('/students/lesson/add?course=-1', '<i class="fa fa-plus-circle"></i> '); ?>
			<? elseif(count($donetrial) == 1 && count($pasts) >= 0 && count($pasts) <= 23): ?>
				<? echo Html::anchor('/students/lesson/add?course=0', '<i class="fa fa-plus-circle"></i> '); ?>
			<? elseif(count($pasts) >= 24 && count($pasts) <= 32): ?>
				<? echo Html::anchor('/students/lesson/add?course=1', '<i class="fa fa-plus-circle"></i> '); ?>
			<? else: ?>
				<? echo Html::anchor('/students/lesson/add', '<i class="fa fa-plus-circle"></i> '); ?>
			<? endif; ?>
		</div>
	</section>
<? endif; ?>
<? echo $content; ?>
<?php echo Asset::js('base.js'); ?>
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
