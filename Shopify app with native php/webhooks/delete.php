<?php
include_once("inc/mysql_connect.php");
include_once("inc/functions.php");  

$shopify = $_GET;

define('SHOPIFY_APP_SECRET_KEY', 'fa011f06990cb67830d8a3c449deb568');

function verify_request($data, $my_hmac)
{
  $verify_hmac = base64_encode( hash_hmac('sha256', $data, SHOPIFY_APP_SECRET_KEY, true));
  return hash_equals($my_hmac, $verify_hmac);
}

$my_hmac = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];

$response = '';
$data = file_get_contents('php://input');

$utf8 = utf8_encode( $data );
$data_json = json_decode( $data, true );
$my_topic = $_SERVER['HTTP_X_SHOPIFY_TOPIC'];
$shop_domain = $_SERVER['HTTP_X_SHOPIFY_SHOP_DOMAIN'];
$verify_merchant = verify_request( $data, $my_hmac );

error_log('Webhook verified: '.var_export($verify_merchant, true));

if($verify_merchant) {
    if( $my_topic == 'app/uninstalled' ) {

      $sql = "DELETE * FROM shops WHERE shop_url='".$shopify['shop']."' LIMIT 1";
      $check = mysqli_query( $conn, $sql );

      $res->shop_domain = $data_json['domain'];

      $response = $shopify['shop'] . ' is successfully deleted from the database';
} else { $response = $data; }
}else { $response = 'NOT FROM SHOPIFY, SOMEONE TRYING TO BE SHADY.'; }

$log = fopen( $shop_domain . ".txtt", "w") or die("Cannot open or create this file");
fwrite( $log, json_encode($response) );
fclose( $log );

?>






























