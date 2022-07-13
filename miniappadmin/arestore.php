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
            $L_RESTORESTART,$L_RESTOREOK,$L_RESTOREERROR,$L_RESTOREFILEERROR,
            $L_RESTOREFILENAME,$L_RESTORESUBMITUP,$L_RESTORESUBMITGO,$L_RESTORENOFILE;

    $target="";
    echo("<div class=spaceline></div>");
    echo("<div class=spaceline></div>");
	echo("<form method='post' enctype='multipart/form-data'>");
	echo("<div class='upload-btn-wrapper'>");
	echo("<input type='file' name=filename id=filename  />");
	echo("<label for=fileupload class='upload-btn'>$L_RESTOREFILENAME</label>");
	echo("</div>");
	echo("<input type='submit' value='$L_RESTORESUBMITUP' id='submitup' name='submitup'>");
	echo("<input type='submit' value='$L_RESTORESUBMITGO' id='submitgo' name='submitgo'>");
	echo("</form>");
    if (isset($_POST['submitup'])){
		$filen=basename($_FILES["filename"]["name"]);
		if ($filen<>""){
    		$tfile=$MA_BACKUPDIR."/".$filen;
	    	if (file_exists($tfile)){
		        unlink($tfile);
    		}
	    	if (move_uploaded_file($_FILES["filename"]["tmp_name"], $tfile)) {
		        $target=$tfile;
		    }
		}
    }
    if (isset($_POST['submitgo'])){
        $files=scandir($MA_BACKUPDIR, SCANDIR_SORT_DESCENDING);
        if (($files[0]<>".")and($files[0]<>"..")){
            $target="$MA_BACKUPDIR/$files[0]";
        }
    }
    if ($target==""){;
        echo("<div class=spaceline></div>");
        echo($L_RESTORENOFILE);
    }else{
        if (substr($target,strlen($target)-3,3)<>"tar"){
            echo("<div class=spaceline></div>");
            echo($L_RESTOREFILEERROR." (".$target.")");
            $target="";
        }
    }
    if ($target<>""){
        echo("<div class=spaceline></div>");
        echo($L_RESTORESTART);
        echo("<div class=spaceline></div>");
        try {
            # make sure the script has enough time to run (300 seconds  = 5 minutes)
            ini_set('max_execution_time', '300');
            ini_set('set_time_limit', '0');
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
}

?>
