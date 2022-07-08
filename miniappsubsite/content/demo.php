<?php

 #
 # MiniApp - demo
 #
 # info: main folder copyright file
 #
 #



function searchpage(){
	global $DEMO_TITLE,$DEMO_BUTTON_TEXT,$DEMO_SEARCH_TEXT;

    searchview($DEMO_TITLE,$DEMO_BUTTON_TEXT,$DEMO_SEARCH_TEXT);
}

function privacypage(){
	global $DEMO_TITLE,$DEMO_PRIVACY_FILE;

    privacyview($DEMO_TITLE,$DEMO_PRIVACY_FILE);
}

function printpage(){
	echo("print page");
}

function demo_header(){
    global $MA_ENABLE_HEADER;

    if (!$MA_ENABLE_HEADER){
        echo("<div class=\"all-page\">");
        echo("<header>");
        echo("</header>");
    	echo("<header></header>");
    }
}

function demo_footer(){
    global $MA_ENABLE_FOOTER;

    if (!$MA_ENABLE_FOOTER){
    	echo("<footer></footer>");
    }
}

function demo_data(){
	global $DEMO_TEXT;

	echo("<br /><br />");
	echo("$DEMO_TEXT");
}

function main(){
    #loadplugin("table");
    #loadplugin("cards");
	demo_header();
	demo_data();
	demo_footer();
}

function view(){
    #loadplugin("table");
    #loadplugin("cards");
	demo_header();
	demo_data();
	demo_footer();
}

function userpage(){
    echo("subsite userpage");
}

function adminpage(){
    global $MA_ADMIN_USER;

    if ($MA_ADMIN_USER){
        echo("subsite adminpage");
    }else{
        main();
    }
}


?>
