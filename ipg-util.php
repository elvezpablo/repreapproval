<?php
$dateTime = date("Y:m:d-H:i:s");
function getDateTime() {
global $dateTime;
return $dateTime;
}
function createHash($chargetotal, $currency) {
$storeId = "10123456789";
$sharedSecret = "sharedsecret";
$stringToHash = $storeId . getDateTime() . $chargetotal .
$currency . $sharedSecret;
$ascii = bin2hex($stringToHash);
return sha1($ascii);
}
?>