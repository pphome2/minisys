<?php

 #
 # MiniApp
 #
 # info: main folder copyright file
 #
 #


function searchpage(){
  global $D_SEARCH_TEXT,$L_BUTTON_NEXT,$L_SEARCH;

  searchview($D_SEARCH_TEXT,$L_BUTTON_NEXT,$L_SEARCH);
}


function privacypage(){
    global $D_TITLE_PRIV,$MA_APPPRIVACYFILE;

    privacyview($D_TITLE_PRIV,$MA_APPPRIVACYFILE);
}


function printpage(){

    echo("<a href='start.php' style='text-decoration:none;color:black;'>");
    #d_print();
    echo("</a>");
}


function d_header(){
    echo("<header></header>");
}


function d_footer(){
    echo("<footer></footer>");
}


function d_table(){
    global $MA_SERVER_DIR;

    echo("123...");
    #sql_install();
    #sql_backup();
    #sql_restore()
    update_system();
}


function d_data(){
    global $MA_MENU_FIELD,$D_MENUCODE;

    echo("<div class=spaceline></div>");
    echo("<div class=content>");
    if (isset($_GET[$MA_MENU_FIELD])){
        switch ($_GET[$MA_MENU_FIELD]){
            case $D_MENUCODE[0]:
                break;
            default:
                d_table();
                break;
        }
    }else{
        d_table();
    }
    echo("</div>");
    echo("<div class=spaceline></div>");
}

function d_view(){
    echo("<div class=spaceline></div>");
    echo("<div class=content>");
    echo("</div>");
    echo("<div class=spaceline></div>");
}

function main(){
    #loadplugin("table");
    #loadplugin("cards");
    d_header();
    d_data();
    d_footer();
}

function main_cookies(){
}

function cron(){
}

function view(){
    #loadplugin("table");
    #loadplugin("cards");
    d_header();
    d_view();
    d_footer();
}


?>
