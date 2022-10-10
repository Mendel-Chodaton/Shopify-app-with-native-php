<?php

// Get our helper functions
require_once("inc/functions.php");
require_once("inc/mysql_connect.php");

// Set variables for our request
$api_key = "fed84fb1de3ac093a881476c9a20f5de";
$shared_secret = "fa011f06990cb67830d8a3c449deb568";
$params = $_GET; // Retrieve all request parameters
$hmac = $_GET['hmac']; // Retrieve HMAC request parameter
$shop_url = $params['shop'];
// $redirect_uri = . "index.php";

$params = array_diff_key($params, array('hmac' => '')); // Remove hmac from params
ksort($params); // Sort params lexographically

// Compute SHA256 digest
$computed_hmac = hash_hmac('sha256', http_build_query($params), $shared_secret);

// Use hmac data to check that the response is from Shopify or not
if (hash_equals($hmac, $computed_hmac)) {
	// VALIDATED
} else {
	// NOT VALIDATED – Someone is trying to be shady!
}
	// Set variables for our request

$query = array(
  "client_id" => $api_key, // Your API key
  "client_secret" => $shared_secret, // Your app credentials (secret key)
  "code" => $params['code'] // Grab the access key from the URL
);

// Generate access token URL
$access_token_url = "https://" . $params['shop'] . "/admin/oauth/access_token";

// Configure curl client and execute request
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $access_token_url);
curl_setopt($ch, CURLOPT_POST, count($query));
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($query));
$result = curl_exec($ch);
curl_close($ch);

// Store the access token
$result = json_decode($result, true);
$access_token = $result['access_token'];

// Show the access token (don't do this in production!)
	 // echo $access_token;
$sql = "INSERT INTO shops (shop_url, access_token, install_date) VALUES ('" . $params['shop'] . "','". $access_token ."',NOW())";
  
if(mysqli_query($conn, $sql)) {


if( !isset( $_GET['charge_id']) ) {

$recurring_array = array(
  "recurring_application_charge" => array(
  "name" => "App charge", 
  "price" => 99,
  "status" => "accepted",
  "test" => true,
  "trial_days" => 14,
  "return_url" => "https://" . $shop_url . "/admin/apps/combo-app-1/?"
   )
);

$reccuring_charge = shopify_call($access_token, $shop_url, "/admin/api/2022-04/recurring_application_charges.json", $recurring_array, "POST");
$reccuring_charge = json_decode( $reccuring_charge['response'], JSON_PRETTY_PRINT);

header('Location: ' . $reccuring_charge['recurring_application_charge']['confirmation_url'] );
exit();

 }else{
 $charge_id = $_GET['charge_id'];
 
 $array = array(
  "recurring_application_charge" => array(
  "id" => $charge_id,
  "name" => "Ordyinx charge", 
  "api_client_id" => rand(1000000, 9999999),
  "price" => 99,
  "test" => true,
  "return_url" => "https://" . $shop_url . "/admin/apps/combo-app-1/",
  "billing_on" => null,
  "activated_on" => null,
  "trial_ends_on" => null,
  "cancelled_on" => null,
  "trial_days" => 14,
   )
);

$activate = shopify_call($access_token, $shop_url, "/admin/api/2022-04/recurring_application_charges/" . $charge_id . "/activate.json", $array, "POST");
$activate = json_decode( $activate['response'], JSON_PRETTY_PRINT);

header('Location: ' . $reccuring_charge['recurring_application_charge']['confirmation_url'] );
exit();
// print_r( $activate );

}


} else {
echo "Error for inserting the access token.";
}

?>
