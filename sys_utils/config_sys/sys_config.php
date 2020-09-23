<?php

 #
 # MiniSys - config app
 #
 # info: main folder copyright file
 #
 #


$MS_APP_DIR=".";

$L_SITENAME="Teszt config";

include("$MS_APP_DIR/sys_ini.php");

echo($SYS_HEADER);

$scriptname=$_SERVER['PHP_SELF'];

if (!file_exists($MS_FILE)){
	echo("	$L_FILE_ERROR");
	echo("<div class=spaceline></div>");
	echo("<div class=spaceline></div>");
	echo("<a href='$MS_SITE_HOME'><input class='inputsubmit red' type='submit' id='submitconfx' name='submitconfx' value='$L_BUTTON_END'></a>");
}else{


	# config file save
	if (isset($_POST["submitconf"])){
		$filedata=array();
		#echo('<div class=text>');
		$i=0;
		$fn=fopen($MS_FILE,"w");
		fwrite($fn,"<?php".PHP_EOL);
		while(isset($_POST['x'.$i])){
			echo($_POST['l'.$i]." = \"");
			echo($_POST['d'.$i]."\"<br>");
			fwrite($fn,'$'.$_POST['x'.$i].'=');
			fwrite($fn,'"'.$_POST['d'.$i].'";');
			fwrite($fn,' # '.$_POST['l'.$i].PHP_EOL);
			$i++;
		}
		fwrite($fn,"?>".PHP_EOL);
		fclose($fn);
		#echo('</div>');
		$MS_DATA_SAVED=true;
		echo("<div class=spaceline></div>");
		echo("$L_SAVED_OK_MESSAGE");
		echo("<div class=spaceline></div>");
		echo("<div class=spaceline></div>");
		echo("$L_SAVED_MESSAGE");
		echo("<div class=spaceline></div>");
		echo("<div class=spaceline></div>");
		if ($MS_SQL_CONFIG){
			echo("<form action=$scriptname id=0 method=\"post\" enctype=\"multipart/form-data\">");
			echo("<input class='inputsubmit' type='submit' id='submitsql' name='submitsql' value='$L_BUTTON_SQL'>");
			echo("</form>");
		}
		echo("<a href='javascript:history.back()'><input class='inputsubmit red' type='submit' id='submit3' name='submit3' value='$L_BUTTON_BACK'></a>");
		echo("<div class=spaceline></div>");
		echo("<div class=spaceline></div>");
		echo("<a href='$MS_SITE_HOME'><input class='inputsubmit' type='submit' id='submitconfx' name='submitconfx' value='$L_BUTTON_END'></a>");
	}


	# SQL config start
	if (isset($_POST["submitsql"])){
		echo("<div class=spaceline></div>");
		$error="";
		if ((file_exists("$MS_FILE"))and(file_exists("$MS_SQL_CONFIG_SCRIPT_FILE"))){
			if (function_exists("mysqli_connect")){
				include($MS_FILE);
				include($MS_SQL_CONFIG_SCRIPT_FILE);
				// Test connection
				if ((isset($SQL_SERVER))and(isset($SQL_USER))and(isset($SQL_USER))and(isset($SQL_PASSWORD))and(isset($SQL_COMMAND))){
					if (isset($SQL_PORT)){
						$msqlconn=mysqli_connect($SQL_SERVER,$SQL_USER,$SQL_PASSWORD,$SQL_PORT);
					}else{
						$msqlconn=mysqli_connect($SQL_SERVER,$SQL_USER,$SQL_PASSWORD);
					}
					if (!$msqlconn) {
						echo($L_SQL_CONNECT_ERROR." " . mysqli_connect_error());
					}else{
						echo("$L_SQL_CONNECT_OK");
						#echo("<div class=spaceline></div>");
						$db=count($SQL_COMMAND);
						for($i=0;$i<$db;$i++){
							$result=mysqli_query($SQL_COMMAND[$i]);
							#echo("[".$SQL_COMMAND[$i]." ]<br />");
							$error=mysqli_error($msqlconn);
							if ($error<>"") {
								$i=$db;
							}
						}
						echo("<div class=spaceline></div>");
						if ($error<>""){
							echo($L_SQL_COMMAND_ERROR);
						}else{
							echo($L_SQL_COMMAND_OK);
						}
						mysqli_close($msqlconn);
					}
				}else{
					echo($L_SQL_CONFIG_ERROR);
				}
			}else{
				echo($L_SQL_NOSQL);
				echo("<div class=spaceline></div>");
			}
		}else{
			echo("$L_FILE_ERROR");
		}
		echo("<div class=spaceline></div>");
		echo("<a href='$MS_SITE_HOME'><input class='inputsubmit' type='submit' id='submitconfx' name='submitconfx' value='$L_BUTTON_END'></a>");
		if ($error<>""){
			echo("<a href='javascript:history.back()'><input class='inputsubmit red' type='submit' id='submit3' name='submit3' value='$L_BUTTON_BACK'></a>");
		}
	}else{


		# config file form create
		$i=0;
		$fn=fopen($MS_FILE,"r");
		while(!feof($fn)){
			$filedata[$i]=fgets($fn);
			$i++;
		}
		fclose($fn);
		if ($MS_DATA_SAVED){
			$readonly="readonly";
		}else{
			$readonly="";
			echo("<div class=spaceline></div>");
			echo("$L_CONFIG_MESSAGE");
		}
		echo("<div class=spaceline></div>");
		echo("<div class=spaceline></div>");
		echo("<form action=$scriptname id=0 method=\"post\" enctype=\"multipart/form-data\">");
		$i=0;
		foreach($filedata as $line){
			if (substr($line,0,1)=="$"){
				$line2=explode("#",$line);
				if (count($line2)>0){
					$l0=substr($line2[1],1,strlen($line2[1])-2);
				}
				$l=explode("=",$line2[0]);
				$l1=substr($l[0],1,strlen($l[0]));
				$l2=substr($l[1],1,strlen($l[1])-4);
				if ($l0==""){
					$l0=$l1;
				}
				if (!$MS_DATA_SAVED){
					echo('<div class=text>'.$l0.'</div>');
					echo("<input type=hidden id='l$i' name='l$i' value='$l0'>");
					echo("<input type=hidden id='x$i' name='x$i' value='$l1'>");
					echo("<input type=text id='d$i' name='d$i' $readonly value='$l2'><br>");
				}else{
					#echo('<div class=text>'.$l1.'</div>');
					#echo('<div class=text>'.$l2.'</div>');
				}
				$i++;
			}
		}
		echo("<div class=spaceline></div>");
		echo("<div class=spaceline></div>");
		if (!$MS_DATA_SAVED){
			echo("	<input class='inputsubmit' type='submit' id='submitconf' name='submitconf' value='$L_BUTTON_SAVE'>");
		}
		echo("</form>");
		echo("<a href='$MS_SITE_HOME'><input class='inputsubmit red' type='submit' id='submitc' name='submitc' value='$L_BUTTON_END'></a>");
	}
}


echo($SYS_FOOTER);

?>

