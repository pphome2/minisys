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
$MA_APPFILE=array("$MA_CONFIG_DIR/$MA_LANGFILE",
                "$MA_CONTENT_DIR/$MA_LANGFILE",
                "$MA_CONTENT_DIR/dcfg.php",
                "$MA_CONTENT_DIR/d.php"
            );
$MA_APPCSSFILE=array("$MA_CONTENT_DIR/d.css");
$MA_APPJSFILE=array("$MA_CONTENT_DIR/d.js");
$MA_APPPRIVACYFILE="$MA_CONTENT_DIR/privacy.txt";

# SQL
$MA_SQL_SERVER="";
$MA_SQL_DB="";
$MA_SQL_USER="";
$MA_SQL_PASS="";

?>
