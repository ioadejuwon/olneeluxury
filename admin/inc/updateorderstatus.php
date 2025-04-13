<?php
include_once 'config.php'; // Include your database connection
include_once "randno.php";
include_once "drc.php";
require '../../sendmail.php';

$orderid = $_GET['orderid'];  // Retrieve this based on your setup
$filter = $_GET['status'];  // Get the filter parameter from the AJAX request
// $email = $_GET['email'];  // Get the filter parameter from the AJAX request

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

$ordersql = mysqli_query($conn, "SELECT email, first_name, last_name FROM olnee_orders WHERE order_id = '$orderid'");
$count_row_orders = mysqli_num_rows($ordersql);
if ($count_row_orders > 0) {
	$row_order = mysqli_fetch_assoc($ordersql);
	$customeremail = $row_order['email'];
	$fname = $row_order['first_name'];
	$lname = $row_order['last_name'];
	$fullName = $fname . ' ' . $lname;

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
				$response['message'] = 'Order not updated.';
			}
			// $response['order_status'] = $orderStatus;



		}



			$templatePath = '../email/orderupdate.html';

			if (!file_exists($templatePath)) {
				$response['status'] = 'error';
				$response['message'] = 'Email template not found: ' . $templatePath;
			} else {
				$order_status = $response['order_status'];
				$subject = "Status Update on your Order #" . $orderid . " 📦📦";
				$emailSent9 = sendNewMail(
					$to = $customeremail,
					$toName = $fname,
					$subject,
					$templatePath, // Path to the email template
					$response,
					[
						'COMPANY' => COMPANY,
						'BASE_URL' => BASE_URL,
						'ORDER_LINK' => ORDER . $orderid,
						'ORDER_ID' => $orderid,
						'ORDER_STATUS' => $order_status,
						'CUSTOMER_NAME' => $fullName,
						'BRAND_EMAIL' => BRAND_EMAIL,
						'YEAR' => FOOTERYEAR
					],
					$from = BRAND_EMAIL,
					$fromName = COMPANY,
					$replyTo = REPLY_TO,
				);
				if ($emailSent9) {
					$response['status'] = 'success';
					$response['message'] = 'Order status updated successfully and email sent.';
					// $response['message'] = 'Email sent successfully.';
				} else {
					$response['status'] = 'error';
					$response['message'] = "Email failedp: " . ($response['email_error'] ?? 'Unknown error');
				}
				
			}
	}
} else {
	$response['status'] = 'error';
	$response['message'] = 'Order not found.';
}


// // Fetch total order amount
// $orders_sql_success = mysqli_query($conn, "SELECT SUM(total) AS totalprice FROM olnee_orders  WHERE status = 'Successful' $whereClause");
// $orderrow = mysqli_fetch_assoc($orders_sql_success);
// $order_amount = $orderrow['totalprice'];
// $total_amount =  $order_amount;


// Return the data as JSON
echo json_encode($response);

$conn->close();
