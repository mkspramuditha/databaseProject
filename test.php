<?php

class test{

function echo_this($text){
echo $text;
}

function get_method($method){
$object = $this;
return function() use($object, $method){
$args = func_get_args();
return call_user_func_array(array($object, $method), $args);
};
}
}

$test = new test();
$echo = $test->get_method('echo_this');
$echo('Hello');  //Output is "Hello"