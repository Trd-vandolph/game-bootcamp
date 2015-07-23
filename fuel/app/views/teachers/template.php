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

	<? echo Asset::css("common.css"); ?>
	<? echo Asset::css("teacher.css"); ?>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<? echo Asset::css("jquery.remodal.css"); ?>
	<? echo Asset::css("clndr.css"); ?>
  <!--[if IE]><script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

	<title><? echo $title; ?> | Olive code | Job Guaranteed Online Computer Programming Course for Bangladeshi</title>
</head>
<body>
<header>
	<h1><?php echo Html::anchor('/teachers/',Asset::img('common/logo.png', array('alt'=> 'OliveCode'))); ?></h1>
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
		<p class="name"><? echo $name; ?> <!--<span><i class="fa fa-star"></i>124</span></p>-->
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
		<p class="enrolled"><!--This month You had finished 13 classes,5 classes are reserved.--></p>
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
