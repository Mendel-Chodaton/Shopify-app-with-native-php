<?php

// Set variables for our request
$shop = $_GET['shop'];
$api_key = "fed84fb1de3ac093a881476c9a20f5de";
$scopes = "read_products,write_products,read_discounts,write_discounts,read_price_rules,write_price_rules";
$redirect_uri = "https://comboapp.arunas.tk/generate_token.php";

        $sql = "SELECT * FROM shops WHERE shop_url='".$_GET['shop'] . "' LIMIT 1";
        $check = mysqli_query( $conn, $sql );


// Build install/approval URL to redirect to
$install_url = "https://" . $shop . "/admin/oauth/authorize?client_id=" . $api_key . "&scope=" . $scopes . "&redirect_uri=" . urlencode($redirect_uri);

// Redirect
header("Location: " . $install_url);
die();


 ?>

