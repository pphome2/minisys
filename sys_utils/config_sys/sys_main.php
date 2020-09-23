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
echo("<a href='$MS_BACKUP_SYS'>");
echo("<input class='inputsubmit' type='submit' id='submitbackup' name='submitbackup' value='$L_BUTTON_BACKUP'>");
echo("</a>");

echo("<div class=spaceline></div>");
echo("<div class=spaceline></div>");
echo("<a href='$MS_RESTORE_SYS'>");
echo("<input class='inputsubmit' type='submit' id='submitrestore' name='submitrestore' value='$L_BUTTON_RESTORE'>");
echo("</a>");


echo("<div class=spaceline></div>");
echo("<div class=spaceline></div>");
echo("<a href='$MS_CONFIG_SYS'>");
echo("<input class='inputsubmit' type='submit' id='submitconfig' name='submitconfig' value='$L_BUTTON_CONFIG'>");
echo("</a>");


echo("<div class=spaceline100></div>");
echo("<a onclick='document.location.href=\"/\";return false;' >");
echo("<input class='inputsubmit red' type='submit' id='submitexit' name='submitexit' value='$L_BUTTON_END'>");
echo("</a>");



echo("<div class=spaceline></div>");

echo("</div>");

echo($SYS_FOOTER);

?>

