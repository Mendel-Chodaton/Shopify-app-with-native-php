<?php
define('SHOPIFY_APP_SECRET_KEY', 'fa011f06990cb67830d8a3c449deb568');

function verify_request($data, $hmac)
{
  $verify_hmac = base64_encode( hash_hmac('sha256', $data, SHOPIFY_APP_SECRET_KEY, true));
  return hash_equals($hmac, $verify_hmac);
}

$my_hmac = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];

$response = '';
$data = file_get_contents('php://input');
$utf8 = utf8_encode( $data );
$data_json = json_decode( $utf8, true );

$verify_merchant = verify_request( $data, $my_hmac );

error_log('Webhook verified: '.var_export($verify_merchant, true));

if( $verify_merchant ) {
 $response = $data_json;
} else {
 $response = 'NOT FROM SHOPIFY.';
}

$shop_domain = $_SERVER['HTTP_X_SHOPIFY_SHOP_DOMAIN'];
$log = fopen( $shop_domain . ".txt", "w") or die("Cannot open or create this file");
fwrite( $log, json_encode($response) );
fclose( $log );

?>

























