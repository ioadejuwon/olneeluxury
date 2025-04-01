<?php
include_once 'config.php';
include_once "randno.php";
include_once "drc.php";


$response = array(); // Initialize response array

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['deliveryname']) || empty($_POST['deliverycost']) || empty($_POST['user_id'])) {
        $response['status'] = 'error';
        $response['message'] = 'Please fill in the required field';
    } else {
        // Capture and sanitize input
        $user_id = $_POST['user_id'];
        $deliveryName = $_POST['deliveryname'];
        $deliveryCost = $_POST['deliverycost'];
        $date = date("D., jS M.");

        $deliveryID = $delivery_id; // Generate a unique ID
        // $category_link = $domainstore . $biz_id . '?category=' . $categoryID;

        // Check if the category already exists using a prepared statement
        $stmt = $conn->prepare("SELECT COUNT(*) FROM olnee_delivery WHERE deliveryName = ? AND user_id = ?");
        $stmt->bind_param("ss", $deliveryName, $user_id);
        $stmt->execute();
        $stmt->bind_result($count_row);
        $stmt->fetch();
        $stmt->close();

        if($count_row >0){
            $response['status'] = 'error';
            $response['message'] = 'Delivery Name already exists!';
        }elseif (empty($deliveryName) || preg_match('/[^a-zA-Z0-9 -]/ ', $deliveryName)) {
            $response['status'] = 'error';
            $response['message'] = 'One or more characters is not allowed!';
        } else {
            // Insert the new category using a prepared statement
            $stmt = $conn->prepare("INSERT INTO olnee_delivery (deliveryID, deliveryName, deliveryCost, user_id) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $deliveryID, $deliveryName, $deliveryCost, $user_id);

            if ($stmt->execute()) {
                $response['status'] = 'success';
                $response['message'] = 'Delivery Rate added successfully!';
                $response['deliveryname'] = $deliveryName;
                $response['delivery_id'] = $deliveryID;
                $response['deliverycost'] = '&#8358;' . number_format($deliveryCost, 2);

                $response['deliverydate'] = $date;;
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Failed to add delivery rate. Please try again.';
            }

            $stmt->close();
        }
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

// Close the database connection
$conn->close();

// Return the response as JSON
echo json_encode($response);
