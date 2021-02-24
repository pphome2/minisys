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


function file_del($all,$dir){
	global $NVR_FILEEXT;

	$r=true;
	if ($all){
		$files=scandir($dir);
		foreach ($files as $entry) {
			if ($entry!="." && $entry!=".." && $entry!="lost+found") {
				if (is_dir($dir."/".$entry)){
					$r=file_del(false,$dir."/".$entry);
				}
			}
		}
	}else{
		$files=scandir($dir);
		foreach ($files as $entry) {
			if ($entry!="." && $entry!=".." && $entry!="lost+found") {
				$fileext=explode('.',$entry);
				$fileext_name=$fileext[count($fileext)-1];
				$fileext_name2='.'.$fileext_name;
				if ((in_array($fileext_name, $NVR_FILEEXT))or(in_array($fileext_name2, $NVR_FILEEXT))){
					if (!unlink($dir."/".$entry)){
						echo("<div class=errorbar>$L_ERROR: $entry</div>");
						$r=false;
					}
				}
			}
		}
	}
	return($r);
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
		<li class="padleft"><a href='<?php echo($NVR_PRG); ?>'><?php echo("$L_APPNAME - $L_PLAYER"); ?></a></li>
		<li class="padleft"><a href='<?php echo($NVR_PRG); ?>'><?php echo("$L_DAYS[0]"); ?></a></li>
		<li class="padleft"><a href="<?php echo($NVR_SERV_FILE); ?>"><?php echo("$L_SERVICES"); ?></a></li>
		<li class="padleft"><a href='<?php echo("$NVR_PRG?$NVR_DAY_TAG=$NVR_STORE_DIR"); ?>'><?php echo("$L_STORE"); ?></a></li>
	</ul>
</header>
	<div class="content">


	<center>

<?php
	if (!empty($_GET[$NVR_SERV_TAG])){
		$f=$_GET[$NVR_SERV_TAG];
		switch ($f){
			case "1": 		# indító fájl a service-nek
				if (file_exists($NVR_DIR."/".$NVR_RUN_FILE)){
					if (!unlink($NVR_DIR."/".$NVR_RUN_FILE)){
						echo("<div class=errorbar>$L_ERROR: $NVR_RUN_FILE</div>");
					}
				}else{
					$str="1";
					if (!file_put_contents($NVR_DIR."/".$NVR_RUN_FILE,$str)){
						echo("<div class=errorbar>$L_ERROR: $NVR_RUN_FILE</div>");
					}
				}
				break;
			case "2":		# mai rögzítés törlése
				if (file_del(false,$NVR_DIR)){
						echo("<div class=infobar>$L_DELETE_OK</div>");
				}
				break;
			case "3":		# régebbi rögzítés törlése
				if (file_del(true,$NVR_DIR)){
						echo("<div class=infobar>$L_DELETE_OK</div>");
				}
				break;
			default:
				break;
		}
	}
	if (file_exists($NVR_DIR."/".$NVR_RUN_FILE)){
		$buttontext="$L_MOTION_START";
		$info=$L_MOTION_RUN;
	}else{
		$buttontext="$L_MOTION_STOP";
		$info=$L_MOTION_NORUN;
	}

	$of=$NVR_DIR."/".$NVR_TIME_FILE;
	if (isset($_POST["submittime"])){
		$db=count($L_TIME_DAYS);
		$out="";
		for ($i=0;$i<$db;$i++){
			$out=$out.$_POST["nap1$i"]."-";
			$out=$out.$_POST["nap2$i"]."-";
			if (isset($_POST["ej$i"])){
				$out=$out."X".PHP_EOL;
			}else{
				$out=$out."I".PHP_EOL;
			}
		}
		if ($out<>""){
			if (file_put_contents($of,$out)){
				echo("<div class=infobar>$L_TIME_SAVED</div>");
			}else{
				echo("<div class=errorbar>$L_ERROR</div>");
			}
		}else{
			echo("<div class=errorbar>$L_ERROR</div>");
		}
	}
	$timedata=array();
	if (file_exists($of)){
		$lines=file($of);
		for($i=0;$i<count($lines);$i++){
			$ol=explode("-",$lines[$i]);
			$timedata[$i][0]=$ol[0];
			$timedata[$i][1]=$ol[1];
			if (trim($ol[2])=="X"){
				$timedata[$i][2]="checked";
			}else{
				$timedata[$i][2]="";
			}
		}
	}else{
		for($i=0;$i<7;$i++){
			$timedata[$i][0]="06:00";
			$timedata[$i][1]="06:00";
			$timedata[$i][2]="";
		}
	}

?>

	<div class=insidecontent>
	<h1><?php echo($L_MOTION_HEAD); ?> </h1>
	<div class=center50>
			<p><?php echo($info); ?></p>
			<p><?php echo($L_MOTION_INFO); ?></p>
			<a href=?<?php echo($NVR_SERV_TAG."=1"); ?> >
				<input type=submit id=submitar name=submitar value='<?php echo($buttontext) ?>' >
			</a>

		<div class=spaceline></div>
		<div class=spaceline></div>
			<h2><?php echo($L_DELETE_INFO); ?></h2>
			<div class=row100>
			<div class=col2>
				<div class=spaceright>
				<a href=?<?php echo($NVR_SERV_TAG."=2"); ?> >
					<input type=submit id=submitar name=submitar value='<?php echo($L_DELETE_TODAY) ?>' >
				</a>
				</div>
			</div>
			<div class=col2>
				<div class=spaceleft>
				<a href=?<?php echo($NVR_SERV_TAG."=3"); ?> >
					<input type=submit id=submitar name=submitar value='<?php echo($L_DELETE_OLD) ?>' >
				</a>
				</div>
			</div>
			</div>

		<div class=spaceline></div>
		<div class=spaceline></div>
			<h2><?php echo($L_TIME_CONFIG); ?></h2>
			<p><?php echo($L_TIME_INFO); ?></p>
			<form class=formfull id="time" method=post>
				<table class=table id='ktable'>
					<tr class='df_trh'>
					<th class='df_th1'><?php echo($L_TIME_TABLE[0]); ?></th>
					<th class='df_th2'><?php echo($L_TIME_TABLE[1]); ?></th>
					<th class='df_th2'><?php echo($L_TIME_TABLE[2]); ?></th>
					<th class='df_th2'><?php echo($L_TIME_TABLE[3]); ?></th>
					</tr>
					<?php
					$db=count($L_TIME_DAYS);
					for ($i=0;$i<$db;$i++){
						?>
						<tr class="df_tr">
						<td class="df_td">
							<?php echo($L_TIME_DAYS[$i]); ?>
						</td>
						<td class="df_td">
							<input type=time id='nap1<?php echo($i); ?>' name='nap1<?php echo($i); ?>' min="00:00" max="23:50" step="60" value="<?php echo($timedata[$i][0]); ?>" >
						</td>
						<td class="df_td">
							<input type=time id='nap2<?php echo($i); ?>' name='nap2<?php echo($i); ?>' min="00:00" max="23:50" step="60" value="<?php echo($timedata[$i][1]); ?>" >
						</td>
						<td class="df_td">
							
							<input type=checkbox id='ej<?php echo($i); ?>' <?php echo($timedata[$i][2]); ?> name='ej<?php echo($i); ?>'  >
						</td>
						</tr>
					<?php } ?>
				</table>
				<input type=submit id=submittime name=submittime value='<?php echo($L_TIME_SAVE) ?>' >
			</form>
	</div>
	</div>

	<div class=spaceline></div>
	<div class=insidecontent>
	<div class=center50>
		<a href=<?php echo($NVR_PRG); ?> >
			<input type=submit id=submitar name=submitar value='<?php echo($L_BACKPAGE) ?>' >
		</a>
	</div>
	</div>

<?php

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
