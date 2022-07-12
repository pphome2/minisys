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

if (function_exists("adminrestore")){
    adminrestore();
}

if (file_exists("$MA_ADMIN_DIR/adminfooter.php")){
    include("$MA_ADMIN_DIR/adminfooter.php");
}


function adminrestore(){
    global $MA_MALOCATION,$MA_BACKUPDIR,
            $L_RESTORESTART,$L_RESTOREOK,$L_RESTOREERROR;

    echo("<div class=spaceline></div>");
    echo("<div class=spaceline></div>");
    echo($L_RESTORESTART);
    echo("<div class=spaceline></div>");
    try {
        # make sure the script has enough time to run (300 seconds  = 5 minutes)
        ini_set('max_execution_time', '300');
        ini_set('set_time_limit', '0');
        $files=scandir($MA_BACKUPDIR, SCANDIR_SORT_DESCENDING);
        $target="$MA_BACKUPDIR/$files[0]";
        if (file_exists($target)){
            $dir="$MA_MALOCATION";
            $phar = new PharData("$target");
            # extract all files, and overwrite
            $phar->extractTo("$dir",null,true);
            echo($L_RESTOREOK);
        }else{
            echo($L_RESTOREERROR." $target");
        }
    } catch (Exception $e){
        # handle errors
        echo($L_RESTOREERROR." $e");
    }
}

?>
