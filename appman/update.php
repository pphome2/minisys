<?php

 #
 # AppMan - install/update/config app
 #
 # info: main folder copyright file
 #
 #

$SOURCE_PACKAGE="";

if (file_exists("appman.php")){
	include("appman.php");
}else{
	$SOURCE_PACKAGE="http://localhost/~peter/www/minisys/appman/files/mini.tar.gz";
	$APP_FILE=array("appman.tar.gz","http://localhost/~peter/www/minisys/appman/files/appman.tar.gz");
	$APP_DIR="appman";
	$dir=getcwd();
	$dir=substr($dir,strlen($dir)-strlen($APP_DIR),strlen($APP_DIR));
	if ($dir<>$APP_DIR){
		if (!is_dir($APP_DIR)){
			mkdir($APP_DIR);
		}
		chdir($APP_DIR);
	}

	if (copy($APP_FILE[1],$APP_FILE[0])){
		foreach(glob("*.php") as $filename){
			unlink($filename);
		}
		foreach(glob("*.css") as $filename){
			unlink($filename);
		}
		foreach(glob("*.png") as $filename){
			unlink($filename);
		}
		$phar=new PharData($APP_FILE[0]);
		$phar=$phar->decompress();
		$f2=str_replace('.gz','',$APP_FILE[0]);
		$phar2=new PharData($f2, RecursiveDirectoryIterator::SKIP_DOTS);
		$phar2=$phar2->extractTo(".",null,true);
		unlink($APP_FILE[0]);
		unlink($f2);
	}
	if (file_exists("appman.php")){
		include("appman.php");
	}else{
		echo("Error!");
	}
}

?>
