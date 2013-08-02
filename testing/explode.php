<?php  


$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

echo $url;

echo "<br/><br/>";

echo $_SERVER['REQUEST_URI'];

$rquest = $_SERVER['REQUEST_URI'];

echo "<br/><br/>";

echo explode("&", $rquest);

echo "<br/><br/>";

print_r(parse_url($url));

//echo parse_url($url, PHP_URL_PATH);

?>