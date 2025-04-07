<?php
include_once 'config.php'; // Include your database connection
include_once "randno.php";
include_once "drc.php";

$orderid = $_GET['orderid'];  // Retrieve this based on your setup
$filter = $_GET['status'];  // Get the filter parameter from the AJAX request

$whereClause = "";

switch ($filter) {
	case 'pending':
		$status = 1;
		break;
	case 'paid':
		$status = 2;
		break;
	case 'processed':
		$status = 3;
		break;
	case 'delivered':
		$status = 4;
		break;
	case 'failed':
		$status = 0;
		break;
}


// Update the availability in the database
$query = "UPDATE olnee_orders SET status = ? WHERE order_id = ?";

if ($stmt = $conn->prepare($query)) {
	$stmt->bind_param("is", $status, $orderid);

	if ($stmt->execute()) {
		$response['success'] = true;
		$response['status'] = 'success';
		$response['order_status_level'] = $status;
		if ($status == 1) {
			$response['order_status'] = 'Payment Pending';
			$response['message'] = 'Order updated to Payment Pending';
		} elseif ($status == 2) {
			$response['order_status'] = 'Payment Confirmed';
			$response['message'] = 'Order updated to Payment Confirmed';
		} elseif ($status == 3) {
			$response['order_status'] = 'Processed';
			$response['message'] = 'Order updated to Order Processed';
		} elseif ($status == 4) {
			$response['order_status'] = 'Delivered';
			$response['message'] = 'Order updated to Order Delivered';
		} elseif ($status == 0) {
			$response['order_status'] = 'Payment Failed';
			$response['message'] = 'Order updated to Payment Failed';
		} else {
			$response['message'] = 'Product is now unavailable.';
		}
	}
}


// // Fetch total order amount
// $orders_sql_success = mysqli_query($conn, "SELECT SUM(total) AS totalprice FROM olnee_orders  WHERE status = 'Successful' $whereClause");
// $orderrow = mysqli_fetch_assoc($orders_sql_success);
// $order_amount = $orderrow['totalprice'];
// $total_amount =  $order_amount;


// Return the data as JSON
echo json_encode($response);

$conn->close();
