<?php
header("HTTP/1.1 200 OK");
ob_start();
var_dump($_POST);
$out = ob_get_clean();
$file = fopen("test.txt","a");
fwrite($file,"-------------------------------------------- \r\n");
fwrite($file,"".$out." \r\n");
