<?php
header('Content-Type: application/json');

include_once 'config.php';

$response = array('status' => 'error', 'message' => 'Invalid request');

if (isset($_GET['productid']) && isset($_GET['img_id'])) {
    $productId = $_GET['productid'];
    $imgId = $_GET['img_id'];

    // Step 1: Fetch the image details securely
    $stmt = $conn->prepare("SELECT * FROM product_images WHERE product_id = ? AND img_id = ?");
    $stmt->bind_param("ss", $productId, $imgId);
    $stmt->execute();
    $result = $stmt->get_result();
    $pimgrowdelete = $result->fetch_assoc();
    $stmt->close();

    if ($pimgrowdelete) {
        $img = '../' . $pimgrowdelete['image_path'];

        // Step 2: Delete the image file from the server
        if (file_exists($img) && unlink($img)) {

            // Step 3: If the image was a thumbnail, update another one
            if ($pimgrowdelete['thumbnail'] == 1) {
                $sqlUpdate = "UPDATE product_images SET thumbnail = 1 WHERE product_id = ? LIMIT 1";
                $stmtUpdate = $conn->prepare($sqlUpdate);
                $stmtUpdate->bind_param("s", $productId);
                $stmtUpdate->execute();
                $stmtUpdate->close();
            }

            // Step 4: Delete the image record securely
            $stmtDel = $conn->prepare("DELETE FROM product_images WHERE product_id = ? AND img_id = ?");
            $stmtDel->bind_param("ss", $productId, $imgId);

            if ($stmtDel->execute()) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Product image deleted successfully',
                    'img_id' => $imgId
                );
            } else {
                $response = array(
                    'status' => 'info',
                    'message' => 'Product image record could not be deleted'
                );
            }

            $stmtDel->close();
        } else {
            $response = array(
                'status' => 'info',
                'message' => 'Product image file could not be deleted'
            );
        }
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Image not found'
        );
    }
}

echo json_encode($response);
exit;