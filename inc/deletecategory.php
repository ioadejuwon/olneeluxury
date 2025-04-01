<?php
include_once 'config.php';
include_once "drc.php";

$response = array('status' => false, 'message' => 'Category could not be deleted');

if (isset($_POST['category_id'])) {
    // error_log("Product ID received: " . $_POST['product_id']);
    $delete_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    $sql = mysqli_query($conn, "DELETE FROM olnee_categories WHERE categoryid = '{$delete_id}'");
    if ($sql) {
        // header("Location: " . PRODUCTS . "?status=productDeleted");
        $response['status'] = true;
        $response['message'] = 'Category deleted successfully';
    }
} else {
    // header("Location: " . PRODUCTS . "?status=noproductID");
    $response['status'] = false;
        $response['message'] = 'Category ID not received';
}
echo json_encode($response);

