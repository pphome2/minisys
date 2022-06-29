<?php

 #
 # MiniApp - demo
 #
 # info: main folder copyright file
 #
 #



function searchpage(){
	global $DEMO_TITLE,$DEMO_BUTTON_TEXT,$DEMO_SEARCH_TEXT,$MA_LOGGEDIN;

	echo("<header><h3>$DEMO_TITLE</h3></header>");
	echo("<div class=spaceline></div>");
	echo("<div class=contentbox>");
	if ($MA_LOGGEDIN){
    	echo("<form method='post' enctype='multipart/form-data'>");
	    echo("<input type=text name='search' id='search' placeholder='$DEMO_SEARCH_TEXT' autofocus />");
    	echo("<input type='submit' value='$DEMO_BUTTON_TEXT' name='submitsearch' />");
	    echo("</form>");
	    echo("<div class=spaceline></div>");
    	if (isset($_POST['submitsearch'])){
	    	$st=vinput($_POST['search']);
    	    echo("<div class=content>");
    		echo($DEMO_SEARCH_TEXT.": $st");
	        echo("</div>");
    	}
    }else{
    }
    echo("</div>");
}


function privacypage(){
	global $DEMO_TITLE,$DEMO_PRIVACY_FILE;

	echo("<header><h3>$DEMO_TITLE</h3></header>");
	echo("<div class=spaceline></div>");
	if (file_exists($DEMO_PRIVACY_FILE)){
	    echo("<div class=contentbox>");
	    if ($file=fopen($DEMO_PRIVACY_FILE, "r")) {
            while(!feof($file)) {
                $line=fgets($file);
        	    echo($line."<br />");
            }
            fclose($file);
        }
	    echo("</div>");
	}
	echo("<div class=spaceline></div>");
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
