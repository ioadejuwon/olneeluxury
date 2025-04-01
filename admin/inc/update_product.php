<?php
include_once '../inc/config.php';
include_once "../inc/drc.php";
include_once '../inc/randno.php';

$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $producttitle = $_POST['producttitle'];
    // $user_id = $_POST['user_id'];
    $product_id = $_POST['productid'];
    $yards = $_POST['yards'];
    $productcategory = $_POST['productcategory'];
    $price = $_POST['price'];
    $discount_price = $_POST['discount_price'];
    $shortdescription = $_POST['shortdescription'];
    $productdescription = $_POST['productdescription'];

    // Validate input data
    if (empty($producttitle) || empty($yards) || empty($productcategory) || empty($price) || empty($shortdescription) || empty($productdescription)) {
        // $response['success'] = false;
        $response['message'] = 'All required fields must be filled out.';
        echo json_encode($response);
        exit();
    }elseif(strlen($producttitle) > 25) {
        $response['message'] = 'Product Name is too long. Maximum of 25 characters allowed.';
        echo json_encode($response);
        exit();
    }

    // Update the product details in the database
    $sql = "UPDATE products SET 
            producttitle = ?, 
            yards = ?, 
            productcategory = ?, 
            price = ?, 
            discount_price = ?, 
            shortdescription = ?, 
            productdescription = ? 
            WHERE productid = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('sissdsss', $producttitle, $yards, $productcategory, $price, $discount_price, $shortdescription, $productdescription, $product_id);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Product updated successfully.';
        } else {
            $response['message'] = 'Error: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        $response['message'] = 'Error: ' . $conn->error;
    }

    $conn->close();
} else {
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
