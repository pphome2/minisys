<?php

 #
 # MiniApp - demo
 #
 # info: main folder copyright file
 #
 #


# first and one run install:
# - set databases
# - copy files
# - get user and password
# - set own app properties
function install(){
    if (file_exists("install.html")){
        echo("install mode");
        unlink("install.html");
    }
}


# serch page and system form
function searchpage(){
	global $DEMO_TITLE,$DEMO_BUTTON_TEXT,$DEMO_SEARCH_TEXT;

    $stext=searchview($DEMO_TITLE,$DEMO_BUTTON_TEXT,$DEMO_SEARCH_TEXT);
    echo($stext);
}


# privacy page: show data protect rules
function privacypage(){
	global $DEMO_TITLE,$DEMO_PRIVACY_FILE;

    privacyview($DEMO_TITLE,$DEMO_PRIVACY_FILE);
}


# printer friendly page
function printpage(){
	echo("print page");
}


# my app header
function demo_header(){
	echo("<header></header>");
}


# my app footer
function demo_footer(){
	echo("<header></header>");
}


# demo
function demo_data(){
	global $DEMO_TEXT;

	echo("<br /><br />");
	echo("$DEMO_TEXT");
}


# main page: footer, header and own menu, login, admin functions
function main(){
    loadplugin("table");
    loadplugin("cards");
	demo_header();
	demo_data();
	demo_footer();
}


# my public page
function view(){
    loadplugin("table");
    loadplugin("cards");
	demo_header();
	demo_data();
	demo_footer();
}


# demo menu page
function userpage(){
    mess_ok("Ok: User page");
    mess_error("Error: User page");
    mess_info("Info: User page");
    mess_warning("Warning: User page");
}


# demo menu page
function adminpage(){
    global $MA_ADMIN_USER;

    if ($MA_ADMIN_USER){
        echo("Admin");
        mess_ok("Ok: Admin page");
        mess_error("Error: Admin page");
        mess_info("Info: Admin page");
        mess_warning("Warning: Admin page");
    }else{
        main();
    }
}


?>
