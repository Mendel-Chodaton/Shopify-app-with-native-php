<?php 


          include_once("inc/functions.php");  
          include_once("inc/mysql_connect.php"); 
         $shopify = $_GET;

        $sql = "SELECT * FROM shops WHERE shop_url='" . $shopify['shop'] . "' LIMIT 1";
        $check = mysqli_query( $conn, $sql );

     $shop_row = mysqli_fetch_assoc($check);
       $shop_url = $shopify['shop'];
       $token = $shop_row['access_token'];
       $id = $shop_row['id'];
       $install_date = $shop_row['install_date'];
      

       $parsedUrl = parse_url('https://' . $shop_url );
       $host = explode('.', $parsedUrl['host']);
       $subdomain = $host[0];

       $shop = $subdomain;

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bootstrap.css">
            <link rel="icon" href="invoice3.jpg">
    <title>Easy Invoice App</title>
<link rel="stylesheet" href="style.css">
	 <script src="https://kit.fontawesone.com/a076d05399.js"></script>
	 <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	 <script>
	 	$(document).ready(function(){
	 		$('#icon').click(function(){
	 			$('ul').toggleClass('show');
	 		});
	 	});

	 </script>
<style> 
.vertical { 
border-left: 4px solid black; 
height: 30px; 
display: inline-block;
} 
</style> 
<style> 
.verticaling { 
border-left: 4px solid black; 
height: 15px; 
display: inline-block;
} 
</style>
  </head>
  <body class="bg-light">
	<div class="container py-5">
<nav style="background-color: #f6f6f7; color: #f6f6f7;">
		<label style="background-color: #f6f6f7; color: black; font-weight: bold;" class="logo">Product Combo</label> <span class="vertical"></span><label style="background-color: #f6f6f7; color: black; font-weight: bold;" class="logo">Statistics</label>

                 <br>

		<hr><ul style="background-color: #f6f6f7;">
			<li><a class="active" href="mailto:seo100booster@gmail.com">Mail us</a></li>
                        <li><a href="HTUI.html">How to use it</a></li>

		</ul><br>
		
	</nav><br>


<button href="Create.php">New Combo</button>
<table class="table table-bordered my-5">
	<thead>
		<tr>
			<th scope="col">Combo image</th>
			<th scope="col">Combo name</th>
			<th scope="col">Status</th>
			<th scope="col">Price</th>
                        <th scope="col">Action</th>
			 
		</tr>
	</thead>
	<tbody>
		<?php
			$orders = shopify_call($token, $shop_url, "/admin/api/2022-04/orders.json", array("status" => 'any'), 'GET');
			$orders = json_decode($orders['response'], JSON_PRETTY_PRINT);
			
		$products = shopify_call($token, $shop_url, "/admin/api/2021-10/products.json", array(), 'GET');
        $products = json_decode($products['response'], JSON_PRETTY_PRINT);



 

            // echo print_r($orders);
           // echo print_r($products);

            foreach ($products as $product) {
   foreach ($product as $key => $value) {
      if( $value[product_type] == 'combo' ){
       $images = shopify_call($token, $shop_url, "/admin/api/2021-10/products/" . $value['id'] . "/images.json", array(), 'GET');
        $images = json_decode($images['response'], JSON_PRETTY_PRINT);
 ?>
							<td product-id="<?php echo $value['id']; ?>" > <img src="<?php echo $images['images'][0]['src']; ?>" alt="product image"; style="background-size: 25px; width: 80px; height: auto;"></td> 
							<td><?php echo $value['title']; ?></td>
							<td><?php echo $value['status']; ?></td>
								<?php
								foreach ($value['variants'] as $index => $item) {
								     ?>
							<td> <?php echo $item['price']; ?> </td>
							<?php
							}
						   ?>
                                                        <td><svg width="26" height="26" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg></td>						 
						 
</div>
						 
						
						 
						 
						 
						 
					</tr>
				</thead>
                 <div class="modal fade" id="productsModal<?php echo $value['id']; ?>" tabindex="-1" aria-labelledby="printOrderLabel" aria-hidden="true">
					  <div class="modal-dialog modal-lg" style="max-width: 80% !important;">
						 <div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="printOrderLabel">ID = <?php echo $value['id']; ?></h5>
								   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <span aria-hidden="true">&times;</span>
											</button>
										</div>

									</div>
								</div>
							</div>

                                                <?php
}
  }
}
?>

	</form>
	</tbody>
</table>

</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"></script>


      </body>
</html>


