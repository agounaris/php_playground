<?php 

$url = $_POST['url'];

$temp = array(
	'url'=>$url,
	'text'=>'this is google', 
	'image'=>'google.png'
);

$send = array(
	$temp, 
	$temp, 
	$temp,
	$temp, 
	$temp, 
	$temp,
	$temp, 
	$temp, 
	$temp,
	$temp, 
	$temp, 
	$temp,
	$temp, 
	$temp, 
	$temp,
	$temp, 
	$temp, 
	$temp,
	$temp, 
	$temp, 
	$temp,
	$temp, 
	$temp, 
	$temp,
	$temp, 
	$temp, 
	$temp,
	$temp, 
	$temp, 
	$temp,
	$temp, 
	$temp, 
	$temp,
	$temp, 
	$temp, 
	$temp,
	$temp, 
	$temp, 
	$temp,
);

$response = json_encode($send);

echo $response;