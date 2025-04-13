<?php
include_once 'config.php';
include_once 'randno.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['categoryname'])) {
    $category_name = mysqli_real_escape_string($conn, $_POST['categoryname']); // Get the category name from the form
    $category_id = generateCategoryID(); // Use the generate function from randno.php

    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT COUNT(*) FROM olnee_categories WHERE categoryName = ?");
    $stmt->bind_param("s", $category_name);
    $stmt->execute();
    $stmt->bind_result($count_row);
    $stmt->fetch();
    $stmt->close();

    if ($count_row > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Category already exists!']);
        exit;
    }
    // $sql = "INSERT INTO olnee_categories (categoryid, categoryName) VALUES ('$category_id', '$category_name')";
    $stmt = $conn->prepare("INSERT INTO olnee_categories (categoryid, categoryName) VALUES (?, ?)");
    $stmt->bind_param("ss", $category_id, $category_name);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Category created successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
        exit;
    }
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request!']);
    exit;
}
