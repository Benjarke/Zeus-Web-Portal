<?php

include_once ("../../config/config.php");

$id = $_GET['id'];

$arr = array('command' => 'get', 'target' => 'location');
$action = json_encode($arr);

$query = "UPDATE ZeusUsers SET action = '$action' WHERE notification_id = '$id'";
$result = mysqli_query($link,$query) or exit("Error in query: $query. " . mysqli_error());

/////////////////////////////////////////////////////////////////////

// API access key from Google API's Console
define( 'API_ACCESS_KEY', 'AIzaSyAi9rspkTspOoOfC9RlI3Fp68ybg9WGFSU' );

$registrationIds = array( $_GET['id'] );

// prep the bundle
$msg = array('command' => 'get', 'target' => 'location');

$fields = array
(
	'registration_ids' 	=> $registrationIds,
	'data'			=> $msg
);
 
$headers = array
(
	'Authorization: key=' . API_ACCESS_KEY,
	'Content-Type: application/json'
);
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );

//echo $result;
header("Location: ../../portal.php");
?>