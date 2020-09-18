<?php

 #
 # MiniSys - main ini file (variables, language, head, footer)
 #
 # info: main folder copyright file
 #
 #

$COPYRIGHT="© 2019. <a href=https://github.com/pphome2/minisys>MiniSys</a>";
$MS_SITENAME="MiniSys";

# start app/site after install
$MS_SITE_HOME="sys_main.php";

$MS_SITE_ROOT_HOME="../index.html";

define('DS', DIRECTORY_SEPARATOR);

$MS_CONFIG_DIR="../config";

$MS_FILE=$MS_CONFIG_DIR.DS."sconfig.php";
$MS_FILE2=$MS_CONFIG_DIR.DS."sql.php";

# sql.php set $SQL_ variable from system config...
# $SQL_SERVER=$MYSQL_SEhref=$MS_SITE_HOME RVER;
# $SQL_DB=$MYSQL_DATABASE;
# $SQL_USER=$MYSQL_USER;

$MS_SYSTEM_ROOT="..";


# apps
$MS_BACKUP_SYS=$MS_APP_DIR.DS."sys_backup.php";
$MS_RESTORE_SYS=$MS_APP_DIR.DS."sys_restore.php";
$MS_CONFIG_SYS=$MS_APP_DIR.DS."sys_config.php";

#$L_SITENAME="";

$MS_DATA_SAVED=false;

# lang: main
$L_BUTTON_END="Kilépés";
$L_BUTTON_RESTORE="Visszaállítás";
$L_BUTTON_BACKUP="Mentés";
$L_BUTTON_CONFIG="Konfiguráció módosítása";


# lang: restore
$L_BUTTON_END="Kilépés";
$L_BUTTON_RESTORE="Visszaállítás";
$L_BUTTON_CLEAN="Régi mentések törlése";
$L_BUTTON_UPLOAD="Mentésfájlok feltöltése";
$L_BUTTON_UPLOAD_SELECT_FILE="Fájl választás a feltöltéshez";
$L_BUTTON_BACK="Vissza";

$L_FILE_ERROR="Adatfájl nem található.";
$L_STARTSCREEN_MESSAGE="Visszaállítás korábbi mentésből.";
$L_ENDSCREEN_MESSAGE="Visszaállítás történt a rendszerről.";
$L_SQLCONFIG_ERROR="SQL beállítások  nem találhatók.";
$L_FILE_UPLOAD_OK="A fájl feltöltve.";
$L_FILE_UPLOAD_ERROR="A fájl feltöltése nem sikerült";
$L_FILE_ERROR="Fájlnév nem érvényes.";

# lang: backup
$L_BUTTON_END="Kilépés";
$L_BUTTON_SAVE="Mentés";
$L_BUTTON_CLEAN="Régi mentések törlése";

$L_FILE_ERROR="Adatfájl nem található.";
$L_STARTSCREEN_MESSAGE="Mentés készítése a rendszerről.";
$L_ENDSCREEN_MESSAGE="Mentés történt a rendszerről.";
$L_SQLCONFIG_ERROR="SQL beállítások  nem találhatók.";
$L_DOWNLOAD="Mentés letöltése:";

# lang: config
$L_BUTTON_SAVE="Mentés";
$L_BUTTON_END="Kilépés";
$L_BUTTON_BACK="Vissza, javítás";
$L_BUTTON_SQL="Tovább (SQL)";

$L_CONFIG_MESSAGE="Állítsa be a rendszer alapdatait.";
$L_SAVED_MESSAGE="Mentve az adatok.";
$L_FILE_ERROR="Adatfájl nem található.";
$L_SAVED_OK_MESSAGE="A mentés sikerült!";
$L_SQL_CONFIG_ERROR="Az SQL beállítások nem találhatóak.";
$L_SQL_CONNECT_ERROR="Az SQL kapcsolat nem sikerült. Hiba:";
$L_SQL_CONNECT_OK="Az SQL kapcsolat sikeres.";
$L_SQL_COMMAND_ERROR="Az SQL parancs(ok) végrehajtása nem sikerült.";
$L_SQL_COMMAND_OK="Az SQL parancs(ok) végrehajtása sikerült.";
$L_SQL_NOSQL="Az SQL elérés nem támogatotta rendszeren.";




$SYS_HEADER="
			<!DOCTYPE HTML>
			<html>
			<head>
				<title>$MS_SITENAME</title>
				<meta charset=\"utf-8\">
				<meta http-equiv=\"Content-Type\" content=\"text/html;charset=UTF-8\">
				<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />
				<link rel=\"icon\" href=\"$MS_APP_DIR/favicon.png\">
				<link rel=\"shortcut icon\" type=\"image/png\" href=\"$MS_APP_DIR/favicon.png\" />
				<link rel=\"stylesheet\" href=\"$MS_APP_DIR/style.css\">
			</head>

			<body>

			<div class=all-page>
			<header>
				<div class='menu'>
					<ul class='sidenav'>
						<li><a href=$MS_SITE_HOME class='active' style='cursor:pointer;1'>$L_SITENAME</a></li>
					</ul>
				</div>
			</header>
			<div class='content' id='content'>
			";



$SYS_FOOTER="
			</div>
			<footer>
				<ul class='sidenav'><li>$COPYRIGHT</li></ul>
			</footer>

			</div>
			</body>
			</html>
			";


?>

