<?php


include_once 'config.php';
include_once "drc.php";

include_once 'randno.php';

session_start();


$error = null;
$response = array();

$url = $_GET['url'];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pword = mysqli_real_escape_string($conn, $_POST['pword']);
    if (! empty($email) && ! empty($pword)) {


        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = "SELECT email, fname, pwordhash, user_id FROM olnee_users WHERE email = ?";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $email); // Bind the parameter to the placeholder
                mysqli_stmt_execute($stmt); // Execute the query
                mysqli_stmt_bind_result($stmt, $resultEmail, $fname, $resultPasswordHash, $user_id); // Bind the result variable
                mysqli_stmt_fetch($stmt); // Fetch the result

                // Close the statement after fetching the result
                mysqli_stmt_close($stmt);

                if ($resultEmail && password_verify($pword, $resultPasswordHash)) {
                    // Set session variables
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['last_activity'] = time();  // Set the time of the last activity

                    // Send success response
                    $response['status'] = 'success';
                    $response['message'] = 'User login';
                    $response['redirect_url'] = ACCOUNT;
                } else {
                    // Incorrect email or password
                    $response['status'] = 'error';
                    $response['message'] = 'Looks like you entered the wrong email address or password!';
                }
            } else {
                $response = ['status' => 'error', 'message' => 'Statement preparation failed: ' . mysqli_error($conn)];
            }
        } else {
            $response = ['status' => 'error', 'message' => 'Invalid email address!'];
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Please enter your details.';
    }
    // Output the response in JSON format
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    // Initialize the response array
    $response = ['status' => 'error', 'message' => ''];
    // Trim and sanitize inputs
    $email = trim($_POST['email']);
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $pword = trim($_POST['pword']);
    $cword = trim($_POST['cword']);
    $fullname = $fname . ' ' . $lname;
    // Check if any field is empty
    if (empty($fname) || empty($lname) || empty($email) || empty($pword) || empty($cword)) {
        $response['message'] = 'Please fill all the fields.';
    } elseif (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Validate the email format
        $response['message'] = 'Invalid Email address.';
    } elseif ($pword !== $cword) {
        // Check if passwords match
        $response['message'] = 'Passwords do not match.';
    } else {
        // Check if email already exists
        $sql = "SELECT email FROM olnee_users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt); // Store the result
        if (mysqli_stmt_num_rows($stmt) > 0) {
            // If email exists
            $response['message'] = 'Email already exists. Please login instead.';
        } else {
            mysqli_stmt_close($stmt);
            // Create unique ref_id and hash the password
            $pwordhash = password_hash($pword, PASSWORD_BCRYPT);

            $insertFormDataQuery = "INSERT INTO olnee_users (user_id, fname, lname, email, verify, pwordhash) VALUES (?, ?, ?, ?, 0, ?)";
            $stmt = mysqli_prepare($conn, $insertFormDataQuery);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssss", $user_id, $fname, $lname, $email, $pwordhash);

                if (mysqli_stmt_execute($stmt)) {
                    // $response['success'] = true;
                    // $response['message'] = 'User Registered ' . ACCOUNT;
                    // $response['redirect_url'] = ACCOUNT; // Add redirect URL to response

                    $response['status'] = 'success';  // Add this line
                    $response['message'] = 'User Registered';
                    $response['redirect_url'] = LOGIN;
                } else {
                    $response = ['success' => false, 'message' => 'Database error: ' . mysqli_stmt_error($stmt)];
                }

                mysqli_stmt_close($stmt); // Close statement in both cases
            } else {
                $response = ['success' => false, 'message' => 'Statement preparation failed: ' . mysqli_error($conn)];
            }

            echo json_encode($response);
            exit;
        }
    }
    // Output the response in JSON format
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_account'])) {
    // Initialize the response array
    $response = ['status' => 'error', 'message' => ''];
    // Trim and sanitize inputs
    $user_id = trim($_POST['user_id']);
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);

    // $fullname = $fname . ' ' . $lname;
    // Check if any field is empty
    if (empty($fname) || empty($lname) || empty($email)) {
        $response['message'] = 'Please fill all the fieldds.';
    } elseif ($cpass != $newpword) {
        $response['message'] = 'New Password do not match';
    } elseif (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Validate the email format
        $response['message'] = 'Invalid Email address.';
    } else {
        // Prepare the SQL statement with placeholders
        $updateuser = "UPDATE olnee_users SET fname = ?, lname = ?, email = ? WHERE user_id=?";
        $stmt = mysqli_stmt_init($conn);
        // Create a prepared statement
        if (mysqli_stmt_prepare($stmt, $updateuser)) {
            $pwordhash = password_hash($pword, PASSWORD_BCRYPT);
            // Bind the parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "ssss", $fname, $lname, $email, $user_id);
            if (mysqli_stmt_execute($stmt)) {
                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    // $stmt->close();// Close the statement
                    // Success response
                    $response['status'] = 'success';
                    $response['message'] = 'User details updated successfully.';
                } else {
                    $response = ['success' => false, 'message' => 'Database error 2: ' . mysqli_stmt_error($stmt)];
                }
            } else {
                $response = ['success' => false, 'message' => 'Database error 1: ' . mysqli_stmt_error($stmt)];
            }
            mysqli_stmt_close($stmt); // Close statement in both cases
        } else {
            $response = ['success' => false, 'message' => 'Failed to prepare statement: ' . mysqli_stmt_error($stmt)];
        }
        echo json_encode($response);
        exit;
    }
    // Output the response in JSON format
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_password'])) {
    // Initialize the response array
    $response = ['status' => 'error', 'message' => ''];
    // Trim and sanitize inputs
    $user_id = trim($_POST['user_id']);
    $pword = trim($_POST['pword']);
    $newpword = trim($_POST['newpword']);
    $cpass = trim($_POST['cpass']);
    // $fullname = $fname . ' ' . $lname;
    // Check if any field is empty
    if (empty($pword) || empty($cpass) || empty($newpword)) {
        $response['message'] = 'Please fill all the fieldd2s.';
    } elseif ($cpass != $newpword) {
        $response['message'] = 'New Password do not match';
    } else {
        $sql = "SELECT * FROM olnee_users WHERE user_id = ?";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $user_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                if ($newpass == $confirmpass) {
                    $enc_pass = $row['pwordhash'];
                    // $2y$10$TP3kRfWlDs25pZxpFLr.1eQN/j2u9ipMBBD2mzwM0EwW33VksMI7W
                    if (password_verify($pword, $enc_pass)) {
                        $newpasshash = password_hash($newpword, PASSWORD_BCRYPT);
                        // Prepare the SQL statement with placeholders
                        $updateuser = "UPDATE olnee_users SET pwordhash = ? WHERE user_id=?";
                        $stmt = mysqli_stmt_init($conn);
                        // Create a prepared statement
                        if (mysqli_stmt_prepare($stmt, $updateuser)) {
                            $pwordhash = password_hash($pword, PASSWORD_BCRYPT);
                            // Bind the parameters to the prepared statement
                            mysqli_stmt_bind_param($stmt, "ss", $newpasshash, $user_id);
                            if (mysqli_stmt_execute($stmt)) {
                                if (mysqli_stmt_affected_rows($stmt) > 0) {
                                    // $stmt->close();// Close the statement
                                    // Success response
                                    $response['status'] = 'success';
                                    $response['message'] = 'User details updated successfully.';
                                    // $response['brandName'] = $brand_name;
                                    // $response['brandInfo'] = $brand_info;
                                    // $response['brandCategory'] = $brand_category;
                                    // $response['storeMsg'] = urldecode($newstoremessage);
                                    // $response['countryCode'] = $bizcountrycode;
                                    // $response['phoneNumber'] = $bizphonenumber;
                                    // $response['address'] = $address;
                                    // $response['country'] = $country;
                                } else {
                                    $response = ['success' => false, 'message' => 'Database error 2: ' . mysqli_stmt_error($stmt)];
                                }
                            } else {
                                $response = ['success' => false, 'message' => 'Database error 1: ' . mysqli_stmt_error($stmt)];
                            }
                            mysqli_stmt_close($stmt); // Close statement in both cases
                        } else {
                            $response = ['success' => false, 'message' => 'Failed to prepare statement: ' . mysqli_stmt_error($stmt)];
                        }
                    } else {
                        $response['status'] = 'error';
                        $response['message'] = 'Your old password is incorrect!';
                    }
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'New password and confirm password do not match!';
                }
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Failed to prepare select statement.';
        }





        echo json_encode($response);
        exit;
    }
    // Output the response in JSON format
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
