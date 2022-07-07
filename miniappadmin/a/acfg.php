<?php

 #
 # MiniApps - admin
 #
 # info: main folder copyright file
 #
 #


# copyright link
$MA_COPYRIGHT="© ".date("Y").". <a href=https://github.com/pphome2>Github</a>";

# title, home link
$MA_SITENAME="MiniApp";
$MA_TITLE="MiniApp Admin";
$MA_CODENAME="amapp";
$MA_ROOT_HOME="https://google.com";
$MA_ROOT_NAME="MainSite";
$MA_SITE_HOME="$MA_MALOCATION/index.html";
$MA_DOCTYPE="<!DOCTYPE HTML>";

# files
$MA_CSS=array(
			"$MA_MALOCATION/$MA_INCLUDE_DIR/sitew.css",
			"$MA_MALOCATION/$MA_INCLUDE_DIR/siteb.css"
			);
$MA_JS_BEGIN="$MA_MALOCATION/$MA_INCLUDE_DIR/js_begin.js";
$MA_JS_END="$MA_MALOCATION/$MA_INCLUDE_DIR/js_end.js";

# footer/header
$MA_HEADER="$MA_MALOCATION/$MA_INCLUDE_DIR/header.php";
$MA_FOOTER="$MA_MALOCATION/$MA_INCLUDE_DIR/footer.php";
$MA_HEADER_VIEW="$MA_MALOCATION/$MA_INCLUDE_DIR/header_view.php";
$MA_FOOTER_VIEW="$MA_MALOCATION/$MA_INCLUDE_DIR/footer_view.php";
$MA_ENABLE_HEADER=true;
$MA_ENABLE_FOOTER=true;
$MA_FAVICON="$MA_MALOCATION/favicon.png";

# main files
$MA_ADMIN_FILE=array("a/a.css",
                    "a/a.js",
                    "a/a0.php",
                    "a/a1.php"
                    );

# app menu
$MA_ADMINMENU=array(
				array("Dashboard","main"),
				array("Admin","admin")
			);

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

# pages
$MA_ENABLE_PRIVACY=false;
$MA_ENABLE_PRINT=false;
$MA_ENABLE_SEARCH=false;
$MA_ENABLE_THEME=true;

# cookie names
$MA_COOKIE_STYLE=$MA_CODENAME."ast";
$MA_COOKIE_LOGIN=$MA_CODENAME."au";


?>
