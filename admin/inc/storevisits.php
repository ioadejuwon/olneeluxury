<?php
// ini_set('session.gc_maxlifetime', 72); // 2 hours
// session_set_cookie_params(72);
session_start();

include_once 'config.php';
include_once "drc.php";

// $backhalf = $_GET['ref'];

// $sql = "INSERT INTO olnee_storevisits (backhalf, clicks, scans) VALUES (?, 1, 0)";
// $stmt = mysqli_prepare($conn, $sql);
// mysqli_stmt_bind_param($stmt, "s", $backhalf);

// mysqli_stmt_execute($stmt);

// Get the store identifier (e.g., product or page reference)
$backhalf = $_GET['ref'] ?? null;

// if ($backhalf && !isset($_SESSION['visited_' . $backhalf])) {
    // Insert visit into the database
    $sql = "INSERT INTO olnee_storevisits (backhalf, clicks, scans) VALUES (?, 1, 0)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $backhalf);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    // Mark this store as visited in the current session
    $_SESSION['visited_' . $backhalf] = true;
// }