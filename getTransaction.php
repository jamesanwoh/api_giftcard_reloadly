<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://giftcards.reloadly.com/reports/transactions?startDate=2022-03-01%2000:00:00&endDate=2022-04-05%2023:17:02',
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
));

$response = curl_exec($curl);

curl_close($curl);

// echo($response);

$transactions = json_decode($response);
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<main role="main" class="flex-shrink-0">
     <div class="container pt-5 mt-5" >
         <div class="col">
             <div class="row">
                 <div style="border:1px solid gray; width:100%; border-radius:40px">
                 <?php foreach($transactions->content as $transaction){ ?>
                    <div class="col-2"><?=$transaction->transactionId?></div>
                    <div class="col-2"><?=$transaction->amount?></div>
                    <div class="col-2"><?=$transaction->recipientEmail?></div>
                    <div class="col-2"><?=$transaction->status?></div>
                    <div class="col-2"><?=$transaction->product->productName?></div><br>
                    <a href="getTransactionId.php?Id=<?=$transaction->transactionId?>"><button class="btn btn-primary">VIEW <i class="fa fa-paper-plane"></i></button></a>
                <?php  } ?>
                </div>
            </div>
        
         </div>
     </div>
 </main>
