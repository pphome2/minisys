<?php

 #
 # SysInfo - System information app
 #
 # info: main folder copyright file
 #
 #

$APP_URL="";

if (file_exists($APP_URL."sysinfo_cfg.php")){
	include($APP_URL."sysinfo_cfg.php");
}else{
	echo("Error!");
	exit();
}

if (file_exists($APP_URL.$SI_LANGFILE)){
	include($APP_URL.$SI_LANGFILE);
}

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo($SI_NAME); ?></title>
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" href="<?php echo($APP_URL); ?>favicon.png">
		<link rel="shortcut icon" type="image/png" href="<?php echo($APP_URL); ?>favicon.png" />
		<style>	<?php include($SI_CSS); ?></style>
	</head>
<body>
	<div class=all-page>
<header>
	<ul class="sidenav">
		<li class="padleft"><span class="title"><?php echo($L_APPNAME); ?></span></li>
	</ul>
</header>
	<div class="content">
		<div class="card">


<?php



function vinput($d) {
	$d=trim($d);
	$d=stripslashes($d);
	$d=strip_tags($d);
	#$d=htmlspecialchars($d);
	return $d;
}

######################################################################

# select and start function





?>

		</div>
	</div>
<footer>
	<ul class="sidenav">
		<li class="padleft"><?php echo($SI_COPYRIGHT); ?></li>
	</ul>
</footer>
</body>
</html>
