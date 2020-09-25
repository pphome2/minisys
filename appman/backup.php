<?php

 #
 # AppMan - backup/restore app
 #
 # info: main folder copyright file
 #
 #

$APP_URL="";

if (file_exists($APP_URL."appman_cfg.php")){
	include($APP_URL."appman_cfg.php");
}else{
	echo("Error!");
	exit();
}

if (file_exists($APP_URL.$AM_LANGFILE)){
	include($APP_URL.$AM_LANGFILE);
}

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo($AM_NAME); ?></title>
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" href="<?php echo($APP_URL); ?>favicon.png">
		<link rel="shortcut icon" type="image/png" href="<?php echo($APP_URL); ?>favicon.png" />
		<style>	<?php include($AM_CSS); ?></style>
	</head>
<body>
	<div class=all-page>
<header>
	<ul class="sidenav">
		<li class="padleft"><span class="title"><?php echo($L_APPNAME); ?></span></li>
	</ul>
</header>
	<div class="content">


<?php

# messages functions
function mess_error($m){
	echo('
		<div class="message_error">
			<div onclick="this.parentElement.style.display=\'none\'" class="ttoprightclose">
				<p class="insidecontent">'.$m.'</p>
			</div>
		</div>
	');
}


function mess_ok($m){
	echo('
		<div class="message_ok">
			<div onclick="this.parentElement.style.display=\'none\'" class="ttoprightclose">
				<p class="insidecontent">'.$m.'</p>
			</div>
		</div>
	');
}



function vinput($d) {
	$d=trim($d);
	$d=stripslashes($d);
	$d=strip_tags($d);
	#$d=htmlspecialchars($d);
	return $d;
}

# cpy file and unpacked
function cpdecomp($src,$dest){
	if (copy($src,$dest)){
		$phar=new PharData($dest);
		$phar=$phar->decompress();
		$f2=str_replace('.gz','',$dest);
		$phar2=new PharData($f2, RecursiveDirectoryIterator::SKIP_DOTS);
		$phar2=$phar2->extractTo(".",null,true);
		unlink($dest);
		unlink($f2);
		$ok=true;
	}else{
		$ok=false;
	}
	return($ok);
}


# change all file username and group
function rchown($dir,$user,$group){
	$dir=rtrim($dir,"/");
	if ($items=glob($dir."/*")){
		foreach ($items as $item){
			if (is_dir($item)){
				rchown($item,$user,$group);
			}else{
				chown($item,$user);
				chgrp($item,$group);
			}
		}
	}
	chown($dir,$user);
	chgrp($item,$group);
}


# backup local app
function backup(){
	global $L_BACKUP,$L_BACKUP_OK,$L_BUTTON_BACK,$L_BACKUP_DOWNLOAD,
		$L_BACKUP_STARTED,
		$AM_BACKUP_DIR,$AM_BACKUP_FILE,$AM_BACKUP_LETTER,$AM_SQL_BACKUP,
		$AM_FILE_USER,$L_FILE_GROUP;

	#rchown("..",$AM_FILE_USER,$AM_FILE_GROUP);
	echo("<div class=\"card\">");
	echo("<div class=\"card-header topleftmenu1\">$L_BACKUP</div>");
	echo("<div class=\"cardbody\" id=\"cardbodyf\"><div class=\"insidecontent\">");
	echo("<div class=\"spaceline\"></div>");
	echo($L_BACKUP_STARTED);
	echo("<div class=\"spaceline\"></div>");
	if (file_exists($AM_SQL_BACKUP)){
		include($AM_SQL_BACKUP);
	}
	$d=$AM_BACKUP_DIR."/".$AM_BACKUP_LETTER.date(YmdHis).".tar";
	$f='/\.php$|\.jpg|\.css|\.png|\.htm$/';
	$f='/^(?!(.*tar.gz))(.*)$/i';
	#$f2="/\\/({$AM_BACKUP_DIR})\\//";
	$phar=new PharData($d);
	$phar->buildFromDirectory("..",$f);
	$phar=$phar->compress(Phar::GZ);
	if (file_exists($d)){
		unlink($d);
	}
	#echo($L_BACKUP_OK." (".$d.".gz)");
	echo($L_BACKUP_OK);
	echo("<div class=\"spaceline\"></div>");
	$file=glob($AM_BACKUP_DIR."/".$AM_BACKUP_LETTER."*.tar.gz");
	echo($L_BACKUP_DOWNLOAD);
	echo("<div class=row>");
	echo("<div class=\"colx\ center\">");
	foreach($file as $f){
		$f2=explode("/",$f);
		echo("<a href=$f>$f2[1]");
		echo("</a><br />");
	}
	echo("<div class=\"spaceline\"></div>");
	echo("<a href='$AM_BACKUP_FILE'>");
	echo("<button class=card-button>$L_BUTTON_BACK</button>");
	echo("</a>");
	echo("</div></div>");
	echo("</div>");
	echo("</div>");
	echo("</div>");
}



# restore local app
function restore(){
	global $L_RESTORE,$L_RESTORE_OK,$L_BUTTON_BACK,$L_RESTORE_STARTED,
		$AM_BACKUP_DIR,$AM_SQL_RESTORE,$AM_SQL_RESTORE,
		$AM_FILE_USER,$L_FILE_GROUP;

	#rchown("..",$AM_FILE_USER,$AM_FILE_GROUP);
	echo("<div class=\"card\">");
	echo("<div class=\"card-header topleftmenu1\">$L_RESTORE</div>");
	echo("<div class=\"cardbody\" id=\"cardbodyf\"><div class=\"insidecontent\">");
	echo("<div class=\"spaceline\"></div>");
	echo($L_RESTORE_STARTED);
	echo("<div class=\"spaceline\"></div>");
	$file=$AM_BACKUP_DIR."/".$_POST["file"];
	$file2=str_replace('.gz','',$file);
	if (file_exists($file2)){
		unlink($file2);
	}
	$phar=new PharData($file);
	$phar=$phar->decompress();
	$phar2=new PharData($file2, RecursiveDirectoryIterator::SKIP_DOTS);
	$phar2=$phar2->extractTo("..",null,true);
	if (file_exists($file2)){
		unlink($file2);
	}
	if (file_exists($AM_SQL_RESTORE)){
		include($AM_SQL_RESTORE);
	}
	echo($L_RESTORE_OK);
	echo("<div class=\"spaceline\"></div>");
	echo("<a href='$AM_BACKUP_FILE'>");
	echo("<button class=card-button>$L_BUTTON_BACK</button>");
	echo("</a>");
	echo("</div></div>");
	echo("</div>");
}



# menu
function menu(){
	global $L_BACKUP,$L_RESTORE,$L_BACKUP_TEXT,$L_RESTORE_TEXT,
		$L_NO_RESTOREFILE,$L_FILESELECT,$L_BUTTON_FILE,
		$AM_BACKUP_DIR,$AM_BACKUP_LETTER;

	echo("<div class=\"card\">");
	echo("<div class=\"card-header topleftmenu1\">$L_BACKUP</div>");
	echo("<div class=\"cardbody\" id=\"cardbodyf\"><div class=\"insidecontent\">");
	echo("<div class=\"spaceline\"></div>");
	echo($L_BACKUP_TEXT);
	echo("<div class=\"spaceline\"></div>");
	echo("<form method=post>");
	echo("<input type=submit id=submitbackup name=submitbackup value=\"$L_BACKUP\">");
	echo("</form>");
	echo("</div></div></div>");
	echo("<div class=\"spaceline\"></div>");

	echo("<div class=\"card\">");
	echo("<div class=\"card-header topleftmenu1\">$L_RESTORE</div>");
	echo("<div class=\"cardbody\" id=\"cardbodyf\"><div class=\"insidecontent\">");
	echo("<div class=\"spaceline\"></div>");
	echo($L_RESTORE_TEXT);
	echo("<div class=\"spaceline\"></div>");
	echo("<form id=101 method=\"post\" enctype=\"multipart/form-data\">");
	#echo("<input type=file name=fileupload id=fileupload class=inputfile>");
	#echo("<label for=fileupload><div class=inputbutton>$L_FILESELECT</div></label>");
	echo("<div class='upload-btn-wrapper'>");
	echo("<input type='file' name=fileupload id=fileupload  />");
	echo("<label for=fileupload class='upload-btn'>$L_FILESELECT</label>");
	echo("</div>");
	echo("<div class=spaceline></div>");
	echo("<input type=submit id=submitfile name=submitfile class=card-button value=$L_BUTTON_FILE>");
	echo("</form>");
	echo("<div class=\"spaceline\"></div>");
	$file=glob($AM_BACKUP_DIR."/".$AM_BACKUP_LETTER."*.tar.gz");
	if (count($file)>=0){
		echo("<form method=post>");
		echo("<select id=file name=file>");
		foreach($file as $f){
			$f2=explode("/",$f);
			echo("<option>$f2[1]</option>");
		}
		echo("</select>");
		echo("<input type=submit id=submitrestore name=submitrestore value=\"$L_RESTORE\">");
		echo("</form>");
	}else{
		echo($L_NO_RESTOREFILE);
	}
	echo("</div></div>");
	echo("</div>");
}


# file upload
function filesave($target_dir){
	$ret=FALSE;
	$target_file=basename($_FILES["fileupload"]["name"]);
	if ($target_file<>""){
		#$target_file=toascii($target_file);
		if ($target_dir<>""){
			$target_file=$target_dir."/".$target_file;
		}
		$c=$_FILES["fileupload"]["tmp_name"];
		if (move_uploaded_file($_FILES["fileupload"]["tmp_name"],$target_file)) {
			$ret=TRUE;
		}
	}
	return($ret);
}

# file upload for restore
function fileup(){
	global $AM_BACKUP_DIR,$L_FILEUPLOAD_OK,$L_FILEUPLOAD_ERROR;

	if (isset($_FILES[fileupload])){
		if (basename($_FILES[fileupload][name])<>""){
			$dir=$AM_BACKUP_DIR;
			$ok=filesave($dir);
			if ($ok){
				mess_ok($L_FILEUPLOAD_OK);
			}else{
				mess_error($L_FILEUPLOAD_ERROR);
			}
		}
	}
}


######################################################################

# select and start function

#chdir("..");

if (isset($_POST["submitdel"])){
	$fi=glob($AM_BACKUP_DIR."/".$AM_BACKUP_LETTER."*.tar.gz");
	if (count($fi)>0){
		foreach($fi as $of){
			unlink($of);
		}
		mess_ok($L_DELETE_BACKUP_OK);
	}else{
		mess_error($L_DELETE_BACKUP_NO);
	}
}

if (isset($_POST["submitbackup"])){
	backup();
}else{
	if (isset($_POST["submitrestore"])){
		restore();
	}else{
		if (isset($_POST["submitfile"])or(isset($_FILES["fileupload"]))){
			fileup();
		}
		menu();
	}
}

$f="";
if (file_exists("index.html")){
	$f="index.html";
}else{
	if (file_exists("index.php")){
		$f="index.php";
	}
}


echo("<div class=spaceline></div>");

echo("<form method=post>");
echo("<input type=submit id=submitdel name=submitdel value=\"$L_DELETE_BACKUP\">");
echo("</form>");

echo("<div class=spaceline></div>");

if ($f<>""){
	echo("<a href=\"../$f\">");
	echo("<button class=card-button>");
	echo("$L_START_BUTTON");
	echo("</button></a>");
}else{
	echo("<a onclick='document.location.href=\"/\";return false;' >");
	echo("<button class=card-button>$L_BUTTON_END</button>");
	echo("</a>");
}



?>


	</div>
<footer>
	<ul class="sidenav">
		<li class="padleft"><?php echo($AM_COPYRIGHT); ?></li>
	</ul>
</footer>
</body>
</html>
