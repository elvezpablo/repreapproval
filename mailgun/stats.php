<?php
/**
 * Created by PhpStorm.
 * User: paul.rangel
 * Date: 7/22/14
 * Time: 1:14 PM
 */
require '../../vendor/autoload.php';

include('RPAMailGun.php');

$mailgun = new RPAMailGun();
header('Content-Type: application/json');
echo $mailgun->stats();