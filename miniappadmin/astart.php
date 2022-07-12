<?php

 #
 # MiniApps - admin
 #
 # info: main folder copyright file
 #
 #

# load config
if (file_exists("aconfig.php")){
	include("aconfig.php");
}

# load config
if (file_exists("$MA_MALOCATION/config/config.php")){
	include("$MA_MALOCATION/config/config.php");
}
if (file_exists("$MA_ADMIN_DIR/acfg.php")){
	include("$MA_ADMIN_DIR/acfg.php");
}
# load language file
if (file_exists("$MA_MALOCATION/$MA_CONFIG_DIR/$MA_LANGFILE")){
	include("$MA_MALOCATION/$MA_CONFIG_DIR/$MA_LANGFILE");
}
# load admin language file
if (file_exists("$MA_ADMIN_DIR/$MA_LANGFILE")){
	include("$MA_ADMIN_DIR/$MA_LANGFILE");
}

# libraries
for ($i=0;$i<count($MA_LIB);$i++){
	if (file_exists("$MA_MALOCATION/$MA_LIB[$i]")){
		include("$MA_MALOCATION/$MA_LIB[$i]");
	}
}


#setcookienames();

# css setting
setcss();

# login
login();

# build page: header
page_header();

# load admin files
for ($i=0;$i<count($MA_ADMIN_FILE);$i++){
	if (file_exists("$MA_ADMIN_FILE[$i]")){
		include("$MA_ADMIN_FILE[$i]");
	}
}

if (($MA_LOGGEDIN)and($MA_ADMIN_USER)){
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
	    }else{
	        button_back_logout();
	    }
	}

}else{
    if ($MA_LOGGEDIN){
        button_back_logout();
    }else{
        login_form();
    }
}

# end local app file


# page end
page_footer();

?>
