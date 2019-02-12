<?php
/**
 * Created by PhpStorm.
 * User: PAD
 * Date: 06.02.2019
 * Time: 11:38
 */

include_once ("bootstrap.php");

try {
    $pricinglist = new \App\PricingList();
} catch (Exception $e) {
    exit("Something wrong here");
}


$co = new \App\Checkout();
$co->scan("A");
$co->scan("A");
$co->scan("A");
$co->scan("A");
$co->scan("A");
$co->scan("A");
echo $co->total();

