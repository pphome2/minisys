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

header("Refresh:$SI_REFRESH_TIME");

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

		<div class="card-header topleftmenu1"><?php echo($L_SERVERINFO); ?></div>
		<div class="cardbody" id="cardbodyf"><div class="insidecontent">


<?php

function vinput($d) {
	$d=trim($d);
	$d=stripslashes($d);
	$d=strip_tags($d);
	#$d=htmlspecialchars($d);
	return $d;
}


function formatBytes($size, $precision=2){
	if($size < 0) {
		$size=$size + PHP_INT_MAX + PHP_INT_MAX + 2;
	}
	$base=log($size, 1024);
	$suffixes=array('b', 'Kb', 'Mb', 'Gb', 'Tb','Pb');
	return round(pow(1024,$base-floor($base)),$precision).' '.$suffixes[floor($base)];
}


######################################################################

# select and start function


	echo("<table class=\"tablecl\">");

	echo("<tr><td class=td1>$L_SERVERTIME</td><td class=td2>");
	$s=date('Y. m. d. H:i');
	echo($s);
	echo("</td></tr>");

	echo("<tr><td class=td1>$L_CPU</td><td class=td2>");
	$out=trim(shell_exec("grep -P 'model name' /proc/cpuinfo"));
	$out2=explode(PHP_EOL,$out);
	$out2=explode(":",$out2[0]);
	echo($out2[1]);
	echo("</td></tr>");

	echo("<tr><td class=td1>$L_CPU2</td><td class=td2>");
	$loads=sys_getloadavg();
	$core_nums=trim(shell_exec("grep -P '^processor' /proc/cpuinfo|wc -l"));
	$load=round($loads[0]/($core_nums)*100,2);
	echo("$load %  ($core_nums $L_CORE)");
	echo("</td></tr>");

	echo("<tr><td class=td1>$L_MEMORY</td><td class=td2>");
	$free=shell_exec('free -b');
	$free=(string)trim($free);
	$free_arr=explode("\n",$free);
	$mem=explode(" ",$free_arr[1]);
	$mem=array_filter($mem);
	$mem=array_merge($mem);
	$perc=round($mem[1]/100,0);
	$perc=round($mem[3]/$perc,0);
	echo("$L_ALL: ".formatBytes($mem[1])." - $L_FREE: ".formatBytes($mem[3])." ($perc%)");
	echo("</td></tr>");

	echo("<tr><td class=td1>$L_DISK</td><td class=td2>");
	$dt=disk_total_space('/');
	$df=disk_free_space('/');
	$perc=round($dt/100,0);
	$perc=round($df/$perc,0);
	echo("$L_ALL: ".formatBytes($dt)." - $L_FREE: ".formatBytes($df)." ($perc%)");
	echo("</td></tr>");

	echo("<tr><td class=td1>$L_UPTIME</td><td class=td2>");
	#echo(shell_exec("uptime -p"));
	$str=@file_get_contents('/proc/uptime');
	$num=floatval($str);
	$secs=fmod($num,60);
	$num=intdiv($num,60);
	$min =$num%60;
	$num=intdiv($num,60);
	$hours=$num%24;
	$num=intdiv($num,24);
	$days=$num;
	echo("$days $L_DAY, $hours $L_HOUR, $min $L_MINUTE");
	echo("</td></tr>");

	echo("<tr><td class=td1>$L_OS</td><td class=td2>");
	echo(php_uname('s')." ".php_uname('n')." ".php_uname('r')." ".php_uname('m'));
	echo("</td></tr>");

	echo("<tr><td class=td1>$L_WEBSERVER</td><td class=td2>");
	echo(apache_get_version());
	echo("</td></tr>");

	echo("<tr><td class=td1>$L_PHP</td><td class=td2>");
	echo(PHP_VERSION);
	echo("</td></tr>");

	echo("<tr><td class=td1>$L_SQL</td><td class=td2>");
	$output=shell_exec('mysql -V'); 
	preg_match('@[0-9]+\.[0-9]+\.[0-9]+@',$output,$version);
	$v=explode(',',$output);
	echo($v[0]);
	echo("</td></tr>");

	if (file_exists($SI_OTHER_SYSTEM_DATA_FILE)){
		echo("<tr><td class=td1>$L_SYSOTHER</td><td class=td2>");
		$output=file_get_contents($SI_OTHER_SYSTEM_DATA_FILE);
		$out=explode(PHP_EOL,$output);
		foreach($out as $l){
			if (!empty($l)){
				echo($l."<br />");
			}
		}
	}
	echo("</td></tr>");

	echo("</table>");

	echo("</div>");
	echo("</div>");
	echo("</div>");

	foreach($SI_LOGFILES as $log){
		echo("<div class='card'>");
		echo("<div class='card-header topleftmenu1'>$log[0]</div>");
		echo("<div class='cardbody' id='cardbodyf'><div class='insidecontent2'>");
		for ($i=1;$i<=3;$i++){
			switch($i){
				case 1:
					echo("<b>$L_ERROR</b><br />");
					$output=shell_exec('tail -'.$SI_LOG_SEARCH_BAD_LINES.' '.$log[1].' | grep -i \'fatal\|error\|critical\' ');
					break;
				case 2:
					echo("<b>$L_WARNING</b><br />");
					$output=shell_exec('tail -'.$SI_LOG_SEARCH_BAD_LINES.' '.$log[1].' | grep -i \'warning\' ');
					break;
				case 3:
					echo("<b>$L_NORMAL</b><br />");
					$output=file_get_contents($log[1]);
					break;
				default:
					break;
			}
			$out=explode(PHP_EOL,$output);
			$out=array_reverse($out);
			$d="";
			foreach($out as $l){
				if ($l<>""){
					if ((substr($l,0,1)<>"[")and(substr($l,2,1)<>" ")){
						if ($d<>substr($l,0,6)){
							$d=substr($l,0,6);
							echo("<b>$d</b><br />");
						}
						$l=substr($l,6,strlen($l));
						if (!empty($l)){
							echo($l."<br />");
						}
					}else{
						echo($l."<br />");
					}
				}
			}
			echo("<br />");
		}
		echo("</div>");
		echo("</div>");
		echo("</div>");
	}
?>


	</div>
<footer>
	<ul class="sidenav">
		<li class="padleft"><?php echo($SI_COPYRIGHT); ?></li>
	</ul>
</footer>
</body>
</html>
