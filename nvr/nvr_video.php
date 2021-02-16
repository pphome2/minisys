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

if (!file_exists($videofile)) {
	$videofile="";
}

if (empty($videofile)){
	$outtext=$L_NOFILE;
	$otext="";
} else {
	$outtext=$videofile;
	$ot=explode("/",$videofile);
	$outtext=$ot[count($ot)-1];
}

?>


<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo($NVR_NAME); ?></title>
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
		<li class="padleft"><a onclick="window.history.back();">&#8592;</a></li>
		<li class="padleft"><a href="index.html"><?php echo("$L_APPNAME - $L_PLAYER - $outtext"); ?></a></li>
		<li class="padleft"><a href="nvr_serv.php"><?php echo("$L_SERVICES"); ?></a></li>
	</ul>
</header>
	<div class="content">


	<center>

<?php
	if (!empty($videofile)){
		$fileext=explode('.',$videofile);
		$fileext_name=$fileext[count($fileext)-1];
		if (in_array($fileext_name,$NVR_SUPPORT_VIDEO)){
			echo("<video width=$NVR_WIDTH height=$NVR_HEIGHT controls>");
			echo("<source src=$videofile type=video/mp4>");
			echo($L_ERROR_VIDEO);
			echo("</video>");
		}else{
			echo("<img width=$NVR_WIDTH height=$NVR_HEIGHT src=$videofile>");
		}
?>

	<div class=insidecontent>
	<div class=row>
		<div class=col2>
			<div class=space>
			<a href='<?php echo($videofile); ?>' download >
				<input type=submit id=submitar name=submitar value=<?php echo($L_DOWNLOAD_TEXT) ?> >
			</a>
			</div>
		</div>
		<div class=col2>
			<div class=space>
			<a onclick="window.history.back();">
				<input type=submit id=submitar name=submitar value=<?php echo($L_BACKPAGE) ?> >
			</a>
			</div>
		</div>

	</div>
	</div>

<?php
	}else{
?>

	<div class=insidecontent>
		<a onclick="window.history.back();">
			<input type=submit id=submitar name=submitar value=<?php echo($L_BACKPAGE) ?> >
		</a>
	</div>

<?php
	}
?>
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
