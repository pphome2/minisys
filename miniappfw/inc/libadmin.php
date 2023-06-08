<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #


# cookie system start
function startcookies(){
	setcookienames();
	getcookies();
}


# cookie data field
function cookiedata($n){
    global $MA_COOKIES;

    $d="";
    $cdb=count($MA_COOKIES);
    $i=0;
    $c=$MA_COOKIES[$i];
    while(($c[0]<>$n)and($i<$cdb)){
        $i++;
        $c=$MA_COOKIES[$i];
    }
    if($c[0]===$n){
        $d=$c[1];
    }
    return($d);
}


# load, get cookies
function getcookies($n=""){
	global $MA_COOKIES;

	$d="";
	if ($n<>""){
		if (isset($_COOKIE["$n"])){
			$d=$_COOKIE["$n"];
		}
	}else{
		$cdb=count($MA_COOKIES);
		for($i=0;$i<$cdb;$i++){
			$ac=$MA_COOKIES[$i];
			$acname=$ac[0];
			if(isset($_COOKIE[$acname])) {
				$acdata=$_COOKIE[$acname];
			}else{
				$acdata="";
			}
			$MA_COOKIES[$i]=array($acname,$acdata,$ac[2]);
		}
	}
	return($d);
}


# store cookie
function setcookies($n="",$d="",$td=1){
	global $MA_COOKIES;

	if ($n<>""){
		$t=$td*86400;
	    setcookie($n,$d,['expires'=>time()+$t,'samesite'=>'Strict']);
	}else{
		$cdb=count($MA_COOKIES);
		for($i=0;$i<$cdb;$i++){
			$ac=$MA_COOKIES[$i];
			$n=$ac[0];
			$d=$ac[1];
			$td=$ac[2];
      		$t=$td*86400;
            setcookie($n,$d,['expires'=>time()+$t,'samesite'=>'Strict']);
		}
	}
}


# cookie names settings
function setcookienames(){
    global $MA_CODENAME,$MA_COOKIE_STYLE,$MA_COOKIE_LOGIN,$MA_COOKIE_UPDATE;

    $MA_COOKIE_STYLE=$MA_CODENAME."-".$MA_COOKIE_STYLE;
    $MA_COOKIE_LOGIN=$MA_CODENAME."-".$MA_COOKIE_LOGIN;
    $MA_COOKIE_UPDATE=$MA_CODENAME."-".$MA_COOKIE_UPDATE;
}


# cookie names settings
function setcookienamesfromdir(){
    global $MA_CODENAME,$MA_COOKIE_STYLE,$MA_COOKIE_LOGIN,$MA_COOKIE_UPDATE;

    $p=explode('/',(dirname(__FILE__)));
    if (count($p)>=2){
        $px=$p[count($p)-2];
    }else{
        $px="";
    }
    $MA_COOKIE_STYLE=$px."-".$MA_COOKIE_STYLE;
    $MA_COOKIE_LOGIN=$px."-".$MA_COOKIE_LOGIN;
    $MA_COOKIE_UPDATE=$px."-".$MA_COOKIE_UPDATE;
}


# preivois page
function refererpage(){
    $mainp=basename($_SERVER['REQUEST_URI']);
    if (isset($_POST['referer'])){
        $mainp=$_POST['referer'];
    }
    return($mainp);
}


# load plugins
function plugins(){
    global $MA_PLUGINS,$MA_PLUGIN_DIR;

    for($i=0;$i<count($MA_PLUGINS);$i++){
        $fnx=basename($MA_PLUGINS[$i]);
        $fn="$MA_PLUGIN_DIR/$MA_PLUGINS[$i]/$fnx".'.php';
        if (file_exists($fn)){
            include($fn);
        }
        $fn="$MA_PLUGIN_DIR/$MA_PLUGINS[$i]/$fnx".'.css';
        if (file_exists($fn)){
            include($fn);
        }
        $fn="$MA_PLUGIN_DIR/$MA_PLUGINS[$i]/$fnx".'.js';
        if (file_exists($fn)){
            include($fn);
        }
    }
}


# load one plugin
function loadplugin($p){
    global $MA_PLUGINS,$MA_PLUGIN_DIR;

    $fn="$MA_PLUGIN_DIR/$p/$p".'.php';
    if (file_exists($fn)){
        include($fn);
    }
    $fn="$MA_PLUGIN_DIR/$p/$p".'.css';
    if (file_exists($fn)){
        include($fn);
    }
    $fn="$MA_PLUGIN_DIR/$p/$p".'.js';
    if (file_exists($fn)){
        include($fn);
    }
}



# cookies or param
function setcss(){
	global $MA_STYLEINDEX,$MA_COOKIE_STYLE,$MA_CSS;

    if (isset($_COOKIE[$MA_COOKIE_STYLE])){
   		$MA_STYLEINDEX=intval(vinput($_COOKIE[$MA_COOKIE_STYLE]));
	}
	if ($MA_STYLEINDEX>count($MA_CSS)){
		$MA_STYLEINDEX=0;
	}
}


# login from cookie or param
function login(){
	global $MA_LOGGEDIN,$MA_COOKIE_LOGIN,$MA_ROLE,$MA_SQL_RESULT,$MA_USERNAME,
			$MA_ADMIN_USER,$MA_COOKIE_PASS,$MA_COOKIE_USER;

	$MA_LOGGEDIN=false;
	$MA_ROLE="9999";
	$pass="";
	$user="";

	if (isset($_COOKIE[$MA_COOKIE_LOGIN])){
        $user=$_COOKIE[$MA_COOKIE_LOGIN];
	}else{
		if (isset($_POST["$MA_COOKIE_PASS"])){
			$pass=$_POST["$MA_COOKIE_PASS"];
			$pass=vinput($pass);
		}
		if (isset($_POST["$MA_COOKIE_USER"])){
			$user=$_POST["$MA_COOKIE_USER"];
			$user=vinput($user);
		}
	}
	if ($user<>""){
    	$sqlc="select * from mfw_users where name = \"$user\";";
	    sql_run($sqlc);
    	$rsql=$MA_SQL_RESULT;
	    for($i=0;$i<count($rsql);$i++){
	        $r=$rsql[$i];
    	    if ($pass<>""){
        	    if (($user===$r[1])and(password_verify($pass,$r[2]))){
	  	        	$MA_LOGGEDIN=true;
	  	        	$MA_USERNAME=$r[1];
	            	$MA_ROLE=$r[3];
    	        }
	        }else{
    	        if ($user===$r[1]){
	  	        	$MA_USERNAME=$r[1];
	  	        	$MA_LOGGEDIN=true;
    	        	$MA_ROLE=$r[3];
	            }
	        }
    	    if(password_needs_rehash($r[2],PASSWORD_DEFAULT)){
	            $r[2]=password_hash($r[2],PASSWORD_DEFAULT);
		    	$sqlc="update mfw_users set";
			    $sqlc=$sqlc." id = ".$r[0].", ";
    			$sqlc=$sqlc." name = \"$r[1]\", ";
	    		$sqlc=$sqlc." pass = \"$r[2]\", ";
		    	$sqlc=$sqlc." role = \"$r[3]\", ";
    			$sqlc=$sqlc." email = \"$r[4]\", ";
	    		$sqlc=$sqlc." comm = \"$r[5]\" ";
		    	$sqlc=$sqlc." where id=$r[0];";
    			sql_run($sqlc);
	        }
    	}
    }
    # admin
    if (($MA_LOGGEDIN)and($MA_ROLE==="0")){
      		$MA_ADMIN_USER=true;
	}
	# set cookie
	if ($MA_LOGGEDIN){
		#setcookie($MA_COOKIE_LOGIN, $user, ['expires'=>time()+6000,'samesite'=>'Strict']);
		setcookie($MA_COOKIE_LOGIN, $user, ['expires'=>0,'samesite'=>'Strict']);
		#setcookie($MA_COOKIE_LOGIN, $user, ['expires'=>strtotime("+1 day"),'samesite'=>'Strict']);
	}else{
		setcookie($MA_COOKIE_LOGIN, "", ['expires'=>-1,'samesite'=>'Strict']);
	}
}


# logout: cookie delete
function logout(){
	global $MA_LOGGEDIN,$MA_COOKIE_LOGIN,$L_LOGOUT;

	$MA_LOGGEDIN=false;
	#setcookie($MA_COOKIE_LOGIN, "", time() - 3600);
    echo("<script>
        document.cookie='$MA_COOKIE_LOGIN=$L_LOGOUT; expires=Thu, 01 Jan 1970 00:00:00 UTC;samesite=Strict;';
        </script>");
}


?>
