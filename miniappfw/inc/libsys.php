<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #


function cookie_load(){
}


function update_system(){;
    global $MA_COOKIE_UPDATE,$MA_UPDATE_FILE,$MA_UPDATE_CHECK_DAYS;

	if (!isset($_COOKIE[$MA_COOKIE_UPDATE])){
        if (update_check()){
            if(update_download()){
                update_sys();
                if(function_exists("sql_install")){
                    sql_install();
                    sql_update();
                }
            }
        }
        $t=$MA_UPDATE_CHECK_DAYS*86400;
		setcookie($MA_COOKIE_UPDATE, $MA_UPDATE_FILE, ['expires'=>time()+$t,'samesite'=>'Strict']);
		#echo(date('Y.m.d')." - $MA_UPDATE_FILE");
    }
}


function update_check(){
    global $MA_VERSION,$MA_UPDATE_SRC,$MA_UPDATE_EXT,$MA_UPDATE_FILE;

    $opt=array(
        "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
        ),
    );
    $ret=false;
    $wp=file_get_contents("$MA_UPDATE_SRC",false,stream_context_create($opt));
    $l=explode(PHP_EOL,$wp);
    for($i=0;$i<count($l);$i++){
        $p=stripos($l[$i],$MA_UPDATE_EXT);
        if($p<>0){
            $x=substr($l[$i],$p-strlen($MA_VERSION),strlen($MA_VERSION)+strlen($MA_UPDATE_EXT));
            $x2=substr($x,0,strlen($x)-strlen($MA_UPDATE_EXT));
            if ($x2>$MA_VERSION){
                $MA_UPDATE_FILE=$x;
                $ret=true;
            }
        }
    }
    return($ret);
}


function update_download(){
    global $MA_UPDATE_SRC,$MA_CONFIG_DIR,$MA_UPDATE_FILE;

    $ret=false;
    if ($MA_UPDATE_FILE<>""){
        $filed=$MA_UPDATE_SRC."/".$MA_UPDATE_FILE;
        $opt=array(
            "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
            ),
        );
        if(file_put_contents($MA_CONFIG_DIR."/".$MA_UPDATE_FILE,file_get_contents($filed,false,stream_context_create($opt)))){
            $ret=true;
        }
    }
    return($ret);
}


function update_sys(){
    global $MA_CONFIG_DIR,$MA_UPDATE_FILE,$MA_SERVER_DIR,$L_UPDATE_ERROR;

    $ok=true;
    $f=$MA_CONFIG_DIR."/".$MA_UPDATE_FILE;
    $ft=substr($f,0,strlen($f)-3);
    if (file_exists($ft)){
        unlink($ft);
    }
    try{
        $p=new PharData("$f");
        $p->decompress();
        $pt=new PharData($ft);
        $pt->extractTo("$MA_SERVER_DIR/",null,true  );
    }catch (exception $e){
	    echo(date('Y.m.d')." - $MA_UPDATE_FILE - $f - $ft - $MA_SERVER_DIR - $L_UPDATE_ERROR");
        $ok=false;
    }
    unlink($f);
    unlink($ft);
    if($ok){
        header("Refresh:0");
    }
}


?>
