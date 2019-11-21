<?php

 #
 # MiniSys - update app
 #
 # info: main folder copyright file
 #
 #

$COPYRIGHT="© 2019. <a href=https://github.com/pphome2/minisys>MiniSys</a>";
$MS_SITENAME="MiniSys - Frissítő";


# start app/site after install
$MS_SITE_HOME="index.html";

$MS_FILE="sys_update.php";
$MS_AUTOSTART=false;

$MS_NEW_VERSION="20190714";
$MS_VERSION_FILE="version";

$MS_ALWAYS_INSTALL=true;

# install app home
$MS_SOURCE_URL="http://localhost/~peter/minisys/update";

# language
$L_SITENAME="Teszt frissítő";

$L_BUTTON_UPDATE="Frissítés";
$L_BUTTON_END="Kilépés";
$L_BUTTON_STOP="Mégse";

$L_VERSION_CONFLICT_MESSAGE="Nem megfelelő verzóra akar frissíteni.";
$L_NO_INSTALL_VERSION_MESSAGE="Nincs telepített verzió, előbb telepítsen.";

$L_STEP1_MESSAGE="Első lap";
$L_STEP2_MESSAGE="Második lap";

# files to copy # if php file: need link to file with plus .src extension
$MS_PHP_FILE_EXTENSION=".src";
$MS_DATA_DIR="data";
$MS_COPY_FILE_URL=array("$MS_DATA_DIR/data.tar.gz");
$MS_COPY_DIR_LOCAL="";

echo("<!DOCTYPE HTML>");
echo("<html>");
echo("	<head>");
echo("		<title>$MS_SITENAME</title>");
echo("		<meta charset=\"utf-8\" />");
echo("		<meta http-equiv=\"Content-Type\" content=\"text/html;charset=UTF-8\">");
echo("		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />");
echo("		<link rel=\"icon\" href=\"$MS_SOURCE_URL/favicon.png\">");
echo("		<link rel=\"shortcut icon\" type=\"image/png\" href=\"$MS_SOURCE_URL/favicon.png\" />");
echo("	</head>");
echo("<body>");
echo("<div class=all-page>");
echo("<header>");
echo("	<div class='menu'>");
echo("	<ul class='sidenav'>");
echo("	  <li><a class='active' style='cursor:pointer;1'>$L_SITENAME</a></li>");
echo("	</ul>");
echo("	</div>");
echo("</header>");
echo("<div class='content' id='content'>");

define('DS', DIRECTORY_SEPARATOR);

$old_version="";
$new_version=$MS_NEW_VERSION;
if (file_exists($MS_VERSION_FILE)){
	$old_version=file_get_contents($MS_VERSION_FILE);
}
if (($old_version=="")and($MS_ALWAYS_INSTALL)){
	$old_version="0";
}
if (file_exists($MS_DATA_DIR.DS.$MS_VERSION_FILE)){
	$old_version=file_get_contents($MS_VERSION_FILE);
}

$old_version=str_replace('.','',$old_version);
$old_version=(int)$old_version;
$new_version=str_replace('.','',$new_version);
#echo("$old_version $new_version");

if ((!isset($_POST["submitstart1"]))and(!$MS_AUTOSTART)){
	# step1
	echo("<div class=spaceline></div>");
	echo("<div class=spaceline></div>");
	if (($old_version<$new_version)and($old_version<>"")or($MS_ALWAYS_INSTALL)){
		echo("<form action=$MS_FILE id=0 method=\"post\" enctype=\"multipart/form-data\">");
		echo("	$L_STEP1_MESSAGE");
		echo("<div class=spaceline></div>");
		echo("<div class=spaceline></div>");
		echo("	<input class='inputsubmit' type='submit' id='submitstart1' name='submitstart1' value='$L_BUTTON_UPDATE'>");
		echo("</form>");
	}else{
		echo("	$L_STEP1_MESSAGE");
		echo("<div class=spaceline></div>");
		echo("<div class=spaceline></div>");
		if ($old_version==""){
			echo("	$L_NO_INSTALL_VERSION_MESSAGE");
		}else{
			echo("	$L_VERSION_CONFLICT_MESSAGE");
		}
		echo("<div class=spaceline></div>");
		echo("<div class=spaceline></div>");
	}
	echo("<a href='javascript:history.back()'><input class='inputsubmit red' type='submit' id='submitstart3' name='submitstart3' value='$L_BUTTON_STOP'></a>");
}

if ((isset($_POST["submitstart1"]))or($MS_AUTOSTART)){
	# step2
	$fdest=$MS_COPY_DIR_LOCAL;
	if ($fdest<>""){
		if (!is_dir($fdest)){
			mkdir($fdest,0777,true);
		}
	}
	foreach($MS_COPY_FILE_URL as $file){
		$f=explode(DS,$file);
		$f2="$MS_COPY_DIR_LOCAL";
		if ($f2==""){
			$f2=".";
		}
		$db=count($f);
		for($i=0;$i<$db-1;$i++){
			$f2=$f2.DS.$f[$i];
			#echo("$f2");
			if (!is_dir($f2)){
				mkdir($f2,0777,true);
			}
		}
		$file2=$MS_SOURCE_URL.DS.$file;
		if ($fdest==""){
			$fdest2='.'.DS.$file;
			$fdest='.'.DS;
		}else{
			$fdest2='.'.DS.$fdest.DS.$file;
		}
		if (file_exists($fdest2)){
			unlink($fdest2);
		}
		$data=file_get_contents($file2);
		file_put_contents($fdest2, $data);
		if (substr($fdest2,strlen($fdest2)-strlen($MS_PHP_FILE_EXTENSION),strlen($MS_PHP_FILE_EXTENSION))==$MS_PHP_FILE_EXTENSION){
			$of=str_replace($MS_PHP_FILE_EXTENSION,'',$fdest2);
			rename($fdest2,$of);
		}
		if (substr($fdest2,strlen($fdest2)-7,7)==".tar.gz"){
			$out_file_name=str_replace('.gz','',$fdest2);
			if (file_exists($out_file_name)){
				unlink($out_file_name);
			}
			$phar=new PharData($fdest2);
			$phar=$phar->decompress();
			$phar2=new PharData($out_file_name);
			$phar2=$phar2->extractTo($fdest,null,true);
		}
		if (substr($fdest2,strlen($fdest2)-4,4)==".tar"){
			// unarchive from the tar
			$phar2=new PharData($fdest2);
			$phar2=$phar2->extractTo($fdest,null,true);
		}
	}
	echo("<div class=spaceline></div>");
	echo("<div class=spaceline></div>");
	echo("	$L_STEP2_MESSAGE");
	echo("<div class=spaceline></div>");
	echo("<div class=spaceline></div>");
	echo("<a href='$MS_SITE_HOME'><input class='inputsubmit' type='submit' id='submitstart3' name='submitstart3' value='$L_BUTTON_END'></a>");
}

echo("<script>");
echo("</script>");

echo("</div>");
echo("<footer>");
echo("  <ul class='sidenav'><li>$COPYRIGHT</li></ul></div>");
echo("</footer>");


?>

<style>

body {
    margin:0px;
    font-size:16px;
}


.all-page {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}


.content {
    margin:20px;
    padding:20px;
    flex: 1 0 auto;
}

.menu {
    margin:0;
    padding:0;
}

footer {
    margin: 0;
    padding: 0;
    background-color: #333;
    display: block;
    color: white;
    padding-left: 20px;
    cursor:default;
}

p a{
    display: inline-block;
    color: black;
    text-align: center;
    padding-left: 14px;
    text-decoration: none;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a, .dropbtn{
    display: inline-block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover, .dropdown:hover .dropbtn {
    background-color: red;
}

li.dropdown {
    display: inline-block;
}

@media screen (max-width: 2900px) {
    ul.sidenav {
        width: 100%;
        height: auto;
        position: relative;
    }
    ul.sidenav li a {
        float: left;
        padding: 15px;
    }
    div.content {margin-left: 0;}
}

li:last-child {
    border-right: none;
}

hr{
    width:80%;
    border-top: 1px solid lightgray;
}

.red{
    background:red !important;
}

input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.inputsubmit5{
    width:5% !important;
}

.inputsubmit40{
    width:30% !important;
}

.inputsubmit40r{
    width:30% !important;
    background-color: red !important;
}

.inputsubmitr{
    background-color: red !important;
}

.inputsubmitg{
    background-color: grey !important;
}

.inputbutton {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

.spaceline {
   padding-top:25px;
}

.spaceline50 {
   padding-top:50px;
}

.spaceline100 {
   padding-top:100px;
}
</style>

<?php


echo("</body></html>");

?>
