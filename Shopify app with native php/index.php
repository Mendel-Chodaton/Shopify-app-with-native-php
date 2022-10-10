<?php 

          include_once("inc/functions.php");  
          include_once("inc/mysql_connect.php"); 

$shopify = $_GET;


        $sql = "SELECT * FROM shops WHERE shop_url='" . $shopify['shop'] . "' LIMIT 1";
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
       $subdomain = $host[0];

       $shop = $subdomain;
// ending
?>










<?php
define('DOMAIN_URL_PROJECT_PATH', 'https://PATH_TO/');

$array = array(
  'webhook' => array(
  'topic' => 'products/create', 
  'address' =>DOMAIN_URL_PROJECT_PATH . 'webhooks/create.php',
  'format' => 'json'
   )
);

$webhook = shopify_call($token, $shop_url, "/admin/api/2022-04/webhooks.json", $array, 'POST');
$webhook = json_decode( $webhook['response'], JSON_PRETTY_PRINT);

?>



<?php
define('DOMAIN_URL_PROJECT_PATH', 'https://PATH_TO/');

$arrayu = array(
  'webhook' => array(
  'topic' => 'app/uninstalled', 
  'address' =>DOMAIN_URL_PROJECT_PATH . 'webhooks/delete.php',
  'format' => 'json'
   )
);

$webhook = shopify_call($token, $shop_url, "/admin/api/2022-04/webhooks.json", $arrayu, 'POST');
$webhook = json_decode( $webhook['response'], JSON_PRETTY_PRINT);


$webhook = shopify_call($token, $shop_url, "/admin/api/2022-04/webhooks.json", $arrayu, 'GET');
$webhook = json_decode( $webhook['response'], JSON_PRETTY_PRINT);
// echo print_r ($webhook);
?>


<?php
define('DOMAIN_URL_PROJECT_PATH', 'https://PATH_TO/');

$arrayv = array(
  'webhook' => array(
  'topic' => 'shop/update', 
  'address' =>DOMAIN_URL_PROJECT_PATH . 'webhooks/delete.php',
  'format' => 'json'
   )
);

$webhook = shopify_call($token, $shop_url, "/admin/api/2022-04/webhooks.json", $arrayv, 'POST');
$webhook = json_decode( $webhook['response'], JSON_PRETTY_PRINT);


?>












<!DOCTYPE html>
<html lang="en-US" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Combo products</title>
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
background-color: #f6f6f7;
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
  <body class="bg-light" style="background-color: #f6f6f7;">
	<div class="container py-5">
<nav style="background-color: #f6f6f7; color: #f6f6f7;">
		<label style="background-color: #f6f6f7; color: black; font-weight: bold;" class="logo">Combo products</label>

		<hr style="background-color: #f6f6f7; color: #f6f6f7;"><ul style="background-color: #f6f6f7;">


			<li><a data-toggle="modal" data-target="#createModal" href="" id="NewCombo">New Combo</a></li>
			<li><a href="mailto:seo100booster@gmail.com">Mail us</a></li>
                        <li><a href="HTUI.html">How to use it</a></li>

		</ul><br>
		
	</nav><br>







<table class="table table-bordered my-5">
	<thead class="table-light">
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



		        $discount = shopify_call($token, $shop_url, "/admin/api/2022-04/price_rules.json", array(), 'GET');
                        $discount = json_decode($discount['response'], JSON_PRETTY_PRINT);
                        echo print_r($discount);

		        $products = shopify_call($token, $shop_url, "/admin/api/2021-10/products.json", array(), 'GET');
                        $products = json_decode($products['response'], JSON_PRETTY_PRINT);

                      foreach ($products as $product) {
                      foreach ($product as $key => $value) {
      
                 
                      $images = shopify_call($token, $shop_url, "/admin/api/2021-10/products/" . $value['id'] . "/images.json", array(), 'GET');
                      $images = json_decode($images['response'], JSON_PRETTY_PRINT);
 ?>


<td data-toggle="modal" id="TdImage" data-target="#productsModal" product-id="<?php echo $value['id']; ?>" product-variants="<?php echo $value['variants']['0']['id']; ?>" price="<?php echo $value['variants']['0']['price']; ?>" >
                        <img id="TableImage" src="<?php echo $images['images'][0]['src']; ?>" alt="product image"; style="background-size: 25px; width: 80px; height: auto;">
                          </td> 
							<td id="TdTitle"><p><tt><?php echo $value['title']; ?></tt></p></td>
							<td id="TdStatus"><p><tt><?php echo $value['status']; ?></tt></p></td>
							<td id="TdPrice"><p><tt><?php echo $value['variants']['0']['price']; ?></tt></p></td>
                                                        <td><button data-toggle="modal" data-target="#deleteModal" href="" class="btn btn-secondary"><svg width="26" height="26" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg></button></td>					 
						 
</div>
						 
						
						 
						 
						 
						 
					</tr>
				</thead>










<!-- modal 1 -->

                 <div class="modal" id='productsModal' product-id='' tabindex="-1" role="dialog" aria-labelledby="productsModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-lg" style="max-width: 50% !important;" role="document">
						 <div class="modal-content">
							<div class="modal-header">
								   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <span aria-hidden="true">&times;</span>
											</button>									</div>
<div class="modal-body">

								                        	<h1>Edit Combo</h1>
	
   <form action="ajax.php" id="productForm">								                        			
		    <div class="form-group">
        		<label for="productName" for="basic-url" class="form-label"> <strong>Combo Title</strong> </label>
        		<input type="text" placeholder="Title..." class="form-control" aria-describedby="basic-addon3" id="ProductTitle" name="ProductTitle">          
                   </div>   

<!--
 		    <div class="form-group">
        		<label for="ProductDescription" class="form-label"> <strong>Combo Description</strong> </label>
        	        <textarea class="form-control" id="productDescription" name="productDescription" rows="7"> </textarea>          
                   </div>    
-->

 
                   <label for="basic-url" class="form-label"><strong>Combo Image</strong></label>
                        <div class="input-group mb-3">
                        <span class="input-group-text"> <input value="Image" id="ProductImage" name="ProductImage" type="file"  accept="video/*,image/*" />Browse</span>
                   </div>



                     <div class="form-group" >
        		<label for="productName" for="basic-url" class="form-label"> <strong>Combo Price</strong> </label>
        		<input type="number" placeholder="0.00" class="form-control" aria-describedby="basic-addon3" id="ProductPrice" name="ProductPrice">               
        	     </div>



   <div class="form-group">
        		<label for="productDiscount"><strong>Discount</strong></label>
   </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                        <label class="form-check-label" for="inlineRadio1">Percents</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                      <label class="form-check-label" for="inlineRadio2">Fixed Amount</label>
                    </div>

                   <div class="input-group mb-3">
                     <span class="input-group-text" id="basic-addon3">Discount Value</span>
                     <input type="number" placeholder="0.00" class="form-control" id="ProductDiscount" aria-describedby="basic-addon3" lenght name="ProductDiscount">
                  </div>

<label for="basic-url" class="form-label"><strong>Product status</strong></label>
               <div class="input-group mb-3">
                   <select class="custom-select" id="productStatus" name="productStatus">
                     <option value="draft">Draft</option>
                     <option value="active">Active</option>
        	   </select>
              </div>



<label for="basic-url" class="form-label"><strong> Products </strong></label>
               <div class="input-group mb-3">
                   <span class="input-group-text" id="basic-addon3">Click to select product</span>

                   <select class="custom-select" id="productCombo" name="productCombo" multiple>

<?php
        $products = shopify_call($token, $shop_url, "/admin/api/2021-10/products.json", array(), 'GET');
        $products = json_decode($products['response'], JSON_PRETTY_PRINT);      
            foreach ($products as $product) { 
                foreach ($product as $key => $value) {
                     ?>
                   <option value="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></option>
 <?php
  }
 }
?>


        	   </select>
              </div>
		
	</form>						                    
										</div>
									      <div class="modal-footer">
                                      <button type="button" data-dismiss="modal" class="btn btn-primary" id="SaveProduct" product-id=''>Saves Changes</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
									      </div>

									</div>
								</div>
							</div>


<!-- modal 1 end -->














<!-- modal 2 -->

                 <div class="modal" id='createModal' tabindex="-1" role="dialog" aria-labelledby="productsModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-lg" style="max-width: 50% !important;" role="document">
						 <div class="modal-content">
							<div class="modal-header">
								   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <span aria-hidden="true">&times;</span>
											</button>									</div>
<div class="modal-body">

								                        	<h1>New Combo</h1>
	
   <form action="ajax.php" id="ComboForm">								                        			
		    <div class="form-group">
        		<label for="ComboTitle" for="basic-url" class="form-label"> <strong>Combo Title</strong> </label>
        		<input type="text" placeholder="Combo Title..." class="form-control" aria-describedby="basic-addon3" id="ComboTitle" name="ComboTitle">          
                   </div>   


 		    <div class="form-group">
        		<label for="ComboDescription" class="form-label"> <strong>Combo Description</strong> </label>
        	        <textarea class="form-control" id="ComboDescription" name="ComboDescription" rows="7"> </textarea>          
                   </div>    


 
                   <label for="ComboImage" class="form-label"><strong>Combo Image</strong></label>
                        <div class="input-group mb-3">
                        <span class="input-group-text">
                       <div id="input_container" name="ComboImage"><input src='' type="file" id="ComboImage" /></div>
                       <div class="button" onclick="upload();">Browse</div>
                        </span>
                   </div>




                     <div class="form-group" >
        		<label for="ComboPrice" class="form-label"> <strong>Combo Price</strong> </label>
        		<input type="number" placeholder="0.00" class="form-control" aria-describedby="basic-addon3" id="ComboPrice" name="ComboPrice">               
        	     </div>



   <div class="form-group">
        		<label for="productDiscount"><strong>Discount</strong></label>
   </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                        <label class="form-check-label" for="inlineRadio1">Percents</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                      <label class="form-check-label" for="inlineRadio2">Fixed Amount</label>
                    </div>

                   <div class="input-group mb-3">
                     <span class="input-group-text" id="basic-addon3">Discount Value</span>
                     <input type="number" placeholder="0.00" class="form-control" id="ComboDiscount" aria-describedby="basic-addon3" lenght name="ComboDiscount">
                  </div>

<label for="basic-url" class="form-label"><strong>Product status</strong></label>
               <div class="input-group mb-3">
                   <select class="custom-select" id="ComboStatus" name="ComboStatus">
                     <option value="draft">Draft</option>
                     <option value="active">Active</option>
        	   </select>
              </div>

<label for="basic-url" class="form-label"><strong> Products </strong></label>
               <div class="input-group mb-3">
                   <span class="input-group-text" id="basic-addon3">Click to select product</span>

                   <select class="custom-select" id="ComboProduct" name="ComboProduct" multiple>

<?php
        $products = shopify_call($token, $shop_url, "/admin/api/2021-10/products.json", array(), 'GET');
        $products = json_decode($products['response'], JSON_PRETTY_PRINT);      
            foreach ($products as $product) { 
                foreach ($product as $key => $value) {
                     ?>
                   <option value="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></option>
 <?php
  }
 }
?>


        	   </select>
              </div>
		
	</form>						                    
										</div>
									      <div class="modal-footer">
                                      <button type="button" data-dismiss="modal" class="btn btn-primary" id="CreateCombo" product-id=''>Create Product</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
									      </div>

									</div>
								</div>
							</div>


<!-- modal 2 end -->














<!-- modal 3 -->

                 <div class="modal" id='deleteModal' product-id='' tabindex="-1" role="dialog" aria-labelledby="productsModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-lg" style="max-width: 50% !important;" role="document">
						 <div class="modal-content">
							<div class="modal-header">
								   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <span aria-hidden="true">&times;</span>
											</button>									</div>
<div class="modal-body">

 <H4>Do you really want to delete the product <p id ='deleteName'></p>  ? This action is irreversible</H4>
	
					                    
										</div>
									      <div class="modal-footer">
                                      <button type="button" data-dismiss="modal" class="btn btn-primary" id="YesDelete" product-id=''>Yes</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
									      </div>

									</div>
								</div>
							</div>


<!-- modal 3 end -->












                                                <?php
  }
}
?>

	</tbody>
</table>

</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>



       <script>
      var shop = '<?php echo $shop_url; ?>';

      $('td[product-id]').on('click', function (e) {

        $('#productCombo option').removeAttr('selected');

        $.ajax({
          method: 'POST',
          data: {
            url: shop,
            variant: $(this).attr('product-variants'),
            id: $(this).attr('product-id'),
            type: 'GET'
          },
          url:'ajax.php',
          dataType: 'json',
          success:function(json){
            console.log(json);

         $('#SaveProduct').attr('product-id', json['product_id']);
           $('#productsModal').attr('product-id', json['product_id']);
           $('#deleteModal').attr('product-id', json['product_id']);
           $('#YesDelete').attr('product-id', json['product_id']);
             $('#ProductImage').attr('src', json['image']);
              $('#ProductTitle').val(json['title']); 
              $('#deleteName').val(json['title']); 
               $('#ProductPrice').val(json['price']);
                $('#ProductImage').val(json['image']);  
                 $('#productDescription').val(json['description']);







           $('#productCombo option').each(function(i) {
             var optionCombo = $(this).val();

                json['product'].forEach(function(productCombo) {
                 if(productCombo['id'] == optionCombo) {
                  $('#productCombo option[value=' + optionCombo + ']').attr('selected','selected');
                     }
                  });
               });


                  json['product'].forEach(function(item) {})

                   $('#productsModal').modal('show');
         }   
        }); 
      });






 $('#productsModal').on('hide.bs.modal', function() {
        $('#productsModal').attr('product-id', '');
        $('#SaveProduct').attr('product-id', '');
        $('#productCombo option').removeAttr('selected');
        $('#productCombo').val([]);
      });
function upload(){
 document.getElementById('ComboImage').click();
}

 $('#SaveProduct').on('click', function ( e ) {  
      e.preventDefault();
  var productID = $(this).attr('product-id');

        $.ajax({
          method: 'POST',
          data: {
            url: shop,
            id: productID,
            pricing: $(this).attr('price'),
            product: new FormData($("#productForm")[0]),
            type: 'PUT'
          },
          processData: false,
          contentType: false,
          url:'ajax.php',
          dataType: 'html',
          success:function(json){
                console.log(json);
      }   
    });
});










 $('#CreateCombo').on('click', function () {

        $.ajax({
          method: 'POST',
          data: {
            url: shop,
            combo: $('#ComboForm').serialize(),
            image: $('input_container').serialize(),
            type: 'POST'
          },
          url:'ajax.php',
          dataType: 'json',
          success:function(json){
                console.log(json);
      }   
    });
});







 $('#YesDelete').on('click', function () {
  var tableID = $(this).attr('table-id');

        $.ajax({
          method: 'POST',
          data: {
            url: shop,
            id: tableID,
            type: 'DELETE'
          },
          url:'ajax.php',
          dataType: 'json',
          success:function(json){
                console.log(json);
      }   
    });
});

    </script>
  </body>
</html>

