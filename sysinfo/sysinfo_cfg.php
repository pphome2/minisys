<?php

 #
 # SysInfo - config
 #
 # info: main folder copyright file
 #
 #


# configuration

# copyright link
$SI_COPYRIGHT="© ".date("Y").". <a href=https://github.com/pphome2>Github</a>";

# title, home link
$SI_NAME="SysInfo";
# directories
$SI_CSS="sysinfo_w.css";

# page refresh time in seconds
$SI_REFRESH_TIME=60;

# log line search
$SI_LOG_SEARCH_BAD_LINES=4000;
$SI_LOG_SEARCH_NORMAL_LINES=200;

# language file
$SI_LANGFILE="sysinfo_hu.php";
if (file_exists($SI_LANGFILE)){
	include($SI_LANGFILE);
}

# log file
$SI_LOGFILES=array(
		array("$L_MESSAGES","l_mess.txt"),
		array("$L_APACHE","l_apache.txt"),
		array("$L_MARIADB","l_mariadb.txt"),
		array("$L_MAIL","l_mail.txt")
		);

?>
