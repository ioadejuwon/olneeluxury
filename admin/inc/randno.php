<?php

include_once "config.php";

function getName($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $index = random_int(0, $charactersLength - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}

// Individual ID generators — use only when needed
function generateUserID() {
    return getName(7);
}

function generateCategoryID() {
    return "cat-" . getName(3) . '-' . getName(3);
}

function generateProductID() {
    return "prod-" . getName(3) . '-' . getName(3);
}

function generateImageID() {
    return "img-" . getName(3) . '-' . getName(3);
}

function generateCamID() {
    return "cam-" . getName(3) . '-' . getName(3);
}

function generateCartID() {
    return "cart-" . getName(3);
}

function generateOrderID() {
    return "order-" . getName(4) . '-' . getName(4);
}

function generateDeliveryID() {
    return 'del-' . getName(5) . '-' . getName(10);
}

function generateCouponID() {
    return 'coupon-' . getName(5);
}


// $j=3; //Category ID for product categories
// $k=7; //User ID for new accounts 
// $l=3; //Product ID for products
// $m=3; //cart ID for add_to_cart
// $n=10; //File renaming unique
// $p=4; //Order ID
// $q=4; //Order ID
// $r=5; //Order ID

// function getName($n) {
//     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $randomString = '';
 
//     for ($i = 0; $i < $n; $i++) {
//         $index = rand(0, strlen($characters) - 1);
//         $randomString .= $characters[$index];
//     }
 
//     return $randomString;
// }

// $uid = getName($n);

// $user_id = getName($k);
// $categoryID = "cat-".getName($j).'-'.getName($j);
// $productID = "prod-".getName($l).'-'.getName($l);
// $imgID = "img-".getName($l)."-".getName($j);
// $camID = "cam-".getName($l)."-".getName($j);
// $orderID = "order-".getName($p).'-'.getName($q);
// $delivery_id = 'del-'.getName($r).'-'.getName($n);
// $coupon_id = 'coupon-'.getName($r);