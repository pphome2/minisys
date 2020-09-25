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


<?php



function vinput($d) {
	$d=trim($d);
	$d=stripslashes($d);
	$d=strip_tags($d);
	#$d=htmlspecialchars($d);
	return $d;
}

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
	global $sysconfig,$AM_SAVED_FILEEXT,$AM_COPY_OLDCONFIG,
		$L_DATA_SAVED,$L_DATA_OLD,$L_DATA_ERROR,
		$L_START_BUTTON,$L_SAVE_BUTTON,$L_CONFIG_NOFILE,
		$L_CONFIG,$L_NEWCONFIG;

	echo("<div class=\"card-header topleftmenu1\">$L_CONFIG</div>");
	echo("<div class=\"cardbody\" id=\"cardbodyf\"><div class=\"insidecontent\">");
	$olddata=array();
	if (file_exists($sysconfig)){
		$aktconf=explode(PHP_EOL,file_get_contents($sysconfig));
		$db=count($aktconf);
		if (isset($_POST["submitconf"])){
			$i=0;
			$y=0;
			$outl=array();
			foreach ($_POST as $key => $value) {
				if ($key<>"submitconf"){
					if ($i==0){
						$outl[$y]=$value;
						$i++;
					}else{
						if ($i==1){
							if (is_numeric($value)){
								$outl[$y].="=".$value.";";
							}else{
								$outl[$y].="=\"".$value."\";";
							}
							$i++;
						}else{
							$outl[$y].="#".$value.PHP_EOL;
							$y++;
							$i=0;
						}
					}
				}
			}
			echo("<div class=spaceline></div>");
			if (file_put_contents($sysconfig,$outl)){
				echo("<div class=message_ok>$L_DATA_SAVED</div>");
				$aktconf=explode(PHP_EOL,file_get_contents($sysconfig));
				$db=count($aktconf);
			}else{
				echo("<div class=message_error>$L_DATA_ERROR</div>");
			}
		}
		if (file_exists($sysconfig.$AM_SAVED_FILEEXT)){
			$oldconf=explode(PHP_EOL,file_get_contents($sysconfig.$AM_SAVED_FILEEXT));
			$d=date('Y.m.d.',filemtime($sysconfig.$AM_SAVED_FILEEXT));
			echo("<div class=spaceline></div>");
			echo("$L_DATA_OLD ($d)");
			echo("<div class=spaceline></div>");
			echo("<div class=row>");
			echo("<div class=col2><div class=textright>");
			$i=0;
			foreach($oldconf as $l){
				if ($l<>""){
					$label=explode("#",$l);
					$label[1]=vinput($label[1]);
					echo("$label[1]<br />");
				}
			}
			echo("</div></div>");
			echo("<div class=col2><div class=textleft>");
			$i=0;
			foreach($oldconf as $l){
				if ($l<>""){
					$label=explode("#",$l);
					$label[1]=vinput($label[1]);
					$data=explode("=",$label[0]);
					$data[1]=vinput($data[1]);
					if (substr($data[1],0,1)=="\""){
						$data[1]=substr($data[1],1,strlen($data[1])-3);
					}else{
						$data[1]=substr($data[1],0,strlen($data[1])-1);
					}
					$olddata[$i]=$data[1];
					$i++;
					echo("$data[1]<br />");
				}
			}
			echo("</div></div>");
			echo("</div>");
			echo("<div class=spaceline></div>");
		}
		echo("<div class=spaceline></div>");
		echo("$L_NEWCONFIG");
		echo("<div class=spaceline></div>");
		echo("<div class=row>");
		echo("<div class=colx>");
		echo("<form method=POST>");
		$i=0;
		$k=0;
		foreach($aktconf as $l){
			if ($l<>""){
				$label=explode("#",$l);
				$label[1]=vinput($label[1]);
				$data=explode("=",$label[0]);
				$data[1]=vinput($data[1]);
				if (substr($data[1],0,1)=="\""){
					$data[1]=substr($data[1],1,strlen($data[1])-3);
				}else{
					$data[1]=substr($data[1],0,strlen($data[1])-1);
				}
				echo("$label[1]");
				echo("<input id=\"$i-1\" name=\"$i-1\" type=hidden value=\"$data[0]\">");
				if ($AM_COPY_OLDCONFIG){
					$data[1]=$olddata[$k];
					$k++;
				}
				echo("<input id=\"$i-2\" name=\"$i-2\" type=text value=\"$data[1]\">");
				echo("<input id=\"$i-3\" name=\"$i-3\" type=hidden value=\"$label[1]\">");
				$i++;
			}
		}
		echo("<input type=submit id=submitconf name=submitconf value=\"$L_SAVE_BUTTON\">");
		echo("</form>");
		echo("</div></div>");
	}else{
		echo("<div class=spaceline></div>$L_CONFIG_NOFILE");
		echo("<div class=spaceline></div>");
	}
	$f="";
	if (file_exists("index.html")){
		$f="index.html";
	}else{
		if (file_exists("index.php")){
			$f="index.php";
		}
	}
	if ($f<>""){
		echo("<div class=spaceline25></div>");
		echo("<a href=\"../$f\">");
		echo("<button class=card-button>");
		echo("$L_START_BUTTON");
		echo("</button></a>");
	}
	echo("</div></div>");
}


# download and set app from web
function sysinstall(){
	global $SOURCE_PACKAGE,$verfile,$versiondata,$AM_SAVED_FILEEXT,
		$L_ERROR_COPY,$L_ERROR_INDEX,$L_START_APP,$L_START_BUTTON,
		$L_BUTTON_END,$L_INSTALL_OK,$L_INSTALL;

	echo("<div class=\"card-header topleftmenu1\">$L_INSTALL</div>");
	echo("<div class=\"cardbody\" id=\"cardbodyf\"><div class=\"insidecontent\">");
	$lf=basename($SOURCE_PACKAGE);
	if (cpdecomp($SOURCE_PACKAGE,$lf)){
		$f=basename($_SERVER['PHP_SELF']);
		#unlink($f);
		$d=date('Ymd');
		$versiondata[0]=$SOURCE_PACKAGE.PHP_EOL;
		$versiondata[1]=$d;
		file_put_contents($verfile, $versiondata);
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
	echo("</div></div>");
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
	global $SOURCE_PACKAGE,$verfile,$sysconfig,$versiondata,
		$L_ERROR_COPY,$L_ERROR_INDEX,$L_UPDATE_NO,$L_UPDATE_OK,
		$L_BUTTON_END,$L_START_APP,$L_START_BUTTON,
		$L_UPDATE_OLD,$L_UPDATE_NEW,$AM_SAVED_FILEEXT,
		$L_UPDTAE_OLD,$L_UPDATE_NEW,$L_UPDATE,
		$L_BUTTON_CONFIG,$AM_APPMAN_CONFIG;

	echo("<div class=\"card-header topleftmenu1\">$L_UPDATE</div>");
	echo("<div class=\"cardbody\" id=\"cardbodyf\"><div class=\"insidecontent\">");
	$newver=file_time($SOURCE_PACKAGE);
	$newver=date("Ymd",$newver);
	echo("$L_UPDATE_OLD: $versiondata[1] - $L_UPDATE_NEW: $newver");
	echo("<div class=spaceline50></div>");
	if ($newver>$versiondata[1]){
		copy($verfile,$verfile.$AM_SAVED_FILEEXT);
		if (file_exists($sysconfig)){
			copy($sysconfig,$sysconfig.$AM_SAVED_FILEEXT);
		}
		$lf=basename($SOURCE_PACKAGE);
		if (cpdecomp($SOURCE_PACKAGE,$lf)){
			$versiondata[0]=$versiondata[0].PHP_EOL;
			$versiondata[1]=$newver;
			file_put_contents($verfile, $versiondata);
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
		if (file_exists($sysconfig.$AM_SAVED_FILEEXT)){
			echo("<a href=\"$AM_APPMAN_CONFIG\">");
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
	echo("</div></div>");
}


######################################################################

# select and start function

$verfile=$AM_VERSION_DIR."/".$AM_VERSION_FILE;
$sysconfig=$AM_SYSCONFIG_DIR."/".$AM_SYSCONFIG_FILE;
$versiondata=array();
chdir("..");

if (isset($CONFIGFILE)){
	sysconfig();
}else{
	if (!file_exists($verfile)){
		sysinstall();
	}else{
		$versiondata=explode(PHP_EOL,file_get_contents($verfile));
		$SOURCE_PACKAGE=$versiondata[0];
		sysupdate();
	}
}



?>

		</div>
	</div>
<footer>
	<ul class="sidenav">
		<li class="padleft"><?php echo($AM_COPYRIGHT); ?></li>
	</ul>
</footer>
</body>
</html>
