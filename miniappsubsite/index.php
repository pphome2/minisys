<?php

 #
 # MiniApps - SubSite Starter
 #
 # info: main folder copyright file
 #
 #


# load config and language file
if (file_exists("config/config.php")){
    include("config/config.php");
}
if (file_exists("$MA_MINIAPP_DIR/$MA_CONFIG_DIR/$MA_LANGFILE")){
    include("$MA_MINIAPP_DIR/$MA_CONFIG_DIR/$MA_LANGFILE");
}

for ($i=0;$i<count($MA_LIB);$i++){
	if (file_exists("$MA_INCLUDE_DIR/$MA_LIB[$i]")){
		include("$MA_INCLUDE_DIR/$MA_LIB[$i]");
	}
}

# local app files
for ($i=0;$i<count($MA_APPFILE);$i++){
	if (file_exists("$MA_CONTENT_DIR/$MA_APPFILE[$i]")){
		include("$MA_CONTENT_DIR/$MA_APPFILE[$i]");
	}
}

#setcookienames();
plugins();

# user/admin menu start
if (isset($_GET["$MA_MENU_FIELD"])){
	$param=$_GET["$MA_MENU_FIELD"];
    if (function_exists($param)){
		$param();
  	}else{
	    if (function_exists("main")){
		    main();
	    }
	}
}else{
    if (function_exists("main")){
	    main();
    }
}

?>
