<?php
include_once("inc/mysql_connect.php");
include_once("inc/functions.php");  
 


define('SHOPIFY_APP_SECRET_KEY', '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');

function verify_request($data, $my_hmac)
{
  $verify_hmac = base64_encode( hash_hmac('sha256', $data, SHOPIFY_APP_SECRET_KEY, true));
  return hash_equals($my_hmac, $verify_hmac);
}

$my_hmac = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];

$response = '';
$data = file_get_contents('php://input');

$utf8 = utf8_encode( $data );
$data_json = json_decode( $utf8, true );
$my_topic = $_SERVER['HTTP_X_SHOPIFY_TOPIC'];
$shop_domain = $_SERVER['HTTP_X_SHOPIFY_SHOP_DOMAIN'];
$verify_merchant = verify_request( $data, $my_hmac );


if( $verify_merchant == true ) {
  if( $my_topic == 'app/uninstalled' || $topic_header == 'shop/update') {
    if( $my_topic == 'app/uninstalled' ) {

      $sql = "DELETE FROM shops WHERE shop_url='". $data_json['domain'] ."' ";
      $check = mysqli_query( $conn, $sql );

      $res->domain = $data_json['domain'];

      $response = $data_json['domain'] . ' is successfully deleted from the database';
   

} else { $response = $data; }
}
}else { $response = 'NOT FROM SHOPIFY.'; }
$log = fopen( $shop_domain . ".html", "w") or die("Cannot open or create this file");
fwrite( $log, json_encode($response) );
fclose( $log );

?>
































