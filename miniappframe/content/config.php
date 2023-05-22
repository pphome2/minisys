<?php
 #
 # MiniApps
 #
 # info: main folder copyright file
 #
 #

# configuration
$MA_COPYRIGHT="© ".date("Y").". <a href=https://google.com>Google</a>";

# title, home link
$MA_SITENAME="IDemo";
$MA_TITLE="IDemo";
$MA_CODENAME="ko";
$MA_ROOT_HOME="http://10.16.1.249";
$MA_ROOT_NAME="Intranet";
$MA_SITE_HOME="";
$MA_FAVICON="favicon.png";

# plugins directorys (load dirname.php .css, .js from directory)
$MA_PLUGINS=array();

# language
$MA_LANGFILE="hu.php";

# local app main and css file
$MA_APPFILE=array("$MA_LANGFILE",
                "dcfg.php",
                "d.php"
            );
$MA_APPCSSFILE=array("d.css");
$MA_APPJSFILE=array("d.js");
$MA_APPPRIVACYFILE="privacy.txt";

# SQL
$MA_SQL_SERVER="";
$MA_SQL_DB="";
$MA_SQL_USER="";
$MA_SQL_PASS="";

?>
