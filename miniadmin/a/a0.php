<?php

 #
 # MiniApp - admin
 #
 # info: main folder copyright file
 #
 #


function admin_header(){
	echo("<header></header>");
}

function admin_footer(){
	echo("<header></header>");
}

function admin_data(){
	echo("<br /><br />");
	echo("main menu");
}

function admin_menu(){
	echo("<br /><br />");
	echo("admin menu");
}

function main(){
	admin_header();
	admin_data();
	admin_footer();
}

function admin(){
	admin_header();
	admin_menu();
	admin_footer();
}


?>
