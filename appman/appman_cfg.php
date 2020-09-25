<?php

 #
 # AppMan - config
 #
 # info: main folder copyright file
 #
 #


# configuration

# copyright link
$AM_COPYRIGHT="© ".date("Y").". <a href=https://github.com/pphome2>Github</a>";

# title, home link
$AM_NAME="AppMan";

# directories
$AM_DATA_DIR="data";
$AM_CSS="appman_w.css";

# files user and group
$AM_FILE_USER="www-data";
$AM_FILE_GROUP="www-data";

# language
$AM_LANGFILE="appman_hu.php";

# version info store
$AM_VERSION_DIR="config";
$AM_VERSION_FILE="version";

# saved file extension
$AM_SAVED_FILEEXT=".old";

# system config file
$AM_APPMAN_CONFIG="config.php";
$AM_SYSCONFIG_DIR="config";
$AM_SYSCONFIG_FILE="config_sys.php";

# copy old config data to updated
$AM_COPY_OLDCONFIG=true;

# backup/restore
$AM_BACKUP_FILE="backup.php";
$AM_BACKUP_DIR="files";
$AM_BACKUP_LETTER="backup-";

# sql backup/restore is part of installed app
# backup/estore only include this file
$AM_SQL_BACKUP="../config/sqlbackup.php";
$AM_SQL_RESTORE="../config/sqlrestore.php";

?>
