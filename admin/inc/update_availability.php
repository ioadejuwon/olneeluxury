<?php
include_once 'config.php';
include_once "drc.php";

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST["product_id"];
    $status = $_POST["status"];

    // Validate input data: Use `isset()` instead of `empty()` to allow status = 0
    if (!isset($product_id) || !isset($status)) {
        $response['message'] = 'All required fields must be filled out.';
        echo json_encode($response);
        exit();
    }

    // Update the availability in the database
    $query = "UPDATE products SET availability = ? WHERE productid = ?";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("is", $status, $product_id);
        
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Availability updated successfully.';
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
