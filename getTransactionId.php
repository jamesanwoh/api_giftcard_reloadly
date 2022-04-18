<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}
$curl = curl_init();

$Id = isset($_GET['Id'])?$_GET['Id']:null;

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://giftcards.reloadly.com/reports/transactions/'.$Id,
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
// echo $response;
$transactionId = json_decode($response);
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <div class="row xe__balanceblock" style="clear:both">
        <div class="col-md-4">
            <div class="card">
                <div class="modal-content">
                    <div class="modal-body">
                        <div >   
                            <form>
                                <div class="form-group">
                                    <h6 class="modal-title">transactionId:_<?=$transactionId->transactionId?></h4>
                                    <h6 class="modal-title">amount:_<?=$transactionId->amount?></h4>
                                    <h6 class="modal-title">countryCode:_<?=$transactionId->countryCode?></h4>
                                    <h6 class="modal-title">recipientEmail:_<?=$transactionId->recipientEmail?></h4>
                                    <h6 class="modal-title">customIdentifier:_<?=$transactionId->customIdentifier?></h4>
                                    <h6 class="modal-title">status:_<?=$transactionId->status?></h4>
                                    <h6 class="modal-title">product Name:_<?=$transactionId->product->productName?></h4>
                                    <h6 class="modal-title">unit Price:_<?=$transactionId->unitPrice?></h4>
                                    <h6 class="modal-title">brand Name<?=$transactionId->brand->brandName?></h4>
                                    <h6 class="modal-title">transactionCreatedTime<?=$transactionId->transactionCreatedTime?></h4>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
