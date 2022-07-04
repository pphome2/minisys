<?php

 #
 # MiniApps - subsite
 #
 # info: main folder copyright file
 #
 #


# load config
if (file_exists("config/config.php")){
	include("config/config.php");
}
# load language file
if (file_exists("$MA_MINIAPP_DIR/$MA_CONFIG_DIR/$MA_LANGFILE")){
	include("$MA_MINIAPP_DIR/$MA_CONFIG_DIR/$MA_LANGFILE");
}

$bn=basename($_SERVER['PHP_SELF']);
if (file_exists("$MA_MINIAPP_DIR/$bn")){
	include("$MA_MINIAPP_DIR/$bn");
}

?>
