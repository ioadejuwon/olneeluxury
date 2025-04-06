<?php
include_once '../inc/config.php';
include_once "../inc/drc.php";
include_once '../inc/randno.php';

// $response = [];
$response = array('status' => 'error', 'message' => '');

if (empty($_POST['producttitle']) || empty($_POST['productdescription']) || empty($_POST['price'])) {
    // $response = ['success' => false, 'message' => 'Please, fill all required fields.'];
    $response['status'] = 'error';
    $response['message'] = 'Please, fill all required fields.';
} else {
    $producttitle = htmlspecialchars($_POST['producttitle']);
    $user_id = $_POST['user_id'];
    $yards = $_POST['yards'];
    $productcategory = $_POST['productcategory'];
    $price = (int)$_POST['price'];
    $discount_price = isset($_POST['discount_price']) ? (int)$_POST['discount_price'] : 0;
    $productdescription = htmlspecialchars($_POST['productdescription']);
    $shortdescription = htmlspecialchars($_POST['shortdescription']);
    $product_id = $productID;

    // Insert form data into the products table
    $insertFormDataQuery = "INSERT INTO products (productid, producttitle, user_id, yards, productcategory, price, discount_price, productdescription, shortdescription, availability) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1)";
    $stmt = mysqli_prepare($conn, $insertFormDataQuery);
    mysqli_stmt_bind_param($stmt, "sssisssss", $product_id, $producttitle, $user_id, $yards, $productcategory, $price, $discount_price, $productdescription, $shortdescription);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        // $response = ['success' => true, 'product_id' => $product_id];
        $response['status'] = 'success';
        $response['product_id'] = $product_id;
        $response['message'] = 'Update store details.';
    } else {
        // $response = ['success' => false, 'message' => 'Database error: ' . mysqli_stmt_error($stmt)];
        $response['status'] = 'error';
        $response['message'] = 'Database error: ' . mysqli_stmt_error($stmt);
    }
}

echo json_encode($response);
