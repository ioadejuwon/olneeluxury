<?php
include_once 'config.php'; // Include your database configuration
include_once 'randno.php';
include_once 'drc.php';
include_once 'env.php';

header('Content-Type: application/json'); // Ensure the content type is JSON

// $response = []; // Initialize response array
$response = array();

// Enable error reporting for debugging

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $order_id = $orderID;
        // Retrieve the posted data
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $fullName = $firstName . ' ' . $lastName;
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $delivery = $_POST['deliverycost'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $street = $_POST['street'];
        $notes = $_POST['notes'];
        $subtotal = $_POST['subtotal'];
        $discount = $_POST['discount'];
        $shipping = $_POST['shipping'];
        $total = $_POST['checkout-total'];
        $paymentOption = (int) $_POST['paymentOption'];
        $location = $street . ", " . $city . ", " . $state . ", " . $country;

        // Decode the items JSON and add debugging
        $items_json = $_POST['items'];
        // error_log("Raw items data: " . $items_json);
        $items = json_decode($items_json, true);
        // error_log("Decoded items array: " . print_r($items, true));

        // Check if items is an array
        if (!is_array($items) || empty($items)) {
            // throw new Exception("Invalid or empty items data.");
            // $response = ['status' => 'success', 'message' => 'Invalid or empty items data.'];
            $response = [
                'status' => 'info',
                'message' => 'Please add items to your cart!'
            ];
            echo json_encode($response);
            exit;
        }

        // Start a transaction
        $conn->begin_transaction();


        // Insert order details
        $insert_order = "INSERT INTO olnee_orders (order_id, first_name, last_name, email, phone, country, state, city, street, notes, subtotal, discount, shipping, total, paymentOption, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')";
        $stmt = $conn->prepare($insert_order);
        if (!$stmt) {
            // throw new Exception("Order preparation failed: " . $conn->error);
            $response = [
                'status' => 'error',
                'message' => 'Order preparation failed: ' . $conn->error
            ];
            echo json_encode($response);
            exit;
        }
        $stmt->bind_param("ssssssssssddddi", $order_id, $firstName, $lastName, $email, $phone, $country, $state, $city, $street, $notes, $subtotal, $discount, $shipping, $total, $paymentOption);
        $stmt->execute();
        if ($stmt->error) {
            // throw new Exception("Order execution failed: " . $stmt->error);
            $response = [
                'status' => 'error',
                'message' => 'Order execution failed: ' . $stmt->error
            ];
            echo json_encode($response);
            exit;
        }
        $stmt->close();

        $itemCount = 0;
        $sendMessage = ''; // Initialize the $sendMessage variable
        // Insert order items
        foreach ($items as $item) {
            if (!isset($item['product_id']) || !isset($item['name']) || !isset($item['quantity']) || !isset($item['price'])) {
                // throw new Exception("Invalid item data: " . print_r($item, true));
                $response = [
                    'status' => 'error',
                    'message' => 'Invalid item data: ' . print_r($item, true)
                ];
                echo json_encode($response);
                exit;
            }

            $product_id = $item['product_id'];
            $product_name = $item['name'];
            $product_price = (int) $item['price'];
            $product_quantity = (int) $item['quantity'];
            $totalProductPrice = $product_price * $product_quantity;

            $itemCount++;
            $price = ($product_quantity > 1) ? $totalProductPrice : $product_price;

            $itemMessage = '📦 ' . $product_name . ' - (' . $product_quantity . 'x) - ₦' . number_format($product_price, 2);
            $sendMessage .= $itemMessage . "\r\n";


            $insert_item = "INSERT INTO olnee_order_items (order_id, product_id, product_name, quantity, price) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_item);
            if (!$stmt) {
                // throw new Exception("Item preparation failed: " . $conn->error);
                $response = [
                    'status' => 'error',
                    'message' => 'Item preparation failed: ' . $conn->error
                ];
                echo json_encode($response);
                exit;
            }
            $stmt->bind_param("sssid", $order_id, $product_id, $product_name, $product_quantity, $product_price);
            $stmt->execute();
            if ($stmt->error) {
                // throw new Exception("Item execution failed: " . $stmt->error);
                $response = [
                    'status' => 'error',
                    'message' => 'Item execution failed: ' . $stmt->error
                ];
                echo json_encode($response);
                exit;
            }
            $stmt->close();
        }

        // If everything is successful, commit the transaction
        $conn->commit();

        if ($paymentOption == '1') {
            // Flutterwave

            // Prepare Flutterwave payment request

            $request = [
                "tx_ref" => $order_id, // Unique transaction reference
                "amount" => $total,
                "currency" => "NGN",
                // "redirect_url" => "http://localhost:8888/bob/inc/confirm_payment.php",
                "redirect_url" => CONFIRM_PAY,
                "payment_options" => "card, banktransfer, ussd",
                "meta" => [
                    "order_id" => $order_id,
                    "consumer_mac" => "92a3-912ba-1192a",
                    "price" => $total,
                    "name" => $firstName . ' ' . $lastName,
                    "firstname" => $firstName
                ],
                "customer" => [
                    "email" => $email,
                    "phone_number" => $phone,
                    "name" => $firstName . ' ' . $lastName,
                ],
                "customizations" => [
                    "title" => "Olnee Luxury",
                    "description" => "Payment for items in cart",
                    "logo" => ADMIN_URL . "assets/img/icon.png",
                ],
            ];

            // Send payment to Flutterwave for processing
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($request),
                CURLOPT_HTTPHEADER => [
                    'Authorization: Bearer ' . SECRET_KEY, // Replace with your Flutterwave secret key
                    'Content-Type: application/json'
                ],
            ]);

            $response = curl_exec($curl);
            if (curl_errno($curl)) {
                // throw new Exception('Curl error: ' . curl_error($curl));
                $response = [
                    'status' => 'error',
                    'message' => 'Curl error: ' . curl_error($curl)
                ];
                echo json_encode($response);
                exit;
            }
            curl_close($curl);

            $res = json_decode($response);

            if ($res->status === 'success') {
                // Return payment link to the front-end
                echo json_encode([
                    'status' => 'success',
                    'link' => $res->data->link
                ]);
            } else {
                // throw new Exception("Payment initialization failed: " . $res->message);
                $response = [
                    'status' => 'error',
                    'message' => 'Payment failed: ' . $res->message . '<br> Please try again.'
                ];
                echo json_encode($response);
                exit;
            }
        } elseif ($paymentOption == '2') {
            // Direct Transfer
            $response = [
                'status' => 'success',
                'message' => 'Direct Transfer Payment Option',
                'link' => ORDER . $order_id
            ];
            echo json_encode($response);
            // exit;

        } elseif ($paymentOption == '3') {
            // Cash on Delivery
            $response = [
                'status' => 'success',
                'message' => 'Direct Transfer Payment Option',
                'link' => ORDER . $order_id
            ];
            echo json_encode($response);
            // exit;
        } elseif ($paymentOption == '4') {

            $plural_mainMSG = ($itemCount > 1) ? "these items:" : "this item:";
            $mainMSG = 'Hi, Olnee Luxury' . "!\r\n\r\n";
            $mainMSG .= 'I would like to buy ' . $plural_mainMSG . "\r\n\r\n";

            $mainMSG .= $sendMessage . "\r\n\r\n";
            $mainMSG .= "💰Discount: *-₦" . number_format($discount, 2) . "*\r\n";
            $mainMSG .= "💰Total Price: *₦" . number_format($total, 2) . "*\r\n\r\n";
            $mainMSG .= '👤 Customer\'s Name: ' . $fullName . "\r\n\r\n";
            $mainMSG .= '*DELIVERY DETAILS:* ' . "\r\n";
            $mainMSG .= 'Name: ' . $fullName . "\r\n";
            $mainMSG .= 'Phone: ' . $phone . "\r\n";
            $mainMSG .= 'Address: ' . $location . "\r\n";
            $mainMSG .= 'Customer\'s Extra Note: ' . $notes . "\r\n";
            $mainMSG .= 'Thank you!' . "\r\n";

            $mainMSG .= "---\r\n\r\nYou can view my order details here: " . ORDER . $order_id;

            // WhatsApp
            $response = [
                'status' => 'success',
                'message' => 'WhatsApp Payment Option',
                // 'link' => WHATSAPP_ORDER . $order_id
                'link' => 'https://api.whatsapp.com/send?phone=' . WHATSAPP_NUMBER . '&text=' . rawurlencode($mainMSG)
            ];
            echo json_encode($response);
            // exit;
        } else {
            // WhatsApp
            $response = [
                'status' => 'info',
                'message' => 'There was an error with the selected payment option'
            ];
            echo json_encode($response);
            exit;
        }
    } catch (Exception $e) {
        // Rollback the transaction if there's an error
        $conn->rollback();
        error_log($e->getMessage());
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
    exit;
}

$conn->close();
