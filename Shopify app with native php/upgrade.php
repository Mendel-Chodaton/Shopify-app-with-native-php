<?php 
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

          include_once("inc/functions.php");  
          include_once("inc/mysql_connect.php"); 
         $shopify = $_GET;
// echo print_r($shopify);
 
        $sql = "SELECT * FROM shops WHERE shop_url='".$shopify['shop'] . "' LIMIT 1";
        $check = mysqli_query( $conn, $sql );

if(mysqli_num_rows($check) < 1) {
 header("location: install.php?shop=" . $shopify['shop']);
 exit();
}
       $shop_row = mysqli_fetch_assoc($check);
       $shop_url = $shopify['shop'];
       $token = $shop_row['access_token'];
       $id = $shop_row['id'];
       $install_date = $shop_row['install_date'];
      

       $parsedUrl = parse_url('https://' . $shop_url );
       $host = explode('.', $parsedUrl['host']);
       $shop = $host[0];

$recurring_array = array(
  "recurring_application_charge" => array(
  "name" => "App charge", 
  "price" => 9.9,
  "test" => true,
  "return_url" => "https://" . $shop_url . "/admin/apps/YOUR_SHOPIFY_APP_NAME/?"
   )
);

$reccuring_charge = shopify_call($token, $shop_url, "/admin/api/2022-04/recurring_application_charges.json", $recurring_array, "POST");
$reccuring_charge = json_decode( $reccuring_charge['response'], JSON_PRETTY_PRINT);

echo print_r($reccuring_charge);

?>
