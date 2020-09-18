<?php

 #
 # MiniSys - backup app
 #
 # info: main folder copyright file
 #
 #

$COPYRIGHT="© 2019. <a href=https://github.com/pphome2/minisys>MiniSys</a>";
$MS_SITENAME="MiniSys - Backup";


# start app/site after install
$MS_SITE_HOME="sys_main.php";

define('DS', DIRECTORY_SEPARATOR);

$MS_APP_DIR=".";

$L_SITENAME="Teszt backup";

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


	# start backup
	if (isset($_POST["submitbackup"])){
		$startpage=false;
		include($MS_FILE);
		include($MS_FILE2);
		if ((isset($SQL_SERVER))and(isset($SQL_DB))and(isset($SQL_USER))and(isset($SQL_PASSWORD))){
			set_time_limit(3000);
			$mysqli=new mysqli($SQL_SERVER,$SQL_USER,$SQL_PASSWORD);
			$mysqli->query("CREATE DATABASE IF NOT EXISTS $SQL_DB");
			$mysqli->select_db($SQL_DB);
			$mysqli->query("SET NAMES 'utf8'");
			$queryTables=$mysqli->query('SHOW TABLES');
			while($row=$queryTables->fetch_row()) {
				$target_tables[]=$row[0];				}
			$content="SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\n";
			$content.="SET time_zone = \"+00:00\";\r\n\r\n\r\n";
			$content.="/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n";
			$content.="/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n";
			$content.="/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n";
			$content.="/*!40101 SET NAMES utf8 */;\r\n";
			$content.="--\r\n-- Database: `".$SQL_DB."`\r\n--\r\n\r\n\r\n";
			foreach($target_tables as $table){
				if (empty($table)){
					continue;
				}
				$result=$mysqli->query('SELECT * FROM `'.$table.'`');
				$fields_amount=$result->field_count;
				$rows_num=$mysqli->affected_rows;
				$res=$mysqli->query('SHOW CREATE TABLE '.$table);
				$tablel=$res->fetch_row();
				$tablel[1]=str_ireplace('CREATE TABLE `','CREATE TABLE IF NOT EXISTS `',$tablel[1]);
				$content.="\n\n".$tablel[1].";\n\n";
				$content.="\n\n"."TRUNCATE TABLE `$table`".";\n\n";
				for ($i=0,$st_counter=0;$i<$fields_amount;$i++,$st_counter=0) {
					while($row = $result->fetch_row()) {
						//when started (and every after 100 command cycle):
						if ($st_counter%100 == 0 || $st_counter == 0 ){
							$content.="\nINSERT INTO ".$table." VALUES";
						}
						$content.="\n(";
						for($j=0;$j<$fields_amount;$j++){
							$row[$j]=str_replace("\n","\\n", addslashes($row[$j]) );
							if (isset($row[$j])){
								$content.='"'.$row[$j].'"' ;
							}else{
								$content.='""';
							}
							if ($j<($fields_amount-1)){
								$content.= ',';
							}
						}
						$content.=")";
						//every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
						if ((($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) {
							$content .= ";";
						}else{
							$content .= ",";
						}
						$st_counter=$st_counter+1;
					}
				}
				$content.="\n\n\n";
			}
			$content.="\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n";
			$content.="/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n";
			$content.="/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
			$backup_name=$SQL_DB.'_'.date('Ymd').'_'.date('His').'.sql';

			$fn=fopen($backup_name,"w");
			fwrite($fn,$content.PHP_EOL);
			fclose($fn);

			# pack system
			$backup_fname='backup_'.date('Ymd').'_'.date('His');
			$phar=new PharData($backup_fname.".tar");
			$phar->buildFromDirectory($MS_SYSTEM_ROOT);
			$phar2=new PharData($backup_fname.".tar");
			$phar2=$phar2->compress(Phar::GZ);
			unlink($backup_fname.".tar");

			# backup screen
			echo("<div class=spaceline></div>");
			echo("<div class=spaceline></div>");
			echo("$L_ENDSCREEN_MESSAGE");
			echo("<div class=spaceline></div>");
			echo("<div class=spaceline></div>");
			echo("<div class=spaceline></div>");
			echo("<div class=spaceline></div>");
			echo("$L_DOWNLOAD");
			echo("<div class=spaceline></div>");
			echo("<center><a class='fdown air' href=$backup_name>$backup_name</a>");
			echo("<a class='fdown air' href='$backup_fname.tar.gz'>$backup_fname.tar.gz</a></center>");
			echo("<div class=spaceline></div>");
			echo("<div class=spaceline></div>");

		}else{
			echo("<div class=spaceline></div>");
			echo("<div class=spaceline></div>");
			echo("$L_SQLCONFIG_ERROR");
			echo("<div class=spaceline></div>");
			echo("<div class=spaceline></div>");
		}

		echo("<a href='$MS_SITE_HOME'><input class='inputsubmit' type='submit' id='submitc' name='submitc' value='$L_BUTTON_END'></a>");

	}

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

		echo("<form action=$scriptname id=0 method=\"post\" enctype=\"multipart/form-data\">");
		echo("	<input class='inputsubmit' type='submit' id='submitbackup' name='submitbackup' value='$L_BUTTON_SAVE'>");
		$f1=glob("*.tar.gz");
		$f2=glob("*.sql");
		if ((count($f1)>0)or(count($f2)>0)){
			echo("<div class=spaceline></div>");
			echo("<div class=spaceline></div>");
			echo("	<input class='inputsubmit red' type='submit' id='submitclean' name='submitclean' value='$L_BUTTON_CLEAN'>");
			echo("</form>");
		}
	}
}


echo($SYS_FOOTER);

?>

