<?php

 #
 # MiniSys - packer/unpacker app
 #
 # info: main folder copyright file
 #
 # usage: php unpack.php file.tar.gz directory_to_unpack

$COPYRIGHT="© 2019. <a href=https://github.com/pphome2/minisys>MiniSys</a>";

$MS_PACKAGE_FILE="";

$MS_DEST_DIR="data";
$MS_DELETE_PACKAGE=false;

if (isset($argv[1])){
	if (substr($argv[1],strlen($argv[1])-7,7)==".tar.gz"){
		$MS_PACKAGE_FILE=$argv[1];
	}else{
		$MS_DEST_DIR=$argv[1];
	}
}

if (isset($argv[2])){
	$MS_DEST_DIR=$argv[2];
	if (!is_dir($argv[2])){
		mkdir($argv[2]);
	}
}
if ($MS_DEST_DIR==""){
	$MS_DEST_DIR=".";
}

if ($MS_PACKAGE_FILE==""){
	$d=date('Ymd').".tar.gz";
}else{
	$d=$MS_PACKAGE_FILE;
}

$d2=str_replace('.gz','',$d);

if (substr($d,strlen($d)-3,3)==".gz"){
	if (file_exists($d2)){
		unlink($d2);
	}
	$phar=new PharData($d);
	$phar=$phar->decompress();
}

$phar2=new PharData($d2, RecursiveDirectoryIterator::SKIP_DOTS);
$phar2=$phar2->extractTo($MS_DEST_DIR,null,true);

if ($MS_DELETE_PACKAGE){
	if (file_exists($d)){
		unlink($d);
	}
	if (file_exists($d2)){
		unlink($d2);
	}
}

?>
