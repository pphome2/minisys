<?php

 #
 # nvr - System information app
 #
 # info: main folder copyright file
 #
 #

$APP_URL="";

if (file_exists($APP_URL."nvr_cfg.php")){
	include($APP_URL."nvr_cfg.php");
}else{
	echo("Error!");
	exit();
}

if (file_exists($APP_URL.$NVR_LANG)){
	include($APP_URL.$NVR_LANG);
}


$videofile="";
if (!empty($_GET[$NVR_TAG])) {
	$videofile=$_GET[$NVR_TAG];
}

if (!file_exists($NVR_DIR."/".$videofile)) {
	$videofile="";
}

if (empty($videofile)){
	$outtext=$L_NOFILE;
} else {
	$outtext=$videofile;
}

?>


<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo($SI_NAME); ?></title>
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" href="favicon.png">
		<link rel="shortcut icon" type="image/png" href="favicon.png" />
		<style>	<?php include($NVR_CSS); ?></style>
	</head>
<body>
	<div class=all-page>
<header>
	<ul class="sidenav">
		<li class="padleft"><a href="index.html"><?php echo("$L_APPNAME - $L_PLAYER - $outtext"); ?></a></li>
	</ul>
</header>
	<div class="content">


	<div class=insidecontent>
		<input type=submit id=submitar name=submitar value='<?php echo("$outtext") ?>' >
	</div>
	<center>

<?php
	if (!empty($videofile)){
		echo("<video width=55% height=55% controls>");
		echo("<source src=$videofile type=video/mp4>");
		echo($L_ERROR_VIDEO);
		echo("</video>");
	}
?>


	<div class=insidecontent>
		<a onclick="window.history.back();">
			<input type=submit id=submitar name=submitar value=<?php echo($L_BACKPAGE) ?> >
		</a>
	</div>


	</div>


<footer>
	<ul class="sidenav">
		<li class="padleft"><?php echo($NVR_COPYRIGHT); ?></li>
	</ul>
</footer>
</body>
</html>

<?php
?>
