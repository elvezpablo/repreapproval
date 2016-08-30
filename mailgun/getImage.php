<?php
/**
 * Created by PhpStorm.
 * User: paul.rangel
 * Date: 7/22/14
 * Time: 6:17 AM
 */
include('RPAMailGun.php');

if(array_key_exists('t', $_GET)) {
   $mailgun = new RPAMailGun();
   $mailgun->trackEmailOpened($_GET['t']);
}

$name = 'tracking.png';
$fp = fopen($name, 'rb');


header("Content-Type: image/png");
header("Content-Length: " . filesize($name));

fpassthru($fp);