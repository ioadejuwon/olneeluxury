<?php
// track.php

$mail_id = $_GET['mail_id']; // Assuming 'id' is the parameter passed in the URL
$choice = $_GET['c'];

// Update your database based on the $unique_id
// Use prepared statements for security

$dbhost = 'localhost';
$dbuser = 'u421730478_martvilleadmin';
$dbpass = 'rD4T|gl*0O';
$dbname = 'u421730478_martvilleapp';
$conn = mysqli_connect($dbhost,$dbuser,$dbpass, $dbname);

// $conn = mysqli_connect('localhost', 'u421730478_theccohort', '0&YTj/n2P', 'u421730478_creativeschort');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if($choice == 'l'){
    // $stmt = $conn->prepare("UPDATE emailTrack SET opened = 1, opened_at = CURRENT_TIMESTAMP WHERE unique_id = ?");
    $stmt = $conn->prepare("UPDATE emails SET linkclicked = 1, last_clicked = CURRENT_TIMESTAMP  WHERE mail_id = ?");
    $stmt->bind_param("s", $mail_id);

    if ($stmt->execute()) {
        header('Location: https://web.martville.app/inventory/categories');
        exit; // Stop further execution
    } else {
        echo "Error updating database: " . $stmt->error;
    }

    $stmt->close();
}elseif($choice == 'i'){
    // $stmt = $conn->prepare("UPDATE emailTrack SET opened = 1, opened_at = CURRENT_TIMESTAMP WHERE unique_id = ?");
    $stmt = $conn->prepare("UPDATE emails SET opened = 1, last_opened = CURRENT_TIMESTAMP  WHERE mail_id = ?");
    $stmt->bind_param("s", $mail_id);

    if ($stmt->execute()) {
        // You may send a transparent image as the response to make it a tracking pixel
        header('Content-Type: image/png');
        readfile('https://web.martville.app/email/img/logomail.png'); // Provide the path to a transparent image file
    } else {
        echo "Error updating database: " . $stmt->error;
    }

    $stmt->close();
}else {
    // Handle invalid or unexpected choice
    echo "Invalid choice: $choice";
}

$conn->close();
?>
