<?php
include_once 'config.php';

// Get the store identifier (e.g., product or page reference)
// $backhalf = $_GET['ref'] ?? null;
$backhalf = $ref;

if ($backhalf) {
    // Insert visit into the database
    $sql = "INSERT INTO olnee_storevisits (backhalf, clicks, scans) VALUES (?, 1, 0)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $backhalf);
        mysqli_stmt_execute($stmt);
        // mysqli_stmt_close($stmt);
    }
}