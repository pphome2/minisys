<?php

 #
 # MiniSys - update app
 #
 # info: main folder copyright file
 #
 #
 
$UPDATE_APP_URL="http://localhost/~peter/minisys/update/sys_update.php.src";
$UPDATE_APP_LOCAL_FILE="./sys_update.php";

if (file_exists($UPDATE_APP_LOCAL_FILE)){
	#$d=date('YmdGis');
	#rename($UPDATE_APP_LOCAL_FILE,$UPDATE_APP_LOCAL_FILE.'.'.$d);
	unlink($UPDATE_APP_LOCAL_FILE);
}

$data=file_get_contents($UPDATE_APP_URL);
file_put_contents($UPDATE_APP_LOCAL_FILE, $data);

if (file_exists($UPDATE_APP_LOCAL_FILE)){
	include($UPDATE_APP_LOCAL_FILE);
}else{
	echo("Error!");
}



?>
