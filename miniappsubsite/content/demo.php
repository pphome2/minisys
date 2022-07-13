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


# my heater
function demo_header(){
    global $MA_ENABLE_HEADER;

    if (!$MA_ENABLE_HEADER){
        echo("<div class=\"all-page\">");
        echo("<header>");
        echo("</header>");
    	echo("<header></header>");
    }
}


# my footer
function demo_footer(){
    global $MA_ENABLE_FOOTER;

    if (!$MA_ENABLE_FOOTER){
    	echo("<footer></footer>");
    	echo("</div>");
    }
}


# demo
function demo_data(){
	global $DEMO_TEXT;

	echo("<br /><br />");
	echo("$DEMO_TEXT");
}


# main admin page
function main(){
    #loadplugin("table");
    #loadplugin("cards");
	demo_header();
	demo_data();
	demo_footer();
}


# public page
function view(){
    #loadplugin("table");
    #loadplugin("cards");
	demo_header();
	demo_data();
	demo_footer();
}


# user menu page
function userpage(){
    echo("subsite userpage");
}


# admin menu page
function adminpage(){
    global $MA_ADMIN_USER;

    if ($MA_ADMIN_USER){
        echo("subsite adminpage");
    }else{
        main();
    }
}


?>
