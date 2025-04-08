<?php
header('Content-Type: application/json'); // Let the client know we're sending JSON

include_once 'config.php';
include_once 'drc.php';

$response = array('status' => 'error', 'message' => 'Invalid request');

if (isset($_GET['productid']) && isset($_GET['img_id'])) {
    $imgdelete_id = mysqli_real_escape_string($conn, $_GET['productid']);
    $imglink = mysqli_real_escape_string($conn, $_GET['img_id']);

    $selectprod_img = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '{$imgdelete_id}' AND img_id = '{$imglink}'");
    $pimgrowdelete = mysqli_fetch_assoc($selectprod_img);

    if ($pimgrowdelete) {
        $img = '../' . $pimgrowdelete['image_path'];

        // Attempt to delete the file
        if (file_exists($img) && unlink($img)) {
            // Check if it was a thumbnail
            if ($pimgrowdelete['thumbnail'] == 1) {
                $sqlUpdate = "UPDATE product_images SET thumbnail = 1 WHERE product_id = ?";
                $stmtUpdate = mysqli_prepare($conn, $sqlUpdate);
                mysqli_stmt_bind_param($stmtUpdate, "s", $imgdelete_id);
                mysqli_stmt_execute($stmtUpdate);
                mysqli_stmt_close($stmtUpdate);
            }

            // Delete the DB record
            $sql2 = mysqli_query($conn, "DELETE FROM product_images WHERE img_id = '{$imglink}' AND product_id = '{$imgdelete_id}'");

            if ($sql2) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Product image deleted successfully',
                    'img_id' => $imglink
                );
            } else {
                $response = array(
                    'status' => 'info',
                    'message' => 'Product image record could not be deleted'
                );
            }
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
