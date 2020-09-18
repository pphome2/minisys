<?php

 #
 # AppMan - install app
 #
 # info: main folder copyright file
 #
 #

$APP_URL="";

if (file_exists($APP_URL."appman_cfg.php")){
	include($APP_URL."appman_cfg.php");
}else{
	echo("Error!");
	exit();
}

if (file_exists($APP_URL.$AM_LANGFILE)){
	include($APP_URL.$AM_LANGFILE);
}

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo($AM_NAME); ?></title>
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" href="<?php echo($APP_URL); ?>favicon.png">
		<link rel="shortcut icon" type="image/png" href="<?php echo($APP_URL); ?>favicon.png" />
		<style>	<?php include($AM_CSS); ?></style>
	</head>
<body>
	<div class=all-page>
<header>
	<ul class="sidenav">
		<li class="padleft"><a href="" onclick="return false;"><?php echo($L_APPNAME); ?></a></li>
	</ul>
</header>
	<div class="content">


<?php

if (!isset($INSTALLER)){
	$INSTALLER=true;
}

if ($INSTALLER){
	echo("Inst");
}else{
	echo("Upd");
}


?>

	</div>
<footer>
	<ul class="sidenav">
		<li class="padleft"><?php echo($AM_COPYRIGHT); ?></li>
	</ul>
</footer>
</body>
</html>
