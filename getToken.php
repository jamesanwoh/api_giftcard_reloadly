<?php

  $curl = curl_init();

  curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://auth.reloadly.com/oauth/token',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
	"client_id":"NiqqC7jqfada4IZWgOfGaMwlxB2UuSzA",
	"client_secret":"2nMgNkdGuG-U76qv2Kr9PpeDgGnjnX-juE9jY3ZMwtNta5kZ6QzO7HY7XMrOkpL",
	"grant_type":"client_credentials",
	"audience":"https://giftcards.reloadly.com"
}',/*
  CURLOPT_POSTFIELDS =>'{
	"client_id":"KOaabvnuV7KlHMYOEgeHDWd4PJhskcoY",
	"client_secret":"7b2KvHzktT-n3sZwuysDHklvrFNFAx-e5dqCreEM8SSNNVw3Op1OBxOJPWH4aeU",
	"grant_type":"client_credentials",
	"audience":"https://giftcards-sandbox.reloadly.com"
}',*/
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

// $token_response = json_decode($response);

// var_dump($token_response);

echo $response;

?>

