<?php 

       include_once("inc/functions.php");  
       include_once("inc/mysql_connect.php"); 


       $id = $_POST['id'];
       $variant_id = $_POST['variant'];
       $pricer = $_POST['pricing'];
       $shop_url = $_POST['url'];


       $sql = "SELECT * FROM shops WHERE shop_url='" . $shop_url . "' LIMIT 1";
       $check = mysqli_query( $conn, $sql );

if(mysqli_num_rows($check) > 0) {
       $shop_row = mysqli_fetch_assoc($check);

       $token = $shop_row['access_token'];
    

       if($_POST['type'] == 'GET') {

       $products = shopify_call($token, $shop_url, "/admin/api/2022-04/products/" . $id . ".json", array(), 'GET');
       $products = json_decode( $products['response'], JSON_PRETTY_PRINT);


       $id = $products['product']['id'];
       $title = $products['product']['title'];
       $description = $products['product']['body_html'];
       $image = $products['product']['images']['0']['src'];
       $alt = $products['product']['image']['alt'];
       $product = $products['product'];
       $price = $products['product']['variants']['0']['price'];
       $test = $products['product']['variants']['0'];
       $status = $products['product']['status'];
       $collections = array();



       $variants = shopify_call($token, $shop_url, "/admin/api/2022-04/products/" . $id . "variants.json", array(), 'GET');
       $variants = json_decode( $variants['response'], JSON_PRETTY_PRINT);





       $custom_collections = shopify_call($token, $shop_url, "/admin/api/2022-04/custom_collections.json", array("product-id" => $id), 'GET');
       $custom_collections = json_decode( $custom_collections['response'], JSON_PRETTY_PRINT);

foreach ($custom_collections as $custom_collection) {
   foreach ($custom_collection as $key => $value) {
    array_push($collections, array("id" => $value['id'], "name" => $value['title']));
 } 
}



       $smart_collections = shopify_call($token, $shop_url, "/admin/api/2022-04/smart_collections.json", array("product-id" => $id), 'GET');
       $smart_collections = json_decode( $smart_collections['response'], JSON_PRETTY_PRINT);

foreach ($smart_collections as $smart_collection) {
   foreach ($smart_collection as $key => $value) {
    array_push($collections, array("id" => $value['id'], "name" => $value['title']));
 } 
}

      echo json_encode(
           array(
               "product_id" => $id,
               "title" => $title,
               "status" => $status,
               "price" => $price,
               "image" => $image,
               "alt" => $alt,
               "variants" => $variants,
               "varian" => $varian,
               "product" => $product,
               "custom_collections" => $custom_collections,
               "description" => $description,
               "test" => $test,
               "collections" => $collections
                )
          );

       } else if( $_POST['type'] == 'PUT' ) {

       $productData = array(); 
       parse_str($_POST['product'], $productData);  
           echo $_POST['product'];
       $array = array("product" => array("title" => $productData['ProductTitle'], "status" => $productData['productStatus'], "body_html" => $productData['ProductDescription'], "variants" => array("" => array("price" => $productData['ProductPrice']) ) ) );
       $products = shopify_call($token, $shop_url, "/admin/api/2022-04/products/" . $id . ".json", $array, 'PUT');


      } else if( $_POST['type'] == 'POST' ) {

       $productData = array(); 
       parse_str($_POST['combo'], $productData);  
           echo $_POST['combo'];
           echo $_POST['image'];
       $array = array("product" => array("title" => $productData['ComboTitle'],  "status" => $productData['ComboStatus'], "images" => $productData['ComboImage'] , "product_type" => 'combo' , "body_html" => $productData['ComboDescription'], "variants" => array("" => array("price" => $productData['ComboPrice'], "images" => array("" => array("srvc" => $productData['ComboImage'] ) ) ) ) ) );

       $products = shopify_call($token, $shop_url, "/admin/api/2022-04/products.json", $array, 'POST');

       $array_image = array("product" => array("variants" => array("" => array("images" => array("" => array("src" => $productData['ComboImage'] ) ) ) ) ) );

       $images = shopify_call($token, $shop_url, "/admin/api/2021-10/products/" . $value['id'] . "/images.json", $array_image, 'POST');

}     else if( $_POST['type'] == 'DELETE' ) {

       $products = shopify_call($token, $shop_url, "/admin/api/2022-04/products/" . $id . ".json", 'DEL');


}





}
?>









































