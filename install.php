<?php

 #
 # MiniSys - install app
 #
 # info: main folder copyright file
 #
 #
 
$INSTALL_APP_URL="http://localhost/~peter/minisys/install/sys_install.php.src";
$INSTALL_APP_LOCAL_FILE="./sys_install.php";

if (file_exists($INSTALL_APP_LOCAL_FILE)){
	#$d=date('YmdGis');
	#rename($INSTALL_APP_LOCAL_FILE,$INSTALL_APP_LOCAL_FILE.'.'.$d);
	unlink($INSTALL_APP_LOCAL_FILE);
}

$data=file_get_contents($INSTALL_APP_URL);
file_put_contents($INSTALL_APP_LOCAL_FILE, $data);

if (file_exists($INSTALL_APP_LOCAL_FILE)){
	include($INSTALL_APP_LOCAL_FILE);
}else{
	echo("Error!");
}



?>
