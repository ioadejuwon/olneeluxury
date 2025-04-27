<?php
include_once 'config.php';
include_once "randno.php";
include_once "drc.php";


$response = array(); // Initialize response array

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['couponname']) || empty($_POST['couponcode']) || empty($_POST['value']) || empty($_POST['couponType']) || empty($_POST['user_id'])) {
        $response['status'] = 'error';
        $response['message'] = 'Please fill in the required field';
        echo json_encode($response);
        exit;
    } else {
        // Capture and sanitize input
        $user_id = $_POST['user_id'];
        $couponname = $_POST['couponname'];
        $couponcode = $_POST['couponcode'];
        $coupontype = $_POST['couponType'];
        $couponvalue = (int)$_POST['value'];
        $couponexpiry = $_POST['expiry_date'];
        $couponquantity = (int)$_POST['quantity'];
        // $date = date("Y-m-d H:i:s");
        // $date = modify('-1 hour'); // Adjust for server being 1 hour behind
        // $date = strtotime($date);
        $datetime = new DateTime();
        $datetime->modify('+1 hour');
        $date = $datetime->format('Y-m-d H:i:s');
        $date = timeAgo($date);


        $coupondatetime = new DateTime($couponexpiry);
        $coupondatetime->modify('+1 hour');
        $couponDate = $coupondatetime->format('Y-m-d H:i:s');
        $couponDate = timeAgo($couponDate);


        $couponid = generateCouponID(); // Generate a unique ID

        // Check if the category already exists using a prepared statement
        $stmt = $conn->prepare("SELECT COUNT(*) FROM olnee_coupons WHERE couponCode = ?");
        $stmt->bind_param("s", $couponcode);
        $stmt->execute();
        $stmt->bind_result($count_row);
        $stmt->fetch();
        $stmt->close();

        if ($count_row > 0) {
            $response['status'] = 'error';
            $response['message'] = 'Coupon Code already exists!';
            echo json_encode($response);
            exit;
        } elseif (preg_match('/[^a-zA-Z0-9-]/ ', $couponcode)) {
            $response['status'] = 'error';
            $response['message'] = 'Coupon Code - One or more characters is not allowed!';
            echo json_encode($response);
            exit;
        } elseif (preg_match('/[^a-zA-Z0-9 -%]/ ', $couponname)) {
            $response['status'] = 'error';
            $response['message'] = 'Coupon Name - One or more characters is not allowed!';
            echo json_encode($response);
            exit;
        } else {
            // Insert the new category using a prepared statement
            $stmt = $conn->prepare("INSERT INTO olnee_coupons (user_id, coupon_id, couponName, couponCode, couponType, couponValue, couponExpiry, couponQuantity) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssiiss", $user_id, $couponid, $couponname, $couponcode, $coupontype, $couponvalue, $couponexpiry, $couponquantity);

            if ($stmt->execute()) {
                $response['status'] = 'success';
                $response['message'] = 'Coupon code added successfully!';
                $response['couponname'] = $couponname;
                $response['couponcode'] = $couponcode;

                $response['couponquantity'] = $couponquantity;
                $response['couponexpiry'] = $couponDate;
                $response['coupondate'] = $date;
                if ($coupontype == 1) {
                    $response['coupontype'] = 'Percentage Off';
                    $response['couponvalue'] = $couponvalue . '% off';
                } elseif ($coupontype == 2) {
                    $response['coupontype'] = 'Fixed Amount';
                    $response['couponvalue'] = NAIRA . number_format($couponvalue, 2);
                }
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Failed to add coupon code. Please try again.';
                echo json_encode($response);
                exit;
            }
            $stmt->close();
        }
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
    echo json_encode($response);
    exit;
}

// Close the database connection
$conn->close();

// Return the response as JSON
echo json_encode($response);
