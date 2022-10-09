<?php
$session_token = bin2hex(openssl_random_pseudo_bytes(16));
$data['token'] = $session_token;
$data['name'] = $name;

$redis = new Predis\Client();
$redis->connect('127.0.0.1', 6379);

$redis_key =  $data['name'];

// $redis->set($redis_key, $data['name']);
$redis->set($redis_key, serialize($data)); 
// $redis->expire($redis_key, 360);   
$data['redis_key'] = $redis_key;               

?>