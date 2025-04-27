<?php
include_once 'config.php';

$response = array(); // Initialize response array

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["couponCode"])) {
    $code = trim($_POST["couponCode"]);

    $stmt = $conn->prepare("SELECT couponName, coupon_id, couponType, couponValue, couponExpiry, couponQuantity FROM olnee_coupons WHERE couponCode = ?");
    $stmt->bind_param("s", $code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Check if coupon is expired
        $currentDate = new DateTime();
        $expiryDate = new DateTime($row["couponExpiry"]);
        if ($currentDate > $expiryDate) {
            $response = [
                "status" => 'error',
                "message" => "Coupon code has expired."
            ];
        } elseif ($row["couponQuantity"] < 1) { // Check if the coupon quantity is less than 1
            $response = [
                "status" => 'error',
                "message" => "Coupon quantity is insufficient."
            ];
        } else {
            if($row['couponType'] === 1){
                $message = 'Discount Apllied. You have '. $row["couponValue"].'% off.';
            }elseif($row['couponType'] === 2){
                $message = 'Discount Apllied. You have ₦'. $row["couponValue"].' off.';
            }
            $response = [
                "status" => 'success',
                // "message" => "Discount Applied. You have ". $row["couponValue"]."% off.",
                "message" => $message,
                "discount" => [
                    "couponName" => $row["couponName"],
                    "couponType" => $row["couponType"],
                    "couponValue" => (float) $row["couponValue"],
                    "couponID" => $row["coupon_id"]
                ]
            ];
        }
    } else {
        $response = [
            "status" => 'error',
            "message" => "Coupon code is invalid."
        ];
    }
    // $stmt->close();
    // $conn->close();
} else {
    $response = [
        "status" => 'error',
        "message" => "Invalid request method or missing couponCode."
    ];
}
echo json_encode($response);
exit;
