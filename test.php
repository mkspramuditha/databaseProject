<?php
//// decoding the json array
//$post = json_decode(file_get_contents("php://input"), true);
//
//// getting the information from the array
//// in the android example I've defined only one KEY. You can add more KEYS to your app
//
//$my_value = $post['data'];
//var_dump($post);
//var_dump("Hii");
//var_dump($my_value);
//var_dump($my_value->username);
//exit;
//
//// the "params1" is from the map.put("param1", "example"); in the android code
//// if you make a "echo $my_value;" it will return a STRING value "example"

var_dump($_POST['data']);
