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


if (!empty($_GET[$NVR_DAY_TAG])) {
	$day=$_GET[$NVR_DAY_TAG];
} else {
	$day="-";
}

$aktdir=$NVR_DIR;
if ($day<>"-") {
	$aktdir=$aktdir."/".$NVR_DIR_DAYS[$day];
	$thispage=$L_DAYS[$day];
}else{
	$thispage=$L_DAYS[0];
}


function filetable($dir){
	global $NVR_FILEEXT,$L_DOWNLOAD_TEXT,$L_TABLE,$NVR_VIDEO_PLAYER,$NVR_TAG,$L_PLAYER,$L_DOWNLOAD;

	$files=scandir($dir,SCANDIR_SORT_DESCENDING);
	$fdb=0;
	echo("<table class='df_table_full'>");
	echo("<tr class='df_trh'>");
	echo("<th class='df_th1'>$L_TABLE[0]</th>");
	echo("<th class='df_th2'>$L_TABLE[1]</th>");
	echo("<th class='df_th2'>$L_TABLE[2]</th>");
	echo("</tr>");
	foreach ($files as $entry) {
		if ($entry!="." && $entry!=".." && $entry!="lost+found") {
			$fileext=explode('.',$entry);
			$fileext_name=$fileext[count($fileext)-1];
			$fileext_name2='.'.$fileext_name;
			if ((in_array($fileext_name, $NVR_FILEEXT))or(in_array($fileext_name2, $NVR_FILEEXT))){
				echo("<tr class='df_tr'>");
				$fileext_name=strtoupper($fileext_name);
				echo("<td class='df_td'><span class='df_tds'>[$fileext_name]</span> ");
				echo("<a href='$dir/$entry' target='$target' class='df_tda'>$entry</a>");
				echo("</td>");
				echo("<td class='df_td2'>");
				echo("<a href='$dir/$entry' download class='df_tda2' onclick='delrow(this);'>$L_DOWNLOAD</a>");
				echo("<td class='df_td2'>");
				echo("<a href='$NVR_VIDEO_PLAYER?$NVR_TAG=$dir/$entry' class='df_tda2' onclick='delrow(this);'>$L_PLAYER</a>");
				echo("</td>");
				echo("</tr>");
			}
		}
	}
	echo("</table>");
	echo("</center>");
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
		<li class="padleft"><a href="index.html"><?php echo("$L_APPNAME - $L_FILES"); ?></a></li>
		<li class="padleft"><a href="index.html"><?php echo("$thispage"); ?></a></li>
		<li class="padleft"><a href="nvr_serv.php"><?php echo("$L_SERVICES"); ?></a></li>
	</ul>
</header>
	<div class="content">


	<div class=row>
		<div class=col4>
			<div class=space>
			<a href=<?php echo("$NVR_PRG"); ?> >
				<input type=submit id=submitar name=submitar value='<?php echo($L_DAYS[0]); ?>' >
			</a>
			</div>
		</div>
		<div class=col4>
			<div class=space>
			<a href=<?php echo("$NVR_PRG?$NVR_DAY_TAG=$NVR_DIR_DAYS[1]"); ?> >
				<input type=submit id=submitar name=submitar value='<?php echo($L_DAYS[1]); ?>' >
			</a>
			</div>
		</div>
		<div class=col4>
			<div class=space>
			<a href=<?php echo("$NVR_PRG?$NVR_DAY_TAG=$NVR_DIR_DAYS[2]"); ?> >
				<input type=submit id=submitar name=submitar value='<?php echo($L_DAYS[2]); ?>' >
			</a>
			</div>
		</div>
		<div class=col4>
			<div class=space>
			<a href=<?php echo("$NVR_PRG?$NVR_DAY_TAG=$NVR_DIR_DAYS[3]"); ?> >
				<input type=submit id=submitar name=submitar value='<?php echo($L_DAYS[3]); ?>' >
			</a>
			</div>
		</div>
	</div>

	<?php filetable($aktdir); ?>

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
