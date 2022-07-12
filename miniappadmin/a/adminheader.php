<?php

 #
 # MiniApps - admin
 #
 # info: main folder copyright file
 #
 #


echo($MA_DOCTYPE);

echo("<html>");

echo("<head>");
echo("<title>$MA_TITLE</title>");
echo("<meta charset=\"utf-8\" />");
echo("<meta http-equiv=\"Content-Type\" content=\"text/html;charset=UTF-8\" />");
echo("<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />");
echo("<link rel=\"icon\" href=\"$MA_FAVICON\" />");
echo("<link rel=\"shortcut icon\" type=\"image/png\" href=\"$MA_FAVICON\" />");

echo("<style>");
if (file_exists($MA_CSS[0])){
    include("$MA_CSS[0]");
}
echo("</style>");

echo("</head>");

echo("<body>");

echo("<div class=all-page>");

echo("<header>");
echo("<div class=\"menu\">");
echo("<ul class=\"sidenav\">");
echo("<li><a href=\"$MA_MALOCATION/$MA_ADMINFILE\">$MA_SITENAME</a></li>");
echo("</ul>");
echo("</div>");
echo("</header>");

echo("<div class=\"content\">");

?>
