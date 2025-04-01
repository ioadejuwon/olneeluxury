<?php
include_once '../inc/config.php'; // Include your database configuration

header('Content-Type: application/json'); // Ensure the content type is JSON

$response = []; // Initialize response array

if (isset($_POST['image_id']) && isset($_POST['product_id'])) {
    $image_id = $_POST['image_id'];
    $product_id = $_POST['product_id'];
    
    // Begin transaction
    mysqli_begin_transaction($conn);

    try {
        // Set all thumbnails for this product to 0
        $sqlReset = "UPDATE product_images SET thumbnail = 0 WHERE product_id = ?";
        $stmtReset = mysqli_prepare($conn, $sqlReset);
        mysqli_stmt_bind_param($stmtReset, "s", $product_id);
        mysqli_stmt_execute($stmtReset);
        mysqli_stmt_close($stmtReset);

        // Set the selected thumbnail to 1
        $sqlUpdate = "UPDATE product_images SET thumbnail = 1 WHERE img_id = ?";
        $stmtUpdate = mysqli_prepare($conn, $sqlUpdate);
        mysqli_stmt_bind_param($stmtUpdate, "s", $image_id); // Change 'i' to 's' for string
        if (mysqli_stmt_execute($stmtUpdate)) {
            mysqli_commit($conn); // Commit transaction
            $response = ['status' => 'success', 'message' => 'Thumbnail updated successfully.'];
        } else {
            mysqli_rollback($conn); // Rollback transaction
            $response = ['status' => 'error', 'message' => 'Database error: ' . mysqli_stmt_error($stmtUpdate)];
        }
        mysqli_stmt_close($stmtUpdate);
    } catch (Exception $e) {
        mysqli_rollback($conn); // Rollback transaction on error
        $response = ['status' => 'error', 'message' => 'Transaction failed: ' . $e->getMessage()];
    }
} else {
    $response = ['status' => 'error', 'message' => 'Invalid request.'];
}

echo json_encode($response);

mysqli_close($conn);
?>
