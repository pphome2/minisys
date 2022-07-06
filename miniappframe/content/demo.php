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
	echo("<header></header>");
}

function demo_footer(){
	echo("<header></header>");
}

function demo_data(){
	global $DEMO_TEXT;

	echo("<br /><br />");
	echo("$DEMO_TEXT");
}

function main(){
    loadplugin("table");
    loadplugin("cards");
	demo_header();
	demo_data();
	demo_footer();
}

function view(){
    loadplugin("table");
    loadplugin("cards");
	demo_header();
	demo_data();
	demo_footer();
}

function userpage(){
    mess_ok("Ok: User page");
    mess_error("Error: User page");
    mess_info("Info: User page");
    mess_warning("Warning: User page");
}

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
