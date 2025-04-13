<?php
include_once 'config.php';

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

    // Ensure status is either 0 or 1
    if (!in_array($status, [0, 1], true)) {
        $response['message'] = 'Invalid status value. It should be 0 or 1.';
        echo json_encode($response);
        exit();
    }

    // Update the availability in the database
    $query = "UPDATE products SET availability = ? WHERE productid = ?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("is", $status, $product_id);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = ($status == 1) ? 'Product is now available.' : 'Product is now unavailable.';
            // if ($status == 1) {
            //     $response['message'] = 'Product is now available.';
            // } else {
            //     $response['message'] = 'Product is now unavailable.';
            // }
            // $response['message'] = 'Availability updated successfully.';
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
exit();