<?php

namespace AppBundle\Api;

//$request = $_POST['data'];
$post = array("data"=>"shan");
$string = http_build_query($post);
//    'data' => '{"username":"shan","password":"shan"}',
//
//];


$ch = curl_init('http://localhost/databaseProject/web/app_dev.php/api/test');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
//curl_setopt($ch,CURLOPT_HEADER, false);
//curl_setopt($ch, CURLOPT_POST, count($post));


$response = curl_exec($ch);

curl_close($ch);

//var_dump($response);

?>

