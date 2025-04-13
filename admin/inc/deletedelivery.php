<?php
header('Content-Type: application/json');

include_once 'config.php';
include_once "drc.php";

$response = array('status' => false, 'message' => 'Delivery rate could not be deleted');

if (isset($_POST['delivery_id'])) {
    $deliveryId = $_POST['delivery_id'];

    // Use a prepared statement
    $stmt = $conn->prepare("DELETE FROM olnee_delivery WHERE deliveryID = ?");
    $stmt->bind_param("s", $deliveryId);

    if ($stmt->execute()) {
        $response['status'] = true;
        $response['message'] = 'Delivery rate deleted successfully';
    } else {
        $response['message'] = 'Failed to delete delivery rate';
    }

    $stmt->close();
} else {
    $response['message'] = 'Delivery ID not received';
}

echo json_encode($response);
exit;
