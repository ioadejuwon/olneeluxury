<?php


include_once 'config.php';
include_once "drc.php";

include_once 'randno.php';
session_start();

$response = array(); // Initialize response array

// Set header for JSON response
header( 'Content-Type: application/json' );

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

	if (empty($_POST['delivery']) || empty($_POST['return']) || empty($_POST['contact_phone']) || empty($_POST['contact_email']) || empty($_POST['store_address']) || empty($_POST['store_state']) || empty($_POST['store_country'])) {
        $response = [
            'status' => 'error',
            'message' => 'Please fill all the required inputs with your details' 
        ];
        echo json_encode($response);
        exit;
    }

	// Retrieve and sanitize POST data
	$delivery = htmlspecialchars( $_POST['delivery'] ); // Sanitize input
	$return = htmlspecialchars( $_POST['return'] ); // Sanitize input

	$contact_phone = htmlspecialchars( $_POST['contact_phone'] );
	$contact_email = htmlspecialchars( $_POST['contact_email'] );

	$store_address = htmlspecialchars( $_POST['store_address'] );
	$store_state = htmlspecialchars( $_POST['store_state'] );
	$store_country = htmlspecialchars( $_POST['store_country'] );
	
	
	if ( strlen( $delivery ) > 1000 ) {
		// Handle the error
		$response = [ 'status' => 'error', 'message' => 'Delivery Info cannot exceed 1000 characters.' ];
		echo json_encode($response);
		exit;
	}
	if ( strlen( $return ) > 1000 ) {
		// Handle the error
		$response = [ 'status' => 'error', 'message' => 'Return Info cannot exceed 1000 characters.' ];
		echo json_encode($response);
		exit;
	}
	
	
	if ($newstoremessage == '' ) {
		$newstoremessage = 'I would like to make enquires about your business.';
	}elseif ( strlen( $newstoremessage ) > 100 ) {
		// Handle the error
		$response = [ 'status' => 'error', 'message' => 'Enquiry Message is to long! Keep it under 100 characters' ];
		echo json_encode($response);
		exit;
	}
	
	// Prepare the SQL statement with placeholders
	$updatelink = "UPDATE olnee_storedata SET deliveryPolicy=?, returnPolicy=?, contact_phone = ?, contact_email = ?, store_address = ?, store_state = ?, store_country = ?";
	$stmt = mysqli_stmt_init( $conn );
	// Create a prepared statement
	if ( mysqli_stmt_prepare( $stmt, $updatelink ) ) {
		// Bind the parameters to the prepared statement
		mysqli_stmt_bind_param( $stmt, "sssssss", $delivery, $return, $contact_phone, $contact_email, $store_address, $store_state, $store_country );
		if ( mysqli_stmt_execute( $stmt ) ) {
			if ( mysqli_stmt_affected_rows( $stmt ) > 0 ) {
				// $stmt->close();// Close the statement
				// Success response
				$response['status'] = 'success';
				$response['message'] = 'Store details updated successfully.';
				$response['brandName'] = $brand_name;
				$response['brandInfo'] = $brand_info;
				$response['brandCategory'] = $brand_category;
				$response['storeMsg'] = urldecode( $newstoremessage );
				$response['countryCode'] = $bizcountrycode;
				$response['phoneNumber'] = $bizphonenumber;
				$response['address'] = $address;
				$response['country'] = $country;
			} else {
				// Error response
				$response['status'] = 'info';
				$response['message'] = 'Failed to update store details.';
			}
		} else {
			// Error response
			$response['status'] = 'error';
			$response['message'] = 'Failed to execute store update.';
		}
		
		
	} else {
		// Error response if preparation failed
		$response['status'] = 'error';
		$response['message'] = 'Failed to prepare SQL statement.';
	}
	
	// Close the connection
	$conn->close();
} else {
	// Response for invalid request method
	$response['status'] = 'error';
	$response['message'] = 'Invalid request method.';
}

// Output the response in JSON format
echo json_encode( $response );