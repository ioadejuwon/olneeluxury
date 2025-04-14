<?php
include_once 'config.php';
include_once "drc.php";

$response = array('status' => false, 'message' => 'Product could not be deleted');

if (isset($_POST['product_id'])) {
    $delete_id = $_POST['product_id'];

    // Step 1: Get all related images
    $stmtSelect = $conn->prepare("SELECT image_path FROM product_images WHERE product_id = ?");
    $stmtSelect->bind_param("s", $delete_id);
    $stmtSelect->execute();
    $result = $stmtSelect->get_result();

    while ($row = $result->fetch_assoc()) {
        $imgPath = '../' . $row['image_path'];
        if (file_exists($imgPath)) {
            unlink($imgPath);
        }
    }
    $stmtSelect->close();

    // Step 2: Delete product_images
    $stmtDeleteImages = $conn->prepare("DELETE FROM product_images WHERE product_id = ?");
    $stmtDeleteImages->bind_param("s", $delete_id);
    $stmtDeleteImages->execute();
    $stmtDeleteImages->close();

    // Step 3: Delete product
    $stmtDeleteProduct = $conn->prepare("DELETE FROM products WHERE productid = ?");
    $stmtDeleteProduct->bind_param("s", $delete_id);
    if ($stmtDeleteProduct->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'Product deleted successfully';
    }
    $stmtDeleteProduct->close();

} else {
    $response['message'] = 'Product ID not received';
}

echo json_encode($response);
exit;