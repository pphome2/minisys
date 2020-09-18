<?php

 #
 # MiniSys - main
 #
 # info: main folder copyright file
 #
 #


$MS_APP_DIR=".";

$L_SITENAME="Vezérlő";

include("$MS_APP_DIR/sys_ini.php");

$scriptname=$_SERVER['PHP_SELF'];

echo($SYS_HEADER);

echo("<div class;='content' id='content'>");

echo("<div class=spaceline></div>");
echo("<div class=spaceline></div>");
echo("<a href='$MS_BACKUP_SYS'><input class='inputsubmit' type='submit' id='submitmbackup' name='submitmbackup' value='$L_BUTTON_BACKUP'></a>");

echo("<div class=spaceline></div>");
echo("<div class=spaceline></div>");
echo("<a href='$MS_RESTORE_SYS'><input class='inputsubmit' type='submit' id='submitmrestore' name='submitmrestore' value='$L_BUTTON_RESTORE'></a>");

echo("<div class=spaceline></div>");
echo("<div class=spaceline></div>");
echo("<a href='$MS_CONFIG_SYS'><input class='inputsubmit' type='submit' id='submitmconfig' name='submitmconfig' value='$L_BUTTON_CONFIG'></a>");

echo("<div class=spaceline></div>");
echo("<div class=spaceline></div>");
echo("<a href='$MS_SITE_ROOT_HOME'><input class='inputsubmit' type='submit' id='submitmexit' name='submitmexit' value='$L_BUTTON_END'></a>");


echo("<div class=spaceline></div>");

echo("</div>");

echo($SYS_FOOTER);

?>

