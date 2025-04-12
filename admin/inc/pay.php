<?php
include_once 'config.php';
include_once 'randno.php';
include_once 'drc.php';
include_once 'env.php';

header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

$response = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $order_id = $orderID;
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
        $location = "$street, $city, $state, $country";

        $items = json_decode($_POST['items'], true);
        if (!is_array($items) || empty($items)) {
            throw new Exception("Please add items to your cart!");
        }

        $conn->begin_transaction();

        // Insert order
        $stmt = $conn->prepare("INSERT INTO olnee_orders (order_id, first_name, last_name, email, phone, country, state, city, street, notes, subtotal, discount, shipping, total, paymentOption, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1)");
        if (!$stmt) throw new Exception("Order insert preparation failed: " . $conn->error);

        $stmt->bind_param("ssssssssssddddi", $order_id, $firstName, $lastName, $email, $phone, $country, $state, $city, $street, $notes, $subtotal, $discount, $shipping, $total, $paymentOption);
        $stmt->execute();
        if ($stmt->error) throw new Exception("Order insert failed: " . $stmt->error);
        $stmt->close();

        $itemCount = 0;
        $sendMessage = '';
        $sendMail = '';

        foreach ($items as $item) {
            if (!isset($item['product_id'], $item['name'], $item['yards'], $item['price'])) {
                throw new Exception("Invalid item data.");
            }

            $product_id = $item['product_id'];
            $product_name = $item['name'];
            $product_price = (int)$item['price'];
            $product_yards = (int)$item['yards'];
            $totalProductPrice = $product_price * $product_yards;


            // Get current stock
            $stmt = $conn->prepare("SELECT yards FROM products WHERE productid = ?");
            $stmt->bind_param("s", $product_id);
            $stmt->execute();
            $stmt->bind_result($current_yards);
            if (!$stmt->fetch()) {
                throw new Exception("Product not found.");
            }
            $stmt->close();

            // Check if there's enough stock
            if ($current_yards < $product_yards) {
                throw new Exception("Only {$current_yards} yards left in stock for '{$product_name}'. Please reduce the quantity.", 1001);
            }


            // Update product stock
            $stmtSubtract = $conn->prepare("UPDATE products SET yards = yards - ? WHERE productid = ?");
            $stmtSubtract->bind_param("is", $product_yards, $product_id);
            $stmtSubtract->execute();
            $stmtSubtract->close();

            $itemCount++;
            $price = ($product_yards > 1) ? $totalProductPrice : $product_price;
            $statement = ($product_yards > 1) ? 'yards' : 'yard';

            $itemMessage = '📦 ' . $product_name . ' - (' . $product_yards . $statement . ') - ₦' . number_format($product_price, 2);
            $sendMessage .= $itemMessage . "\r\n";
            $sendMail .= $itemMessage . "<br>";

            $stmt = $conn->prepare("INSERT INTO olnee_order_items (order_id, product_id, product_name, yards, price) VALUES (?, ?, ?, ?, ?)");
            if (!$stmt) throw new Exception("Item insert preparation failed: " . $conn->error);

            $stmt->bind_param("sssid", $order_id, $product_id, $product_name, $product_yards, $product_price);
            $stmt->execute();
            if ($stmt->error) throw new Exception("Item insert failed: " . $stmt->error);
            $stmt->close();
        }

        $conn->commit();

        // PAYMENT OPTIONS
        if ($paymentOption === 1) {
            // Flutterwave
            $request = [
                "tx_ref" => $order_id,
                "amount" => $total,
                "currency" => "NGN",
                "redirect_url" => CONFIRM_PAY,
                "payment_options" => "card, banktransfer, ussd",
                "meta" => [
                    "order_id" => $order_id,
                    "price" => $total,
                    "name" => $fullName
                ],
                "customer" => [
                    "email" => $email,
                    "phone_number" => $phone,
                    "name" => $fullName,
                ],
                "customizations" => [
                    "title" => "Olnee Luxury",
                    "description" => "Payment for items in cart",
                    "logo" => ADMIN_URL . "assets/img/icon.png",
                ],
            ];

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($request),
                CURLOPT_HTTPHEADER => [
                    'Authorization: Bearer ' . SECRET_KEY,
                    'Content-Type: application/json'
                ],
            ]);

            $flutterwave_response = curl_exec($curl);
            if (curl_errno($curl)) throw new Exception("Curl error: " . curl_error($curl));
            curl_close($curl);

            $res = json_decode($flutterwave_response);
            if ($res->status === 'success') {
                echo json_encode([
                    'status' => 'success',
                    'link' => $res->data->link
                ]);
                exit;
            } else {
                throw new Exception("Payment failed: " . $res->message);
            }
        } elseif (in_array($paymentOption, [2, 3])) {
            // Direct Transfer or Cash on Delivery
            echo json_encode([
                'status' => 'success',
                'message' => 'Proceed with your selected payment option',
                'link' => ORDER . $order_id
            ]);
            exit;
        } elseif ($paymentOption === 4) {
            // WhatsApp Order
            $plural_mainMSG = ($itemCount > 1) ? "these items:" : "this item:";
            $mainMSG = "Hi, Olnee Luxury!\r\n\r\nI would like to buy $plural_mainMSG\r\n\r\n";
            $mainMSG .= $sendMessage . "\r\n";
            $mainMSG .= "💰Discount: *-₦" . number_format($discount, 2) . "*\r\n";
            $mainMSG .= "💰Total Price: *₦" . number_format($total, 2) . "*\r\n\r\n";
            $mainMSG .= "*DELIVERY DETAILS:*\r\nName: $fullName\r\nPhone: $phone\r\nAddress: $location\r\nNote: $notes\r\n";
            $mainMSG .= "---\r\nView my order: " . ORDER . $order_id;

            echo json_encode([
                'status' => 'success',
                'message' => 'Redirecting to WhatsApp...',
                'link' => 'https://api.whatsapp.com/send?phone=' . PHONE . '&text=' . rawurlencode($mainMSG)
            ]);
            exit;
        } else {
            throw new Exception("Invalid payment option selected.");
        }
    } catch (Exception $e) {
        $conn->rollback();
        $status = $e->getCode() === 1001 ? 'info' : 'error';

        http_response_code(400);
        echo json_encode([
            'status' => $status,
            'message' => $e->getMessage()
        ]);
        // echo json_encode([
        //     'status' => 'error',
        //     'message' => $e->getMessage()
        // ]);
        exit;
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method.'
    ]);
    exit;
}


// $conn->close();
