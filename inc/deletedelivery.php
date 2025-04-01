<?php
include_once 'config.php';
include_once "drc.php";

$response = array('status' => false, 'message' => 'Delivery tate could not be deleted');

if (isset($_POST['delivery_id'])) {
    // error_log("Product ID received: " . $_POST['product_id']);
    $delete_id = mysqli_real_escape_string($conn, $_POST['delivery_id']);
    $sql = mysqli_query($conn, "DELETE FROM olnee_delivery WHERE deliveryID = '{$delete_id}'");
    if ($sql) {
        // header("Location: " . PRODUCTS . "?status=productDeleted");
        $response['status'] = true;
        $response['message'] = 'Category deleted successfully';
    }
} else {
    // header("Location: " . PRODUCTS . "?status=noproductID");
    $response['status'] = false;
        $response['message'] = 'Delivery ID not received';
}
echo json_encode($response);

