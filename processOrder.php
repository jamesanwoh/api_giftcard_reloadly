<?php
session_start();
 echo $_SESSION['ewallet_id'];
 echo $_SESSION['user_id'];
 
 
include "db_connect.php";

$userid = $_SESSION["user_id"];
$ewallet = $_SESSION['ewallet_id'];

$user_id = $userid ;
$wallet = $ewallet ;

// echo $userId;
// echo $wallet;

$amount         = htmlspecialchars($_POST["amount"]);
$transaction_id = uniqid();

    if (isset($_POST['submit'])){
    $productId      = htmlspecialchars($_POST["productId"]);
    $transactionId_  = htmlspecialchars($transaction_id);
    $quantity       = htmlspecialchars($_POST["quantity"]);
    $amount         = htmlspecialchars($_POST["amount"]);
    $currency       = htmlspecialchars($_POST["currency"]);
    $senderName     = htmlspecialchars($_POST["first_name"]);
    $recipientEmail = htmlspecialchars($_POST["reciever_email"]);
    $countryCode    = htmlspecialchars($_POST["countrycode"]);
    
    // echo $amount;
    // }
    $query = "SELECT* FROM master_wallet_balance WHERE ewallet_id='$wallet'";
	        $result = @mysqli_query($conn, $query);
	        if (@mysqli_num_rows($result)==1){
	            $row = mysqli_fetch_array($result);
	            $balance    = $row['balance'];
	            if($balance <= $amount){ 
	                header('location:getProductISO.php?error= insufficient Balance');
	            }
	            else{
            $endpoint ="https://giftcards-sandbox.reloadly.com/orders";
            // $endpoint ="https://giftcards.reloadly.com/orders";
            $postdata = array(
                "productId"=> $productId,
                "countryCode"=> $countryCode,
                  "quantity"=> $quantity,
                  "unitPrice"=> $amount,
                  "customIdentifier" => $transactionId_,
                  "senderName" => $senderName,
                  "recipientEmail" => $recipientEmail,
                  "recipientPhoneDetails" => array(
                      "countryCode" => "NG",
                      "phoneNumber" => "8142534829"
                        ),
                );
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $endpoint);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 200);
                curl_setopt($ch, CURLOPT_ENCODING, '');
                curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                //             'Authorization: Bearer eyJraWQiOiI5MTYxZDA4Zi05ODhjLTRiYjItYTI5NS03ODc5NmQ2MzJlM2YiLCJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxMzQ0MyIsImlzcyI6Imh0dHBzOi8vcmVsb2FkbHkuYXV0aDAuY29tLyIsImh0dHBzOi8vcmVsb2FkbHkuY29tL3NhbmRib3giOmZhbHNlLCJodHRwczovL3JlbG9hZGx5LmNvbS9wcmVwYWlkVXNlcklkIjoiMTM0NDMiLCJndHkiOiJjbGllbnQtY3JlZGVudGlhbHMiLCJhdWQiOiJodHRwczovL2dpZnRjYXJkcy5yZWxvYWRseS5jb20iLCJuYmYiOjE2NDg4NDk3MTgsImF6cCI6IjEzNDQzIiwic2NvcGUiOiJkZXZlbG9wZXIiLCJleHAiOjE2NTQwMzM3MTgsImh0dHBzOi8vcmVsb2FkbHkuY29tL2p0aSI6IjQxYzY0ZTFiLWIzM2ItNDRiZS04M2NhLTI5NDUwNGYyYTQzMSIsImlhdCI6MTY0ODg0OTcxOCwianRpIjoiZTliNjlkYjYtMzI4MC00YzkxLTlkYjYtYzA4NDU0OWI4YjBjIn0.MLpBwTkONz8bcd0L6SUJ6y8_SUZ4gDO-ClEEYJ8xdv4',
                //     'Content-Type: application/json',
                //     'Accept: application/com.reloadly.giftcards-v1+json'
                //     ));
            curl_setopt($ch,CURLOPT_HTTPHEADER, array(
             'Authorization: Bearer eyJraWQiOiJjNGE1ZWU1Zi0xYmE2LTQ1N2UtOTI3Yi1lYzdiODliNzcxZTIiLCJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxMzI2OCIsImlzcyI6Imh0dHBzOi8vcmVsb2FkbHktc2FuZGJveC5hdXRoMC5jb20vIiwiaHR0cHM6Ly9yZWxvYWRseS5jb20vc2FuZGJveCI6dHJ1ZSwiaHR0cHM6Ly9yZWxvYWRseS5jb20vcHJlcGFpZFVzZXJJZCI6IjEzMjY4IiwiZ3R5IjoiY2xpZW50LWNyZWRlbnRpYWxzIiwiYXVkIjoiaHR0cHM6Ly9naWZ0Y2FyZHMtc2FuZGJveC5yZWxvYWRseS5jb20iLCJuYmYiOjE2NDk0MDYyOTYsImF6cCI6IjEzMjY4Iiwic2NvcGUiOiJkZXZlbG9wZXIiLCJleHAiOjE2NDk0OTI2OTYsImh0dHBzOi8vcmVsb2FkbHkuY29tL2p0aSI6ImFhMjU2MDJkLTgxZDAtNGQzYy1iNDdkLTZiYTdjN2QzY2ZhNSIsImlhdCI6MTY0OTQwNjI5NiwianRpIjoiZmQ4YjU5OGMtODJiZS00OGM5LTgxYjQtNGFiMDRmOTJiNTAwIn0.2Hcz9g4gYySwmBAb6LVHXJNJ2loaMI6xAj9FYYabONM',
            'Content-Type: application/json',
            'Accept: application/com.reloadly.giftcards-v1+json'
        ));
                    $response = curl_exec($ch);
                    curl_close($ch);
                    $Order = json_decode($response);
                    //  var_dump($Order);
                    
                    
        
        $message                = $Order->message;
        $errorCode              = $Order->errorCode;
        $transactionId          = $Order->transactionId;
        $status                 = $Order->status;
        $transaction_type       = "Giftcard";
        $transaction_type1       = "Debit";
        $transaction_status     = "Completed";
        $description            = "Giftcard and fees";
        $description1            = "Giftcard fees";
        $payment_status         = "Paid";
        $transaction_id         = $transactionId_;
        $user_Id                = $user_id;
        $amount1                = $amount * 0.27;  
        $amount3                = $amount2;
        $currency1              = "USD";
        $ewallet_id             = $wallet;
        $fees                   = "2";
        $fees1                   = "-2";
        $amount2                = $amount1 + $fees;
        
        if (!empty($transactionId && $status)){
             $query = "SELECT* FROM master_wallet_balance WHERE ewallet_id='$wallet'";
        	        $result = @mysqli_query($conn, $query);
        	        if (@mysqli_num_rows($result)==1){
        	            $row = mysqli_fetch_array($result);
        	            $balance    = $row['balance'];
        	            $balance2   = $balance - $amount2;
        	            $newBalance = $balance2;
                        if($newBalance){
                            $query1 = "UPDATE master_wallet_balance
                                    SET balance = $newBalance
                                    WHERE ewallet_id='$wallet'";
                                    $query_run = mysqli_query($conn,$query1);
                                    if($query_run){
                                        $query = "INSERT INTO wallet_transactions (transaction_type,transaction_status,description,payment_status,transaction_id,user_id,amount,currency,ewallet_id)
                                        VALUES('$transaction_type','$transaction_status','$description','$payment_status','$transaction_id ','$user_Id','$amount2','$currency1','$ewallet_id')";
                                        
                                        
                                      /* $query = "INSERT INTO wallet_transactions (transaction_type,transaction_status,description,payment_status,transaction_id,user_id,amount,currency,ewallet_id)
                                        VALUES('$transaction_type1','$transaction_status','$description1','$payment_status','$transaction_id ','$user_Id','$fees1','$currency1','$ewallet_id')";*/
                                        
                                        
                                        $run = mysqli_query($conn,$query);
                                        if($run){ 
                                            header('location:getProductISO.php?success= you successfully purchased a GiftCard');
                                                          }
                                        else { 
                                            header('location:getProductISO.php?error= The giftcard transaction was not successful');
                                            }
                                    }
                                    else{
                                    header('location:getProductISO.php?error= something went wrong');
                                    }
        	            }
                	    else{
                	         header('location:getProductISO.php?error= New Balance is Undefine');
                	            }
        	                }
        	        elseif(@mysqli_num_rows($result)==0){
                                 header('location:getProductISO.php?error= Something went wrong');   
                                }
                    else{
                        header('location:getProductISO.php?error= Something went wrong'); 
                        // echo $message,' ',$errorCode  ;
                        }
        }
        else{
            header('location:getProductISO.php?error= Something went wrong'); 
            // echo $message,' ',$errorCode  ;
            }
	   }
	        }
	        else{
                header('location:getProductISO.php?error= Something went wrong'); 
                // echo $message,' ',$errorCode  ;
                }
    }
        ?>
        <!DOCTYPE>
        <!DOCTYPE html>
        <html>
        <head>
        	<title></title>
        </head>
        <body>
            <?php echo $_SESSION['user_id'];?> <br>
        		<?php	echo $_SESSION['ewallet_id'];?>
        </body>
        </html>
    ?>
    
    
