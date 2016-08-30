<?php
$url = 'https://api.globalgatewaye4.firstdata.com/transaction/v11';

$data = array('gateway_id' =>'C04641-01', 'password' =>'verutesting123', 'transaction_type' => 05, "amount" => 11, "cardholder_name" => 'Testing', "cc_number" => 5500000000000004, "cc_expiry" => 0915);
$data_string= json_encode($data);

// Initializing curl
$ch = curl_init( $url );
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=UTF-8;','Accept: application/json' ));

// Getting results
$result = curl_exec($ch);

// Getting jSON result string
$data_string = json_decode($result);

if ($data_string) {
if ($data_string->bank_resp_code == 100) {
print('Approved!');
} else {
print($data_string->bank_message);
}
} else {
print($result);
}
?>