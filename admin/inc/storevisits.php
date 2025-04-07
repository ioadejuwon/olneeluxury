<?php
include_once 'config.php';
include_once "drc.php";

$backhalf = $_GET['ref'];

$sql = "INSERT INTO olnee_storevisits (backhalf, clicks, scans) VALUES (?, 1, 0)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $backhalf);

mysqli_stmt_execute($stmt);
