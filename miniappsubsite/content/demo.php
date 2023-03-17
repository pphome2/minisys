<?php

 #
 # MiniApp - demo
 #
 # info: main folder copyright file
 #
 #



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
    global $MA_FAVICON,$D_SITENAME,$MA_CONTENT_DIR,
            $MA_APPJSFILE,$MA_APPCSSFILE;

	echo("<html>");
    echo("<head>");
    echo("<title>$D_SITENAME</title>");
    echo("<meta charset=\"utf-8\" />");
    echo("<meta http-equiv=\"Content-Type\" content=\"text/html;charset=UTF-8\" />");
    echo("<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />");
    echo("<link rel=\"icon\" href=\"$MA_FAVICON\" />");
    echo("<link rel=\"shortcut icon\" type=\"image/png\" href=\"$MA_FAVICON\" />");
    # load local app css
    echo("<style>");
    for ($i=0;$i<count($MA_APPCSSFILE);$i++){
	    if (file_exists("$MA_CONTENT_DIR/$MA_APPCSSFILE[$i]")){
		    include("$MA_CONTENT_DIR/$MA_APPCSSFILE[$i]");
    	}
    }
    echo("</style>");
    # load local app jsfile
    echo("<script>");
    for ($i=0;$i<count($MA_APPJSFILE);$i++){
	    if (file_exists("$MA_CONTENT_DIR/$MA_APPJSFILE[$i]")){
		    include("$MA_CONTENT_DIR/$MA_APPJSFILE[$i]");
    	}
    }
    echo("</script>");

	echo("</head>");
	echo("<body>");
	echo("<header></header>");
}


# my footer
function demo_footer(){
	echo("<footer></footer>");
	echo("</body>");
	echo("</html>");
}


# demo
function demo_data(){
	echo("<div class=demo>");
	echo("demo");
	echo("</div>");
}


# main admin page
function main(){
	demo_header();
	demo_data();
	demo_footer();
}


# public page
function view(){
	demo_header();
	demo_data();
	demo_footer();
}


# user menu page
function userpage(){
    echo("subsite userpage");
}


?>
