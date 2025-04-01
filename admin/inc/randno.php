<?php

include_once "config.php";

$j=3; //Category ID for product categories
$k=7; //User ID for new accounts 
$l=3; //Product ID for products
$m=3; //cart ID for add_to_cart
$n=10; //File renaming unique
$p=4; //Order ID
$q=4; //Order ID
$r=5; //Order ID

function getName($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
 
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
 
    return $randomString;
}

$uid = getName($n);

$user_id = getName($k);
$categoryID = "cat-".getName($j).'-'.getName($j);
$productID = "prod-".getName($l).'-'.getName($l);
$imgID = "img-".getName($l)."-".getName($j);
$orderID = "order-".getName($p).'-'.getName($q);
$delivery_id = 'del-'.getName($r).'-'.getName($n);
$coupon_id = 'coupon-'.getName($r);