<!doctype html>
<html>
<head>
	<meta charset="UTF-8">

  <link rel="shortcut icon" href="/assets/img/common/game_b.ico">
  <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">

	<meta name="keywords" content="OliveCode,Programming,Bangladesh,Job,E-Learning,Edoo" />
	<meta name="description" content="Learning Changes Your Life - Job Guaranteed Online Computer Programming Course for Bangladeshi" />

	<meta property="og:title" content="">
	<meta property="og:type" content="article">
	<meta property="og:description" content="">
	<meta property="og:url" content="">
	<meta property="og:image" content="">
	<meta property="og:site_name" content="">
	<meta property="og:email" content="">

	<? echo Asset::css("common.css"); ?>
	<? echo Asset::css("student.css"); ?>
	<? echo Asset::css("admin.css"); ?>
	<? echo Asset::css("clndr.css"); ?>
	<? echo Asset::css("jquery.remodal.css"); ?>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <!--[if IE]><script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	
	<? echo Asset::js("tinymce/tinymce.min.js"); ?>
	<title><? echo $title; ?> | Olive Code</title>
</head>
<body>
<header>
	<h1><?php echo Html::anchor('/',Asset::img('logo/logo3_c.png', array('alt'=> 'Game-bootcamp', 'style'=>'width: 100%;'))); ?></h1>
	<nav>
		<ul>
			<? if($auth_status): ?>
			<li><? echo Html::anchor('/admin/?logout=1', '<i class="fa fa-sign-out"></i> Logout');
				?></li>
			<? endif; ?>
		</ul>
	</nav>
</header>
<? echo $content; ?>
<footer>
</footer>
</body>
</html>
