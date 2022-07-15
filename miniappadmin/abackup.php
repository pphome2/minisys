<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #

# load config
if (file_exists("aconfig.php")){
	include("aconfig.php");
}

# load main config
if (file_exists("$MA_MALOCATION/config/config.php")){
	include("$MA_MALOCATION/config/config.php");
}
# load admin config
if (file_exists("$MA_ADMIN_DIR/acfg.php")){
	include("$MA_ADMIN_DIR/acfg.php");
}
# load admin language file
if (file_exists("$MA_ADMIN_DIR/$MA_LANGFILE")){
	include("$MA_ADMIN_DIR/$MA_LANGFILE");
}

# load admin files
for ($i=0;$i<count($MA_ADMIN_FILE);$i++){
	if (file_exists("$MA_ADMIN_FILE[$i]")){
		include("$MA_ADMIN_FILE[$i]");
	}
}


if (file_exists("$MA_ADMIN_DIR/adminheader.php")){
    include("$MA_ADMIN_DIR/adminheader.php");
}

if (function_exists("adminbackup")){
    adminbackup();
}

if (file_exists("$MA_ADMIN_DIR/adminfooter.php")){
    include("$MA_ADMIN_DIR/adminfooter.php");
}


function adminbackup(){
    global $MA_MALOCATION,$MA_BACKUPDIR,$L_BACKUPDOWNLOADFILE,$L_BACKUPBUTTON,
            $L_BACKUPSTART,$L_BACKUPOK,$L_BACKUPERROR,$L_BACKUPTITLE;

    echo("<div class=spaceline></div>");
    echo("<div class=spaceline></div>");
    echo("<h3>$L_BACKUPTITLE</h3>");
    echo("<div class=spaceline></div>");
    if (!isset($_POST['submitgo'])){
    	echo("<form method='post' enctype='multipart/form-data'>");
	    echo("<input type='submit' value='$L_BACKUPBUTTON' id='submitgo' name='submitgo'>");
    	echo("</form>");
	}else{
        echo($L_BACKUPSTART);
        echo("<div class=spaceline></div>");
        try {
            # make sure the script has enough time to run (300 seconds  = 5 minutes)
            ini_set('max_execution_time', '300');
            ini_set('set_time_limit', '0');
            $d=date("Ymd-His");
            $target="$MA_BACKUPDIR/$d.tar";
            $dir="$MA_MALOCATION";
            # setup phar
            $phar = new PharData($target);
            $phar->buildFromDirectory(dirname(__FILE__) . '/'.$dir);
            echo($L_BACKUPOK);
            echo("<div class=spaceline></div>");
            echo("$L_BACKUPDOWNLOADFILE <a href=\"$target\">$d.tar</a>");
        } catch (Exception $e){
            # handle errors
            echo($L_BACKUPERROR." \($target\)");
            echo("<div class=spaceline></div>");
        }
    }
}

?>
