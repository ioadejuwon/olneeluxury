<?php
include_once 'config.php';
include_once "drc.php";

$response = array('status' => false, 'message' => 'Product could not be deleted');

if (isset($_POST['product_id'])) {
    // error_log("Product ID received: " . $_POST['product_id']);
    $delete_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $sql = mysqli_query($conn, "DELETE FROM products WHERE productid = '{$delete_id}'");
    if ($sql) {
        $selectprod_img = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '{$delete_id}'");
        while ($pimgrowdelete = mysqli_fetch_assoc($selectprod_img)) {
            $img1 = '../' . $pimgrowdelete['image_path'];
            unlink("$img1");
            $sql = mysqli_query($conn, "DELETE FROM product_images WHERE product_id = '{$delete_id}'");
        }
        // header("Location: " . PRODUCTS . "?status=productDeleted");
        $response['status'] = true;
        $response['message'] = 'Product deleted successfully';
    }
} else {
    // header("Location: " . PRODUCTS . "?status=noproductID");
    $response['status'] = false;
        $response['message'] = 'Product ID not received';
}
echo json_encode($response);

