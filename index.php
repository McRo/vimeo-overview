<?php
require_once 'config.php';
require 'vendor/autoload.php';

function console($data) {
    echo("<script>");
    //echo("console.log('PHP DEBUG');");
    echo("console.log(".json_encode($data).");");
    echo("</script>");
}


use Vimeo\Vimeo;

$client = new Vimeo($client_id, $client_secret, $access_token);

$uri = "/me/albums?per_page=100";

$uri = "/me/videos/";

$paging = 1;
$arg = ['per_page' => $paging];
$req = $client->request($uri, $arg, "GET");

console($req["body"]);
$i = 0;
$istop = 2;

$videos = [];

while ($uri) {

    $videos = array_merge($videos, $req["body"]["data"]);
    
    $uri = $req["body"]["paging"]["next"];
    $req = $client->request($uri, [], "GET");

    if($i >= $istop){
        console(" break $i");
        break;
    }
}

console("videos");
console($videos);


?>