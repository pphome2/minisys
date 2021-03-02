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

$day="";
if (!empty($_GET[$NVR_DAY_TAG])) {
	$day=$_GET[$NVR_DAY_TAG];
}else{
	$day=0;
}
$store=false;
if ($day===$NVR_STORE_DIR){
	$store=true;
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
		<li class="padleft"><a href='<?php echo($NVR_PRG); ?>'><?php echo("$L_APPNAME - $L_PLAYER - $outtext"); ?></a></li>
		<li class="padleft"><a href='<?php echo($NVR_PRG); ?>'><?php echo("$L_DAYS[0]"); ?></a></li>
		<li class="padleft"><a href="<?php echo($NVR_SERV_FILE); ?>"><?php echo("$L_SERVICES"); ?></a></li>
		<li class="padleft"><a href='<?php echo("$NVR_PRG?$NVR_DAY_TAG=$NVR_STORE_DIR"); ?>'><?php echo("$L_STORE"); ?></a></li>
		<?php if (!empty($NVR_LIVE_URL)){ ?>
			<li class="padleft"><a href='<?php echo("$NVR_LIVE_URL"); ?>' target="_blank"><?php echo("$L_LIVE_VIEW"); ?></a></li>
		<?php } ?>
	</ul>
</header>
	<div class="content">


	<center>

<?php

$vf="";
if (!empty($_GET[$NVR_STORE_TAG])) {
	if (file_exists($videofile)) {
		$ot=explode("/",$videofile);
		$of=$ot[count($ot)-1];
		$vf=$NVR_DIR."/".$NVR_STORE_DIR."/".$of;
		if (file_exists($vf)){
			echo("<div class=infobar>$L_STORE_FILE_EXISTS: $videofile</div>");
		}else{
			if (copy($videofile,$vf)){
				echo("<div class=infobar>$L_STORE_COPY: $videofile</div>");
			}else{
				echo("<div class=errorbar>$L_ERROR: $videofile</div>");
			}
		}
	}else{
		echo("<div class=errorbar>$L_ERROR: $videofile</div>");
	}
	echo("<br /><br />");
}else{
}

if (!empty($videofile)){
	$fileext=explode('.',$videofile);
	$fileext_name=$fileext[count($fileext)-1];
	if (in_array($fileext_name,$NVR_SUPPORT_VIDEO)){
		echo("<video width=$NVR_WIDTH height=$NVR_HEIGHT controls>");
		echo("<source src=$videofile type=video/mp4>");
		echo("<div class=errorbar>$L_ERROR_VIDEO: $videofile</div>");
		echo("</video>");
	}else{
		echo("<img width=$NVR_WIDTH height=$NVR_HEIGHT src=$videofile>");
	}
?>

	<div class=insidecontent>
	<div class=row>
		<div class=col4>
			<div class=space>
			<a href='<?php echo($videofile); ?>' download >
				<input type=submit id=submitar name=submitar value=<?php echo($L_DOWNLOAD_TEXT) ?> >
			</a>
			</div>
		</div>
		<div class=col4>
			<div class=space>
			<a href='<?php echo("$NVR_DELETE?$NVR_DAY_TAG=$day&$NVR_TAG=$videofile"); ?>'>
				<input type=submit id=submitar name=submitar value=<?php echo($L_DELETE) ?> >
			</a>
			</div>
		</div>
		<div class=col4>
			<div class=space>
			<?php
			if ((!$store)and(!file_exists($vf))){
			?>
				<a href='<?php echo("?$NVR_STORE_TAG=1&$NVR_TAG=$videofile"); ?>'>
					<input type=submit id=submitar name=submitar value='<?php echo($L_STORE_COPYTO) ?>' >
				</a>
			<?php
			}else{
			?>
				<input type=submit id=submitar name=submitar value='<?php echo($L_STORE_FILE_EXISTS) ?>' >
			<?php
			}
			?>
			</div>
		</div>
		<div class=col4>
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
	<div class=center50>
		<a onclick="window.history.back();">
			<input type=submit id=submitar name=submitar value=<?php echo($L_BACKPAGE) ?> >
		</a>
	</div>
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
