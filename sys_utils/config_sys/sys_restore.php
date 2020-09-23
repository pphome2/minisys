<?php

 #
 # MiniSys - restore app
 #
 # info: main folder copyright file
 #
 #



$MS_APP_DIR=".";

$L_SITENAME="Teszt restore";

include("$MS_APP_DIR/sys_ini.php");

echo($SYS_HEADER);

$scriptname=$_SERVER['PHP_SELF'];
$startpage=true;

if ((!file_exists($MS_FILE))or(!file_exists($MS_FILE2))){
	echo("$L_FILE_ERROR");
	echo("<div class=spaceline></div>");
	echo("<div class=spaceline></div>");
	echo("<a href='$MS_SITE_HOME'><input class='inputsubmit red' type='submit' id='submitconfx' name='submitconfx' value='$L_BUTTON_END'></a>");
}else{


	# start restore
	if (isset($_POST["submitrestore"])){
		$startpage=false;
		include($MS_FILE);
		include($MS_FILE2);

		$allok=false;
		if (isset($_POST["filename"])){
			$filename=$MS_APP_DIR.DS.$_POST["filename"];
			if (file_exists($filename)){
				if (substr($filename,strlen($filename)-4,4)==".sql"){
					$farray=array();

					$fn=fopen($filename,"r");
					$db=0;
					while (!feof($fn)) {
						$farray[$db].=fgets($fn);
						if ((substr($farray[$db],strlen($farray[$db])-3,1)==";")or(substr($farray[$db],strlen($farray[$db])-3,1)=="-")){
							$db++;
						}
					}
					fclose($fn);

					#echo("$filename");
					if ((isset($SQL_SERVER))and(isset($SQL_DB))and(isset($SQL_USER))and(isset($SQL_PASSWORD))){
						set_time_limit(300);
						$mysqli=new mysqli($SQL_SERVER,$SQL_USER,$SQL_PASSWORD);
					echo("$filename");
						$mysqli->query("CREATE DATABASE IF NOT EXISTS $SQL_DB");
						$mysqli->select_db($SQL_DB);
						for($i=0;$i<$db;$i++){
							$res=$mysqli->query("$farray[$i]");
							echo($mysqli->error);
						}
						$mysqli->close;
						$allok=true;
					}else{
						echo("<div class=spaceline></div>");
						echo("<div class=spaceline></div>");
						echo("$L_SQLCONFIG_ERROR");
						echo("<div class=spaceline></div>");
						echo("<div class=spaceline></div>");
					}
				}else{
					$filename2=str_replace('.gz','',$filename);
					if (file_exists($filename2)){
						unlink($filename2);
					}
					$phar=new PharData($filename);
					$phar=$phar->decompress();
					$phar2=new PharData($filename2, RecursiveDirectoryIterator::SKIP_DOTS);
					$phar2=$phar2->extractTo($MS_SYSTEM_ROOT,null,true);
					if (file_exists($filename2)){
						unlink($filename2);
					}
					$allok=true;
				}
			}
			if ($allok){
				# restore screen
				echo("<div class=spaceline></div>");
				echo("<div class=spaceline></div>");
				echo("$L_ENDSCREEN_RESTMESSAGE");
				echo("<div class=spaceline></div>");
				echo("<div class=spaceline></div>");
			}
		}else{
			echo("<div class=spaceline></div>");
			echo("<div class=spaceline></div>");
			echo("$L_FILE_ERROR");
			echo("<div class=spaceline></div>");
			echo("<div class=spaceline></div>");
		}

		echo("<div style=\"width:100%;text-align:center;\">");
		echo("<a href='javascript:history.back()'><input class='inputsubmit red air inputsubmit40' type='submit' id='submitstart3' name='submitstart3' value='$L_BUTTON_RESTBACK'></a>");
		echo("<a href='$MS_SITE_HOME'><input class='inputsubmit air inputsubmit40' type='submit' id='submitc' name='submitc' value='$L_BUTTON_END'></a>");
		echo("</div>");


	}


	# upload file
	if (isset($_POST["submitupload"])){
		$startpage=true;
		$ok=true;
		$target_file=basename($_FILES["fileup"]["name"]);
		// Check if file already exists
		if (file_exists($target_file)) {
			unlink($target_file);
		}
		// Check file size
		if ($_FILES["fileup"]["size"] > 500000){
			$ok=false;
		}
		if ($ok){
			if (move_uploaded_file($_FILES["fileup"]["tmp_name"], $target_file)){
				echo("$L_FILE_UPLOAD_OK ( ". basename( $_FILES["fileup"]["name"])." )");
			}else{
				echo($L_FILE_UPLOAD_ERROR);
			}
		}else{
			echo($L_FILE_UPLOAD_ERROR);
		}
	}


	# clean (delete old saved files)
	if (isset($_POST["submitclean"])){

		# clean (delete old saved files)
		foreach (glob("*.tar.gz") as $filename) {
			unlink($filename);
		}
		foreach (glob("*.sql") as $filename) {
			unlink($filename);
		}
		$startpage=true;
	}

	if ($startpage){

		# start screen
		echo("<div class=spaceline></div>");
		echo("<div class=spaceline></div>");
		echo("$L_STARTSCREEN_MESSAGE");
		echo("<div class=spaceline></div>");
		echo("<div class=spaceline></div>");
		$f1=glob("*.tar.gz");
		$f2=glob("*.sql");
		echo("<table>");
		echo("<tr><th width=60%>");
		echo("</th><th>");
		echo("<div style=\"width:100%;margin-top:50px;text-align:center;\">");
		echo("<form action=$scriptname id=1 method=\"post\" enctype=\"multipart/form-data\">");
		echo("	<label class='fileselect inputsubmit'>");
		echo("		$L_BUTTON_UPLOAD_SELECT_FILE ");
		echo("		<input class='inputsubmit' id='fileup' name='fileup' type='file' accept='.tar.gz, .sql' onchange=\"document.getElementById('submitupload').click();\"/>");
		echo("	</label>");
		echo("	<input class='inputsubmit' style='visibility:hidden;' type='submit' id='submitupload' name='submitupload' value='$L_BUTTON_UPLOAD'>");
		echo("</form>");
		echo("</div>");
		echo("</th></tr>");
		$i=100;
		foreach ($f1 as $filename) {
			$i++;
			echo("<tr><td>");
			echo($filename);
			echo("</td><td>");
			echo("<form action=$scriptname id=$i method=\"post\" enctype=\"multipart/form-data\">");
			echo("	<input type='hidden' id='filename' name='filename' value='$filename'>");
			echo("	<input class='inputsubmit' type='submit' id='submitrestore' name='submitrestore' value='$L_BUTTON_RESTORE'>");
			echo("</form>");
			echo("</td></tr>");
		}
		foreach ($f2 as $filename) {
			$i++;
			echo("<tr><td>");
			echo($filename);
			echo("</td><td>");
			echo("<form action=$scriptname id=$i method=\"post\" enctype=\"multipart/form-data\">");
			echo("	<input type='hidden' id='filename' name='filename' value='$filename'>");
			echo("	<input class='inputsubmit' type='submit' id='submitrestore' name='submitrestore' value='$L_BUTTON_RESTORE'>");
			echo("</form>");
			echo("</td></tr>");
		}
		echo("</table>");
		echo("<div class=spaceline></div>");
		echo("<div class=spaceline></div>");

		if ((count($f1)>0)or(count($f2)>0)){
			echo("<div class=spaceline></div>");
			echo("<div class=spaceline></div>");
			echo("<form action=$scriptname id=2 method=\"post\" enctype=\"multipart/form-data\">");
			echo("	<input class='inputsubmit red' type='submit' id='submitclean' name='submitclean' value='$L_BUTTON_CLEAN'>");
			echo("</form>");
		}
	echo("<div class=spaceline></div>");
	echo("<div class=spaceline></div>");
	echo("<a href='$MS_SITE_HOME'><input class='inputsubmit' type='submit' id='submitconfx' name='submitconfx' value='$L_BUTTON_END'></a>");
	}
}


echo($SYS_FOOTER);

?>

