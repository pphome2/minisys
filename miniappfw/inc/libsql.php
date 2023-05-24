<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #

mysqli_report(MYSQLI_REPORT_OFF);

# formázás
function sqlinput($d){
  $d=trim($d);
  $d=stripslashes($d);
  $d=strip_tags($d);
  #$d=htmlspecialchars($d);
  return($d);
}


# sql parancs futtatása az sql szerveren
function sql_run($sqlcomm="",$html=false){
  global $MA_SQL_SERVER,$MA_SQL_DB,$MA_SQL_USER,$MA_SQL_PASS,$MA_SQL_ERROR,
        $MA_SQL_RESULT,$MA_SQL_ERROR_ECHO;

  $ret=false;
  if (function_exists('mysqli_connect')){
    if ($sqlcomm<>""){
      if (!$html){
        $sqlcomm=sqlinput($sqlcomm);
      }
      $MA_SQL_ERROR="";
      $MA_SQL_RESULT=array();
      $sqllink=mysqli_connect("$MA_SQL_SERVER","$MA_SQL_USER","$MA_SQL_PASS","$MA_SQL_DB");
      $MA_SQL_ERROR=mysqli_error($sqllink);
      if ($MA_SQL_ERROR===""){
        $result=mysqli_query($sqllink,$sqlcomm);
        $MA_SQL_ERROR=mysqli_error($sqllink);
        if ($MA_SQL_ERROR===""){
          if (!is_bool($result)){
            if ($MA_SQL_ERROR===""){
              $i=0;
              while($row=mysqli_fetch_row($result)){
                $MA_SQL_RESULT[$i]=$row;
                $i++;
              }
              $ret=true;
            }
          }else{
              $MA_SQL_ERROR=mysqli_error($sqllink);
              $ret=$result;
          }
        }
        mysqli_close($sqllink);
      }
    }
  }
  if (($MA_SQL_ERROR<>"")and($MA_SQL_ERROR_ECHO)){
    echo("$sqlcomm\n");
    echo("$MA_SQL_ERROR\n");
  }
  return($ret);
}


# többszörös utasítás futtatása SQL szerveren
function sql_multi_run($sqlcomm=""){
  global $MA_SQL_SERVER,$MA_SQL_DB,$MA_SQL_USER,$MA_SQL_PASS,$MA_SQL_ERROR,$MA_SQL_RESULT;

  if (function_exists("mysqli_connect")){
    if ($sqlcomm<>""){
      $sqllink=mysqli_connect("$MA_SQL_SERVER","$MA_SQL_USER","$MA_SQL_PASS","$MA_SQL_DB");
      $MA_SQL_ERROR=mysqli_error($sqllink);
      if ($MA_SQL_ERROR===""){
        $result=mysqli_multi_query($sqllink,$sqlcomm);
        $MA_SQL_ERROR=mysqli_error($sqllink);
        mysqli_close($sqllink);
      }
      if ($MA_SQL_ERROR===""){
        return(true);
      }else{
        return(false);
      }
    }else{
      return(false);
    }
  }else{
    return(false);
  }
}


# sql kapcsolat tesztelése

function sql_test(){
  global $MA_SQL_RESULT,$MA_SQL_ERROR;

  $sqlc="show databases;";
  if (sql_run($sqlc)){
  echo("<br />SQL: $sqlc<br /><br />");
    $db=count($MA_SQL_RESULT);
    echo("DB: $db<br /><br />");
    for ($i=0;$i<$db;$i++){
      $d=$MA_SQL_RESULT[$i];
      echo($d[0]."<br />");
    }
  }else{
    echo("Error: ".$MA_SQL_ERROR);
  }
}


# sql utasítások fájlból
function sql_sqlfilemulti($sqlfile="",$sqldir=""){
  if ($sqlfile<>""){
    $line=file_get_contents("$sqlfile");
    $lines=explode(PHP_EOL,$line);
    $db=count($lines);
    $sqlc="";
    foreach ($lines as $v) {
      if (($v<>"")and(substr($v,0,1)<>"#")){
        $sqlc=$sqlc." ".$v;
        if (substr($v,strlen($v)-1,1)==";"){
          $sqlc=$sqlc."\n";
        }
      }
    }
    sql_multi_run($sqlc);
  }
}


# sql utasítások fájlból
function sql_sqlfile($sqlfile=""){
  if ($sqlfile<>""){
    $line=file_get_contents("$sqlfile");
    $lines=explode(PHP_EOL,$line);
    $db=count($lines);
    $sqlc=array();
    $i=0;
    foreach ($lines as $v) {
      if (($v<>"")and(substr($v,0,1)<>"#")){
        $sqlc[$i]=$sqlc[$i].' '.$v;
        if (substr($v,strlen($v)-1,1)==";"){
          $i++;
        }
      }
    }
    for($k=0;$k<$i;$k++){
      sql_run($sqlc[$k]);
    }
  }
}


# sql adatbázis, táblák létrehozása
function sql_install(){
  global $MA_CONFIG_DIR,$MA_SQL_INSTALL_FILE;

  if (file_exists("$MA_CONFIG_DIR/$MA_SQL_INSTALL_FILE")){
    sql_sqlfilemulti("$MA_CONFIG_DIR/$MA_SQL_INSTALL_FILE");
  }
}


# sql adatbázis, táblák frissítése
function sql_update(){
  global $MA_CONFIG_DIR,$MA_SQL_UPDATE_FILE;

  if (file_exists("$MA_CONFIG_DIR/$MA_SQL_UPDATE_FILE")){
    sql_sqlfilemulti("$MA_CONFIG_DIR/$MA_SQL_UPDATE_FILE");
  }
}


# sql adatbázis, táblák mentése
function sql_backup(){
  global $MA_CONFIG_DIR,$MA_SQL_BACKUP_FILE,$MA_SQL_RESULT;

  if (file_exists("$MA_CONFIG_DIR/$MA_SQL_BACKUP_FILE")){
    $sqlfile="$MA_CONFIG_DIR/$MA_SQL_BACKUP_FILE";
    $line=file_get_contents("$sqlfile");
    $lines=explode(PHP_EOL,$line);
    $db=count($lines);
    $ssz=0;
    for($k=0;$k<$db;$k++){
      if (($lines[$k]<>"")and(substr($lines[$k],0,1)<>"#")){
        if(sql_run($lines[$k])){
          $ol="";
          $ssz++;
          $fn=$MA_CONFIG_DIR."/".$ssz.".csv";
          if(file_exists($fn)){
            unlink($fn);
          }
          $adata=count($MA_SQL_RESULT);
          for($y=0;$y<$adata;$y++){
              $r=$MA_SQL_RESULT[$y];
              for($l=0;$l<count($r);$l++){
                $ol=$ol.$r[$l].";";
              }
              $ol=$ol.PHP_EOL;
          }
          file_put_contents($fn,$ol);
        }
      }
    }
  }
}


# sql adatbázis, táblák visszatöltése
function sql_restore(){
  global $MA_CONFIG_DIR,$MA_SQL_RESTORE_FILE,$MA_SQL_RESULT;

  if (file_exists("$MA_CONFIG_DIR/$MA_SQL_RESTORE_FILE")){
    $sqlfile="$MA_CONFIG_DIR/$MA_SQL_RESTORE_FILE";
    $line=file_get_contents("$sqlfile");
    $lines=explode(PHP_EOL,$line);
    $ssz=0;
    for($k=0;$k<count($lines);$k++){
      if (($lines[$k]<>"")and(substr($lines[$k],0,1)<>"#")){
        $t=explode(" ",$lines[$k]);
        $tablen=$t[2];
        if(sql_run("delete from $tablen;")){
          $ol="";
          $ssz++;
          $fn=$MA_CONFIG_DIR."/".$ssz.".csv";
          if(file_exists($fn)){
            $l=file_get_contents("$fn");
            $li=explode(PHP_EOL,$l);
            $db=count($li);
            for($y=0;$y<$db-1;$y++){
              $r=explode(";",$li[$y]);
              $sqlc=$lines[$k]." (";
              for($g=0;$g<count($r)-1;$g++){
                if($g>0){
                  $sqlc=$sqlc.",";
                }
                $sqlc=$sqlc."\"".$r[$g]."\"";
              }
              $sqlc=$sqlc.");";
              sql_run($sqlc);
            }
          }
        }
      }
    }
  }
}


?>
