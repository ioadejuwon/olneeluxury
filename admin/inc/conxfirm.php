<?php
include_once 'config.php';
include_once "drc.php";
session_start();
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Get payment status passed to URL
if (isset($_GET['status'])) {
    $order_id = $_GET['tx_ref'];
    // echo "Order ID: " . $order_id . "<br>";

    // Redirect to homepage if transaction is cancelled
    if ($_GET['status'] === 'cancelled') {
        $status = $_GET['status'];
        $update_order_status_failed = "UPDATE olnee_orders SET status = 0 WHERE order_id = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $update_order_status_failed);
        mysqli_stmt_bind_param($stmt, "s", $order_id);

        if (mysqli_stmt_execute($stmt)) {
            header('Location: ' . ORDER . $order_id);
            exit;
        } else {
            echo "Failed to update order status to 'Failed'.";
        }
    } elseif ($_GET['status'] === 'successful') {
        // Store transaction ID in a variable
        $txid = $_GET['transaction_id'];
        // echo "Transaction ID: " . $txid . "<br>";

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/{$txid}/verify",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                'Authorization: Bearer ' . SECRET_KEY, // Replace with your Flutterwave secret key
            ),
        ));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl);
        }
        curl_close($curl);

        $res = json_decode($response);

        // Confirm status is 'success'
        if ($res->status === 'success') {
            // echo "Verification status: success<br>";

            $amountPaid = $res->data->amount;
            $amountToPay = $res->data->meta->amountToPay; // Assuming amountToPay is stored in the metadata

            // Store transaction amount and amount charged to array for further validation
            // Checking amount paid is actually higher or equal to amount paid
            if ($amountPaid >= $amountToPay) {
                $email = $res->data->customer->email;
                $fname = $res->data->meta->firstname;
                $fullname = $res->data->meta->name;

                // echo "Email: " . $email . "<br>";
                // echo "First Name: " . $fname . "<br>";
                // echo "Full Name: " . $fullname . "<br>";

                $update_payment_status = "UPDATE olnee_orders SET status = 2 WHERE order_id = ?";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt, $update_payment_status);
                mysqli_stmt_bind_param($stmt, "s", $order_id);

                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_close($stmt); // Close the statement before opening another one
                    header('Location: ' . ORDER . $order_id);
                    exit;
                } else {
                    echo "Failed to update order status to 'Successful'.";
                }
            } else {
                echo "Fraudulent transaction";
            }
        } else {
            echo "Could not process payment. Flutterwave response: " . $response;
        }
    }
} else {
    header('Location: ' . CHECKOUT);
    exit;
}