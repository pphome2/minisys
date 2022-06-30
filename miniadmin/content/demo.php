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
	echo("<a href=print.php target=_blank>$DEMO_TEXT</a>");
}

function main(){
    loadplugin("table");
    loadplugin("cards");
	demo_header();
	if (isset($_GET['i'])){
		demo_data();
	}else{
		demo_data();
	}
	demo_footer();
}

function view(){
    loadplugin("table");
    loadplugin("cards");
	demo_header();
	demo_data();
	demo_footer();
}


?>
