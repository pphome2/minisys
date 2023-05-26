<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #

# configuration

$MA_MINIAPP_DIR="../miniappfw";

if (file_exists("$MA_MINIAPP_DIR/config/config.php")){
    include("$MA_MINIAPP_DIR/config/config.php");
}

# directories
$MA_CONFIG_DIR="config";
$MA_INCLUDE_DIR=$MA_MINIAPP_DIR."/inc";
$MA_CONTENT_DIR="content";
$MA_PLUGIN_DIR=$MA_MINIAPP_DIR."/plugins";

# local app main php files (no css or js)
$MA_APPFILE=array(
				"democfg.php",
				"demo.php",
				"$MA_LANGFILE"
			);
# local css files
$MA_APPCSSFILE=array(
                "demo.css",
                "demo.css"
            );
# local js files
$MA_APPJSFILE=array(
                "demo.js"
            );


?>
