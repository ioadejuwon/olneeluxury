<?php
include_once 'config.php';
include_once "drc.php";

$response = array('status' => 'error', 'message' => 'Category could not be deleted');

if (isset($_POST['category_id'])) {
    $delete_id = $_POST['category_id'];

    $stmt = $conn->prepare("DELETE FROM olnee_categories WHERE categoryid = ?");
    $stmt->bind_param("s", $delete_id);

    if ($stmt->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'Category deleted successfully';
    }

    $stmt->close();
} else {
    $response['message'] = 'Category ID not received';
}

echo json_encode($response);
exit;