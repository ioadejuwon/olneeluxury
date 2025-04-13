<?php
include_once '../inc/config.php';
include_once "../inc/drc.php";
include_once '../inc/randno.php';

$response = array('status' => 'error', 'message' => '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $producttitle = $_POST['producttitle'];
    // $user_id = $_POST['user_id'];
    $product_id = $_POST['productid'];
    $yards = $_POST['yards'];
    $productcategory = $_POST['productcategory'];
    $price = $_POST['price'];
    $discount_price = $_POST['discount_price'];
    // $shortdescription = $_POST['shortdescription'];
    // $productdescription = $_POST['productdescription'];
    $shortdescription = htmlspecialchars( $_POST['shortdescription'], ENT_QUOTES, 'UTF-8' ); // Sanitize input
    $productdescription = htmlspecialchars( $_POST['productdescription'], ENT_QUOTES, 'UTF-8' ); // Sanitize input

    // Validate input data
    if (empty($producttitle) || empty($yards) || empty($productcategory) || empty($price) || empty($shortdescription) || empty($productdescription)) {
        $response['status'] = 'info';
        $response['message'] = 'All required fields must be filled out.';
        echo json_encode($response);
        exit();
    } elseif (strlen($producttitle) > 25) {
        $response['message'] = 'Product Name is too long. Maximum of 25 characters allowed.';
        echo json_encode($response);
        exit();
    }elseif (strlen($shortdescription) > 255) {
        $response['message'] = 'Short Description is too long. Maximum of 255 characters allowed.';
        echo json_encode($response);
        exit();
    }elseif (strlen($productdescription) > 1000) {
        $response['message'] = 'Product Description is too long. Maximum of 1000 characters allowed.';
        echo json_encode($response);
        exit();
    }

    // Validate price and discount_price to ensure they are numbers and non-negative
    if (!is_numeric($price) || $price < 0) {
        $response['message'] = 'Invalid price value. It must be a positive number.';
        echo json_encode($response);
        exit();
    }

    if (!is_numeric($discount_price) || $discount_price < 0) {
        $response['message'] = 'Invalid discount price value. It must be a positive number.';
        echo json_encode($response);
        exit();
    }
    // Sanitize and cast the numeric fields
    $yards = (int)$yards;
    $price = (float)$price;
    $discount_price = (float)$discount_price;

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
            // $response['success'] = true;
            // $response['message'] = 'Product updated successfully.';
            $response['status'] = 'success';
            // $response['product_id'] = $product_id;
            $response['message'] = 'Product updated successfully.';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . $conn->error;
    }

    $conn->close();
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
exit();