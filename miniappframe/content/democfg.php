<?php

 #
 # MiniApp - demo
 #
 # info: main folder copyright file
 #
 #

# language
$fmlang="$MA_CONTENT_DIR/$MA_LANGFILE";
if (file_exists($fmlang)){
	include($fmlang);
}
# app menu
$MA_MENU=array(
				#array($L_MENU1,"list.php")
			);
$MA_ADMINMENU=array(
				#array($L_MENU2,"list.php")
			);


# variables
$DEMOTEXT="Demo page";

?>
