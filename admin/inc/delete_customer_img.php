<?php
header('Content-Type: application/json');

include_once 'config.php';

$response = array('status' => 'error', 'message' => 'Invalid request');

if (isset($_GET['img_id'])) {
    $imglink = $_GET['img_id'];

    // Select image info securely
    $stmt = $conn->prepare("SELECT * FROM olnee_customer_cam WHERE img_id = ?");
    $stmt->bind_param("s", $imglink);
    $stmt->execute();
    $result = $stmt->get_result();
    $pimgrowdelete = $result->fetch_assoc();
    $stmt->close();

    if ($pimgrowdelete) {
        $img = '../' . $pimgrowdelete['image_path'];

        // Delete file from filesystem
        if (file_exists($img) && unlink($img)) {

            // Delete image record from DB securely
            $stmtDel = $conn->prepare("DELETE FROM olnee_customer_cam WHERE img_id = ?");
            $stmtDel->bind_param("s", $imglink);

            if ($stmtDel->execute()) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Image deleted successfully',
                    'img_id' => $imglink
                );
            } else {
                $response = array(
                    'status' => 'info',
                    'message' => 'Image record could not be deleted'
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