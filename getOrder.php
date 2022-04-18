<?php 
include_once 'mine/header.php'; 

include_once 'mine/top_header.php'; 

include_once 'mine/left_nev.php';

?>
<?php

$curl = curl_init();

$Id = isset($_GET['Id'])?$_GET['Id']:null;

curl_setopt_array($curl, array(
  //CURLOPT_URL => 'https://giftcards-sandbox.reloadly.com/products/'.$Id ,
  CURLOPT_URL => 'https://giftcards.reloadly.com/products/'.$Id ,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
   CURLOPT_HTTPHEADER => array(
     'Authorization: Bearer eyJraWQiOiI5MTYxZDA4Zi05ODhjLTRiYjItYTI5NS03ODc5NmQ2MzJlM2YiLCJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxMzQ0MyIsImlzcyI6Imh0dHBzOi8vcmVsb2FkbHkuYXV0aDAuY29tLyIsImh0dHBzOi8vcmVsb2FkbHkuY29tL3NhbmRib3giOmZhbHNlLCJodHRwczovL3JlbG9hZGx5LmNvbS9wcmVwYWlkVXNlcklkIjoiMTM0NDMiLCJndHkiOiJjbGllbnQtY3JlZGVudGlhbHMiLCJhdWQiOiJodHRwczovL2dpZnRjYXJkcy5yZWxvYWRseS5jb20iLCJuYmYiOjE2NDg4NDk3MTgsImF6cCI6IjEzNDQzIiwic2NvcGUiOiJkZXZlbG9wZXIiLCJleHAiOjE2NTQwMzM3MTgsImh0dHBzOi8vcmVsb2FkbHkuY29tL2p0aSI6IjQxYzY0ZTFiLWIzM2ItNDRiZS04M2NhLTI5NDUwNGYyYTQzMSIsImlhdCI6MTY0ODg0OTcxOCwianRpIjoiZTliNjlkYjYtMzI4MC00YzkxLTlkYjYtYzA4NDU0OWI4YjBjIn0.MLpBwTkONz8bcd0L6SUJ6y8_SUZ4gDO-ClEEYJ8xdv4',
     'Accept: application/com.reloadly.giftcards-v1+json'
   ),
//CURLOPT_HTTPHEADER => array(
    // 'Authorization: Bearer eyJraWQiOiJjNGE1ZWU1Zi0xYmE2LTQ1N2UtOTI3Yi1lYzdiODliNzcxZTIiLCJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxMzI2OCIsImlzcyI6Imh0dHBzOi8vcmVsb2FkbHktc2FuZGJveC5hdXRoMC5jb20vIiwiaHR0cHM6Ly9yZWxvYWRseS5jb20vc2FuZGJveCI6dHJ1ZSwiaHR0cHM6Ly9yZWxvYWRseS5jb20vcHJlcGFpZFVzZXJJZCI6IjEzMjY4IiwiZ3R5IjoiY2xpZW50LWNyZWRlbnRpYWxzIiwiYXVkIjoiaHR0cHM6Ly9naWZ0Y2FyZHMtc2FuZGJveC5yZWxvYWRseS5jb20iLCJuYmYiOjE2NDk0MDYyOTYsImF6cCI6IjEzMjY4Iiwic2NvcGUiOiJkZXZlbG9wZXIiLCJleHAiOjE2NDk0OTI2OTYsImh0dHBzOi8vcmVsb2FkbHkuY29tL2p0aSI6ImFhMjU2MDJkLTgxZDAtNGQzYy1iNDdkLTZiYTdjN2QzY2ZhNSIsImlhdCI6MTY0OTQwNjI5NiwianRpIjoiZmQ4YjU5OGMtODJiZS00OGM5LTgxYjQtNGFiMDRmOTJiNTAwIn0.2Hcz9g4gYySwmBAb6LVHXJNJ2loaMI6xAj9FYYabONM',
    //'Accept: application/com.reloadly.giftcards-v1+json'
 // ),
));

$response = curl_exec($curl);

curl_close($curl);

$productId = json_decode($response);

var_dump($productId );

$query = $productId->global;
$msg = "";
if ($query != 1 ){
    
    $msg="not avaible to all country";
}
else{
    $msg="avaible to all country";
}

?>


 <div style="width:100%; visibility:hidden;">
     <div style=" ">
         <center>
            
               <div style="border:1px solid gray; border-radius:30px; width:80%;">
                   <b>
                       <h4 style="font-size:18px;">
                           <?=$products->productName?>
                       </h4>
                   </b>
                   <!--<img src="<?=$products->logoUrls[0]?>" style="width:100%; height:auto;">-->
                    <div style="height:0px;"></div>
                    
                    
                       <h4 style="font-size:15px;"><?=$products->productId?>
                       </h4>
                       
                       <h4 style="font-size:15px;"><?=$products->global?>
                       </h4>
                       
                       <h4 style="font-size:15px;"><?=$products->brand->brandName?>
                       </h4>
                       
                       <h4 style="font-size:15px;"><?=$products->productName?>
                       </h4>
                       
                       <h4 style="font-size:15px;"><?=$products->country->name?>
                       </h4>
                    
                    <div>
                        <div style="height:0px;"></div>
                        <a href="getOrder.php?Id=<?=$productId->productId?>"><button class="btn btn-primary" style="border:1px white; height:0px;">    </button></a>
                        <div style="height:0px;"></div>
                    </div>
               </div>
               <div style="height:0px;"></div>
            
         </center>
     </div>
 </div>




<center>
    <div class="row xe__balanceblock" style="clear:both">
        <div class="col-md-4">
            <div class="card">
                
                    <div class="modal-content">
                        <div class="modal-body">
                                <div style="border:1px solid gray; border-radius:40px;">
                                    
                                    
                                       
    <div class="modal-header" >
<center><h4 class="modal-title">GIFT CARD CHECKOUT</h4></center>
    </div>
    
    <div>
    <img src="<?=$productId->logoUrls[0]?>" style="position: center; top: 0px; bottom:20px; width: 100%; height:auto;"/>
    </div>
    
    
    <form>
        <div class="form-group">
            
            
            <h4 style="font-size:12px;">
            Product Name: <?=$productId->productName?>
            </h4>
            
            <h4 style="font-size:12px;">
            Product ID: <?=$productId->productId?>
            </h4>
            
            <h4 style="font-size:12px;">
            Availability: <?= $msg ?>
            </h4>
            
            <h4 style="font-size:12px;">
            Brand: <?=$productId->brand->brandName?>
            </h4>
            
            <h4 style="font-size:12px;">
            Domination Type: <?=$productId->denominationType?>
            </h4>
            
            <h4 style="font-size:12px;">
            Card Currency: <?=$productId->recipientCurrencyCode?>
            </h4>
            
            <h4 style="font-size:12px;">
            Available Prices: <?php for ($i=0, $len=count($productId->fixedRecipientDenominations); $i<$len; $i++) {?>
                    <?=$productId->fixedRecipientDenominations[$i]?>
                     <?php  } ?>
            </h4>
                                    
                                </div>
                                <!--<div class="form-group">
                                    
                                    <a href="getOrder.php?Id=<?=$productId->productId?>" class="btn btn-primary">BUY CARD <i class="fa fa-paper-plane"></i></a>
                                </div>-->

                            </form>
                                </div>
                                    <div style="height:40px;"></div> 
                                <p><?php echo $name;?></p>
                                
                                
                                
                                <form action="processOrder.php" method="POST" >
                     <center><b><h2 style="font-size:30px;">ORDER DETAILS</h2> </b></center>  
                <div style="height:20px;"></div>
                        <div class="form-group">
                          <label for="reciever_email" style="font-size:12px;">Reciever email</label>
                          <input type="email" class="form-control" name="reciever_email" id="reciever_email" required>
                        </div>
                        
                        
                        <div class="form-group" >
                          <label for="quantity" style="font-size:12px;">Sender First Name</label>
                          <input type="name" class="form-control" name="first_name" id="first_name" required>
                        </div>
                        
                        
                        <div class="form-group" style="width:100%; float:center;">
                          <label for="amount" style="font-size:12px;">Gift Card Amount</label>
                          <select id="amount" name="amount" class="form-control" required>
                            <option selected>Choose Amount</option>
                            
                            <?php for ($i=0, $len=count($productId->fixedRecipientDenominations); $i<$len; $i++) {?>
                                    <?=$productId->fixedRecipientDenominations[$i]?>
                            <option value="<?=$productId->fixedRecipientDenominations[$i]?>"><?=$productId->fixedRecipientDenominations[$i]?></option>
                                <?php  } ?>
                          </select>
                        </div>
                        
                        <div class="form-group" style="width:100%; float:center; ">
                          <label for="quantity" style="font-size:12px;">Quantity</label>
                          <input type="number"   class="form-control" name="quantity"  id="quantity" required>
                        </div>  
                      
                          
                         <div class="form-group"> 
                          <input type="hidden" class="form-control" name="productId"  id="productId"   value="<?=$productId->productId?>">
                          <input type="hidden" class="form-control" name="currency"   id="currency"    value="<?=$productId->recipientCurrencyCode?>">
                          <input type="hidden" class="form-control" name="countrycode"id="countrycode" value="<?=$productId->senderCurrencyCode?>">
                        </div>
                      
                      
                      <input type="submit" style="width:100%; font-size:12px;" class="btn btn-primary" name="submit" value="PAY NOW">
                    </form>
                    <div style="height:20px;"></div>
                
                
                
                
                
                        </div>
                    </div>
                </div>
            </div>
        </div>
</center>
                
                
                
<div style="height:80px;"></div> 
 <?php include_once 'mine/footer.php';
  ?>
 
 </body>
 </html>         
                
 
