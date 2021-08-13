<?php

 #
 # MiniApp - demo
 #
 # info: main folder copyright file
 #
 #





function searchpage(){
	echo("search page");
}

	
function privacypage(){
	echo("privacy page");
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
	global $DEMOTEXT;

	echo("<br /><br />");
	echo("<a href=print.php target=_blank>$DEMOTEXT</a>");
}

function main(){
	demo_header();
	if (isset($_GET['i'])){
		demo_data();
	}else{
		demo_data();
	}
	demo_footer();
}


?>
