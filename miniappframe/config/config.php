<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #

# configuration

# copyright link
$MA_COPYRIGHT="© ".date("Y").". <a href=https://github.com/pphome2>Github</a>";

# title, home link
$MA_SITENAME="MiniApp";
$MA_TITLE="MiniApp";
$MA_CODENAME="mapp";
$MA_ROOT_HOME="https://google.com";
$MA_SITE_HOME="";
$MA_DOCTYPE="<!DOCTYPE HTML>";

# directories
$MA_CONFIG_DIR="config";
$MA_INCLUDE_DIR="inc";
$MA_CONTENT_DIR="content";
$MA_PLUGIN_DIR="plugins";

# cookie names
$MA_COOKIE_STYLE=$MA_CODENAME."st";
$MA_COOKIE_USER=$MA_CODENAME."u";
$MA_COOKIE_PASSWORD=$MA_CODENAME."p";
$MA_COOKIE_TIME=$MA_CODENAME."lt";

# include files
$MA_ADMINFILE="start.php";
$MA_VIEWFILE="view.php";
$MA_SEARCHFILE="seaarch.php";
$MA_PRIVACYFILE="privacy.php";
$MA_PRINTFILE="print.php";

$MA_CSS=array(
			"$MA_INCLUDE_DIR/sitew.css",
			"$MA_INCLUDE_DIR/siteb.css"
			);
$MA_CSSPRINT="$MA_INCLUDE_DIR/sitepr.css";

$MA_JS_BEGIN="$MA_INCLUDE_DIR/js_begin.js";
$MA_JS_END="$MA_INCLUDE_DIR/js_end.js";

$MA_HEADER="$MA_INCLUDE_DIR/header.php";
$MA_FOOTER="$MA_INCLUDE_DIR/footer.php";
$MA_HEADER_VIEW="$MA_INCLUDE_DIR/header_view.php";
$MA_FOOTER_VIEW="$MA_INCLUDE_DIR/footer_view.php";

$MA_LIB=array(
			"$MA_INCLUDE_DIR/lib.php",
			"$MA_INCLUDE_DIR/libview.php",
			"$MA_INCLUDE_DIR/libadmin.php"
			);

# add directory: load dirname.php, .css, .js from directory
$MA_PLUGINS=array();

# language
$MA_LANGFILE="hu.php";

# local app main and css file
$MA_APPFILE=array(
				"$MA_CONTENT_DIR/demo.js",
				"$MA_CONTENT_DIR/democfg.php",
				"$MA_CONTENT_DIR/demo.php",
				"$MA_CONTENT_DIR/$MA_LANGFILE"
			);
$MA_APPCSSFILE="$MA_CONTENT_DIR/demo.css";

# search
$MA_SEARCH_ICON_HREF="";
$MA_SEARCH_ICON_JS="";

# auto logout - second
$MA_LOGIN_TIMEOUT=600;
$MA_ENABLE_COOKIES=true;
$MA_ADMIN_USER=false;
$MA_USERPAGE=false;

# header, footer
$MA_ENABLE_HEADER=true;
$MA_ENABLE_FOOTER=true;
$MA_ENABLE_HEADER_VIEW=false;
$MA_ENABLE_FOOTER_VIEW=false;

# pages
$MA_ENABLE_PRIVACY=true;
$MA_ENABLE_PRINT=true;
$MA_ENABLE_SEARCH=true;
$MA_ENABLE_THEME=true;

# login
$MA_ENABLE_LOGIN=true;
$MA_ENABLE_LOGIN_VIEW=true;

# multiuser
$MA_ENABLE_USERNAME=true;
$MA_USERS_ADMINUSERS=array(
				"admin"
			);
$MA_USERS_CRED=array(
					array("admin","e3274be5c857fb42ab72d786e281b4b8"),
					array("user","5f4dcc3b5aa765d61d8327deb882cf99"),
				);
# need md5 passcode -- user password: password - admin password: adminpassword

# menu
$MA_MENU_FIELD="m";
# user menu
$MA_MENU=array();
# adminmenu
$MA_ADMINMENU=array();
# back icon in menu
$MA_BACKPAGE=false;

# other variables
$MA_BACKPAGE=false;
$MA_NOPAGE=false;
$MA_PASSWORD="";
$MA_LOGIN_TIME="";
$MA_LOGGEDIN=false;
$MA_STYLEINDEX=0;
$MA_LOGOUT_IN_HEADER=true;
$MA_PRIVACY_PAGE=false;
$MA_SEARCH_PAGE=false;

# if not enable cookie support:
# - all form need add this lines
#
#		<input type='hidden' name='$MA_COOKIE_PASSWORD' id='$MA_COOKIE_PASSWORD' value='$MA_PASSWORD'>
#		<input type='hidden' name='$MA_COOKIE_STYLE' id='$MA_COOKIE_STYLE' value='$MA_STYLEINDEX'>
#		<input type='hidden' name='$MA_COOKIE_TIME' id='$MA_COOKIE_TIME' value='$MA_LOGIN_TIME'>
############################################

?>
