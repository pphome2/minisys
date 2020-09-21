<?php

 #
 # AppMan - install/update/config app
 #
 # info: main folder copyright file
 #
 #

$APP_URL="";

if (file_exists($APP_URL."appman_cfg.php")){
	include($APP_URL."appman_cfg.php");
}else{
	echo("Error!");
	exit();
}

if (file_exists($APP_URL.$AM_LANGFILE)){
	include($APP_URL.$AM_LANGFILE);
}

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo($AM_NAME); ?></title>
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" href="<?php echo($APP_URL); ?>favicon.png">
		<link rel="shortcut icon" type="image/png" href="<?php echo($APP_URL); ?>favicon.png" />
		<style>	<?php include($AM_CSS); ?></style>
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
			<div class="card-header topleftmenu1"></div>
			<div class="cardbody" id="cardbodyf">
				<div class="insidecontent">


<?php

# cpy file and unpacked
function cpdecomp($src,$dest){
	if (copy($src,$dest)){
		$phar=new PharData($dest);
		$phar=$phar->decompress();
		$f2=str_replace('.gz','',$dest);
		$phar2=new PharData($f2, RecursiveDirectoryIterator::SKIP_DOTS);
		$phar2=$phar2->extractTo(".",null,true);
		unlink($dest);
		unlink($f2);
		$ok=true;
	}else{
		$ok=false;
	}
	return($ok);
}


# config local app
function sysconfig(){
	echo("Conf");
}


# download and set app from web
function sysinstall(){
	global $SOURCE_PACKAGE,$verfile,
		$L_ERROR_COPY,$L_ERROR_INDEX,$L_START_APP,$L_START_BUTTON,
		$L_BUTTON_END,$L_INSTALL_OK;

	$lf=basename($SOURCE_PACKAGE);
	if (cpdecomp($SOURCE_PACKAGE,$lf)){
		$f=basename($_SERVER['PHP_SELF']);
		#unlink($f);
		$d=date('Ymd');
		file_put_contents($verfile, $d);
		$f="";
		if (file_exists("index.html")){
			$f="index.html";
		}else{
			if (file_exists("index.php")){
				$f="index.php";
			}
		}
		echo("<div class=spaceline></div>");
		if ($f<>""){
			echo("<p>$L_INSTALL_OK</p>");
			echo("<p>$L_START_APP</p>");
			echo("<div class=spaceline50></div>");
			echo("<a href=$f>");
			echo("<button class=card-button>");
			echo("$L_START_BUTTON");
			echo("</button></a>");
		}else{
			echo("<p>$L_ERROR_INDEX</p>");
		}
	}else{
		echo("<p>$L_ERROR_COPY</p>");
	}
	echo("<div class=spaceline25></div>");
	echo("<a onclick='document.location.href=\"/\";return false;' >");
	echo("<button class=card-button>$L_BUTTON_END</button>");
	echo("</a>");
}


# get remote file last modified date
function file_time($url) {
    $ch = curl_init($url);

     curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
     curl_setopt($ch, CURLOPT_HEADER, TRUE);
     curl_setopt($ch, CURLOPT_NOBODY, TRUE);
     curl_setopt($ch, CURLOPT_FILETIME, TRUE);

     $data = curl_exec($ch);
     $filetime = curl_getinfo($ch, CURLINFO_FILETIME);

     curl_close($ch);

     return $filetime;
}


# download and update app from web
function sysupdate(){
	global $SOURCE_PACKAGE,$verfile,$sysconfig,
		$L_ERROR_COPY,$L_ERROR_INDEX,$L_UPDATE_NO,$L_UPDATE_OK,
		$L_BUTTON_END,$L_START_APP,$L_START_BUTTON,
		$L_UPDATE_OLD,$L_UPDATE_NEW,
		$L_UPDTAE_OLD,$L_UPDATE_NEW,
		$L_BUTTON_CONFIG;

	$ver=file_get_contents($verfile);
	$newver=file_time($SOURCE_PACKAGE);
	$newver=date("Ymd",$newver);
	echo("$L_UPDATE_OLD: $ver - $L_UPDATE_NEW: $newver");
	echo("<div class=spaceline50></div>");
	if ($newver>$ver){
		copy($verfile,$verfile.".old");
		if (file_exists($sysconfig)){
			copy($sysconfig,$sysconfig.".old");
		}
		$lf=basename($SOURCE_PACKAGE);
		if (cpdecomp($SOURCE_PACKAGE,$lf)){
			file_put_contents($verfile, $newver);
		}
		echo("<p>$L_UPDATE_OK</p>");
	}else{
		echo("<p>$L_UPDATE_NO</p>");
	}
	$f="";
	if (file_exists("index.html")){
		$f="index.html";
	}else{
		if (file_exists("index.php")){
			$f="index.php";
		}
	}
	echo("<div class=spaceline></div>");
	if ($f<>""){
		echo("<p>$L_START_APP</p>");
		echo("<div class=spaceline50></div>");
		if (file_exists($sysconfig.".old")){
			echo("<a href=\"../$f\">");
			echo("<button class=card-button>");
			echo("$L_BUTTON_CONFIG");
			echo("</button></a>");
		}
		echo("<a href=\"../$f\">");
		echo("<button class=card-button>");
		echo("$L_START_BUTTON");
		echo("</button></a>");
	}else{
		echo("<p>$L_ERROR_INDEX</p>");
		echo("<div class=spaceline25></div>");
		echo("<a onclick='document.location.href=\"/\";return false;' >");
		echo("<button class=card-button>$L_BUTTON_END</button>");
		echo("</a>");
	}
}


######################################################################

# select function

$verfile=$AM_VERSION_DIR."/".$AM_VERSION_FILE;
$sysconfig=$AM_SYSCONFIG_DIR."/".$AM_SYSCONFIG_FILE;

chdir("..");
if (isset($CONFIGFILE)){
	sysconfig();
}else{
	if (!file_exists($verfile)){
		sysinstall();
	}else{
		sysupdate();
	}
}


?>

				</div>
			</div>
		</div>
	</div>
<footer>
	<ul class="sidenav">
		<li class="padleft"><?php echo($AM_COPYRIGHT); ?></li>
	</ul>
</footer>
</body>
</html>
