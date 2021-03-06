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
	$day="0";
}
$activebutton=array('','','','');
$activebutton[$day]='style=\'color:black;\'';

if (!empty($_GET[$NVR_DEL_TAG])) {
	$del=$_GET[$NVR_DEL_TAG];
	if (file_exists($del)){
		if (!unlink($del)){
			echo("<div class=errorbar>$L_ERROR: $del</div>");
		}
	}
} else {
	$del="";
}

$daymenu=true;
$aktdir=$NVR_DIR;
if ($day==$NVR_STORE_DIR){
	$aktdir=$aktdir."/".$NVR_STORE_DIR;
	$daymenu=false;
	$thispage=$L_DAYS[0];
}else{
	if ($day<>"0") {
		$aktdir=$aktdir."/".$NVR_DIR_DAYS[$day];
		$thispage=$L_DAYS[$day];
	}else{
		$thispage=$L_DAYS[0];
	}
}


function filetable($dir){
	global $NVR_FILEEXT,$L_DOWNLOAD_TEXT,$L_TABLE,$NVR_VIDEO_PLAYER,$NVR_TAG,
			$NVR_DEL_TAG,$NVR_DELETE,$NVR_DAY_TAG,$day,
			$L_PLAYER,$L_DOWNLOAD,$L_DELETE,$L_FILTER,$L_STORE,$daymenu;

	$files=scandir($dir,SCANDIR_SORT_DESCENDING);
	usort($files, function ($a, $b){
		$s1=strtotime(substr($b,strlen($b)-12,8));
		$s2=strtotime(substr($a,strlen($a)-12,8));
		return  $s1-$s2;
	});
	if (!$daymenu){
		$fil=$L_FILTER." - ".$L_STORE;
	}else{
		$fil=$L_FILTER;
	}
	echo("<div class=filter>");
	echo('<input type="text" placeholder=\''.$fil.'\' id="filterin" autofocus
			onkeyup="tfilter(\'filterin\')"
			onclick="this.value=\'\'">');
	echo("</div>");
	echo("<table class='df_table_full' id='ktable'>");
	echo("<tr class='df_trh'>");
	echo("<th class='df_th1'>$L_TABLE[0]</th>");
	echo("<th class='df_th2'>$L_TABLE[1]</th>");
	echo("<th class='df_th2'>$L_TABLE[2]</th>");
	echo("<th class='df_th2'>$L_TABLE[3]</th>");
	echo("</tr>");
	foreach ($files as $entry) {
		if ($entry!="." && $entry!=".." && $entry!="lost+found") {
			$fileext=explode('.',$entry);
			$fileext_name=$fileext[count($fileext)-1];
			$fileext_name2='.'.$fileext_name;
			if ((in_array($fileext_name, $NVR_FILEEXT))or(in_array($fileext_name2, $NVR_FILEEXT))){
				echo("<tr class='df_tr'>");
				$fileext_name=strtoupper($fileext_name);
				echo("<td class='df_td'>");
				echo("$entry");
				echo("</td>");
				echo("<td class='df_td2'>");
				echo("<a href='$NVR_DELETE?$NVR_DAY_TAG=$day&$NVR_TAG=$dir/$entry' class='df_tda2'>$L_DELETE</a>");
				echo("</td>");
				echo("<td class='df_td2'>");
				echo("<a href='$dir/$entry' download class='df_tda2'>$L_DOWNLOAD</a>");
				echo("</td>");
				echo("<td class='df_td2'>");
				echo("<a href='$NVR_VIDEO_PLAYER?$NVR_DAY_TAG=$day&$NVR_TAG=$dir/$entry' class='df_tda2''>$L_PLAYER</a>");
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
		<li class="padleft"><a href='<?php echo($NVR_PRG); ?>'><?php echo("$L_APPNAME - $L_FILES"); ?></a></li>
		<li class="padleft"><a href='<?php echo($NVR_PRG); ?>'><?php echo("$thispage"); ?></a></li>
		<li class="padleft"><a href="<?php echo($NVR_SERV_FILE); ?>"><?php echo("$L_SERVICES"); ?></a></li>
		<li class="padleft"><a href='<?php echo("$NVR_PRG?$NVR_DAY_TAG=$NVR_STORE_DIR"); ?>'><?php echo("$L_STORE"); ?></a></li>
		<?php if (!empty($NVR_LIVE_URL)){ ?>
			<li class="padleft"><a href='<?php echo("$NVR_LIVE_URL"); ?>' target="_blank"><?php echo("$L_LIVE_VIEW"); ?></a></li>
		<?php } ?>
	</ul>
</header>
	<div class="content">

<?php
	if ($daymenu){
?>
	<div class=row>
		<div class=col4>
			<div class=space>
			<a href=<?php echo("$NVR_PRG"); ?> >
				<input type=submit id=submitar name=submitar value='<?php echo($L_DAYS[0]); ?>' <?php echo($activebutton[0]); ?> >
			</a>
			</div>
		</div>
		<div class=col4>
			<div class=space>
			<a href=<?php echo("$NVR_PRG?$NVR_DAY_TAG=$NVR_DIR_DAYS[1]"); ?> >
				<input type=submit id=submitar name=submitar value='<?php echo($L_DAYS[1]); ?>' <?php echo($activebutton[1]); ?> >
			</a>
			</div>
		</div>
		<div class=col4>
			<div class=space>
			<a href=<?php echo("$NVR_PRG?$NVR_DAY_TAG=$NVR_DIR_DAYS[2]"); ?> >
				<input type=submit id=submitar name=submitar value='<?php echo($L_DAYS[2]); ?>' <?php echo($activebutton[2]); ?> >
			</a>
			</div>
		</div>
		<div class=col4>
			<div class=space>
			<a href=<?php echo("$NVR_PRG?$NVR_DAY_TAG=$NVR_DIR_DAYS[3]"); ?> >
				<input type=submit id=submitar name=submitar value='<?php echo($L_DAYS[3]); ?>' <?php echo($activebutton[3]); ?> >
			</a>
			</div>
		</div>
	</div>

	<?php 
	}
	filetable($aktdir);
	?>

	</div>


<footer>
	<ul class="sidenav">
		<li class="padleft"><?php echo($NVR_COPYRIGHT); ?></li>
	</ul>
</footer>



<script>

function tfilter(inname) {
	var input, sfilter, table, tr, td, i;
	input = document.getElementById(inname);
	sfilter = input.value.toUpperCase();
	table = document.getElementById("ktable");
	tr = table.getElementsByTagName("tr");
	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[0];
		if (td) {
			if (td.innerHTML.toUpperCase().indexOf(sfilter) > -1) {
				tr[i].style.display = "";
			} else {
				tr[i].style.display = "none";
			}
		}
	}
}

</script>

</body>
</html>

<?php
?>
