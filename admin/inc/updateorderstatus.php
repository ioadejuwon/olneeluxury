<?php
include_once 'config.php'; // Include your database connection
include_once "randno.php";
include_once "drc.php";

$orderid = $_GET['orderid'];  // Retrieve this based on your setup
$filter = $_GET['status'];  // Get the filter parameter from the AJAX request

$whereClause = "";
$productClause = "";
$linkClause = "";

switch ($filter) {
	case 'processing':
		$whereClause = "AND DATE(created_at) = CURDATE()";
		break;
	case 'paid':
		$whereClause = "AND WEEK(created_at) = WEEK(CURDATE())";
		break;
	case 'sent':
		$whereClause = "AND MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())";
		break;
	case 'delivered':
		$whereClause = "AND YEAR(created_at) = YEAR(CURDATE())";
		break;
}


// Update the availability in the database
$query = "UPDATE olnee_orders SET status = ? WHERE order_id = ?";

if ($stmt = $conn->prepare($query)) {
	$stmt->bind_param("is", $status, $order_id);

	if ($stmt->execute()) {
		$response['success'] = true;
		if ($status == 1) {
			$response['message'] = 'Product is now available.';
		} else {
			$response['message'] = 'Product is now unavailable.';
		}
	}
}


// Fetch total order amount
$orders_sql_success = mysqli_query($conn, "SELECT SUM(total) AS totalprice FROM olnee_orders  WHERE status = 'Successful' $whereClause");
$orderrow = mysqli_fetch_assoc($orders_sql_success);
$order_amount = $orderrow['totalprice'];
$total_amount =  $order_amount;


// Return the data as JSON
echo json_encode($response);

$conn->close();
