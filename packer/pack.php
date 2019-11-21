<?php

 #
 # MiniSys - packer/unpacker app
 #
 # info: main folder copyright file
 #
 # usage: php pack.php directory_name file_name
 #

$COPYRIGHT="© 2019. <a href=https://github.com/pphome2/minisys>MiniSys</a>";

$MS_DIR="";
$MS_ONLY_GZ=false;

$d=date('Ymd');

if (isset($argv[1])){
	if (is_dir($argv[1])){
		$MS_DIR=$argv[1];
	}
}

if ($MS_DIR==""){
	$MS_DIR=".";
}

if (isset($argv[2])){
	$d=str_replace('.tar','',$argv[2]);
	$d=str_replace('.gz','',$d);
}

if (file_exists($d.".tar")){
	unlink($d.".tar");
}
if (file_exists($d.".tar.gz")){
	unlink($d.".tar.gz");
}

$phar=new PharData($d.".tar");
$phar->buildFromDirectory($MS_DIR);

$phar2=new PharData($d.".tar");
$phar2=$phar2->compress(Phar::GZ);

if ($MS_ONLY_GZ){
	if (file_exists($d.".tar")){
		unlink($d.".tar");
	}
}

?>