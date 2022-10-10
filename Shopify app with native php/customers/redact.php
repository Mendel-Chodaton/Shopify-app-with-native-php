<?php

define('SHOPIFY_APP_SECRET', '608f337217bcc0905d7e8095354c753d');

function verify_webhook($data, $hmac_header)
{
  $calculated_hmac = base64_encode(hash_hmac('sha256', $data, SHOPIFY_APP_SECRET, true));
  return hash_equals($hmac_header, $calculated_hmac);
}

$topic_header = $_SERVER['HTTP_X_SHOPIFY_TOPIC'];
$shop_header = $_SERVER['HTTP_X_SHOPIFY_SHOP_DOMAIN'];
$hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
$data = file_get_contents('php://input');
$decoded_data = json_decode($data, true);
$verified = verify_webhook($data, $hmac_header);

error_log('Webhook verified: '.var_export($verified, true)); //check error.log to see the result

if ($verified) {
    if( $topic_header = 'customers/redact' ) 

}
"shop_id": $value['shop_id'],
"shop_domain": "{shop}.myshopify.com",
"customer": {
  "id": $value['customer_id'],
  "email": $value['contact_email'],
  "phone": $value['phone_number']
}, {
"orders_to_redact": [299938, 280263, 220458]

} else {
  http_response_code(401);
}


?>
