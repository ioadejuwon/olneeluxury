<?php


include_once 'config.php';
include_once "drc.php";

include_once 'randno.php';

session_start();


$error = null;
$response = array();



// if (isset($_POST['login'])) {
//     $email = mysqli_real_escape_string($conn, $_POST['email']);
//     $pword = mysqli_real_escape_string($conn, $_POST['pword']);
//     if (!empty($email) && !empty($pword)) {
//         if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
//             $sql = "SELECT email, fname, pword_hash, user_id FROM olnee_admin WHERE email = ?";
//             $stmt = mysqli_prepare($conn, $sql);
//             mysqli_stmt_bind_param($stmt, "s", $email); // Bind the parameter to the placeholder
//             mysqli_stmt_execute($stmt); // Execute the query
//             mysqli_stmt_bind_result($stmt, $resultEmail, $fname, $resultPasswordHash, $user_id); // Bind the result variable
//             mysqli_stmt_fetch($stmt); // Fetch the result
//             if ($resultEmail && password_verify($pword, $resultPasswordHash)) {
//                 $_SESSION['user_id'] = $user_id;
//                 //Send Login email to Vendor
//                 if (!empty($url)) {
//                     header("Location: $url");
//                 } else {
//                     header("Location: " . DASHBOARD);
//                 }
//             } else {
//                 // $error = "Looks like you entered the wrong email address or password!";
//                 $error = "<p class='fw-300 text-error-1'>Looks like you entered the wrong email address or password!</p>";
//             }
//         } else {
//             // $error = "Invalid Email address";
//             $error = "<p class='fw-300 text-error-1'>Invalid Email address.</p>";
//         }
//     } else {
//         // $error = "Please enter your details";
//         $error = "<p class='fw-300 text-error-1'>Please enter your details.</p>";
//     }
// } elseif (isset($_SESSION['user_id'])) {
//     if (!empty($url)) {
//         header("Location: $url");
//     } else {
//         header("Location: " . DASHBOARD);
//     }
// }


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pword = mysqli_real_escape_string($conn, $_POST['pword']);
    $url = mysqli_real_escape_string($conn, $_POST['url']);
    // $url = $_GET['url'];
    if (! empty($email) && ! empty($pword)) {


        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = "SELECT admin_email, fname, pword_hash, user_id FROM olnee_admin WHERE admin_email = ?";
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
                    // $response['redirect_url'] = DASHBOARD;
                    $response['redirect_url'] = ! empty($url) ? $url : DASHBOARD; // Add redirect URL to response
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
    // $admin_email = trim($_POST['admin_email']);
    $admin_phone = trim($_POST['admin_phone']);
    $admin_address = trim($_POST['admin_address']);
    $admin_state = trim($_POST['admin_state']);
    $admin_country = trim($_POST['admin_country']);

    // $fullname = $fname . ' ' . $lname;
    // Check if any field is empty
    if (empty($fname) || empty($lname)) {
        $response['message'] = 'Please fill all the fields.';
    }
    // elseif (! filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
    //     // Validate the email format
    //     $response['message'] = 'Invalid Email address.';
    // }
    else {
        // Prepare the SQL statement with placeholders
        $updateadmin = "UPDATE olnee_admin SET fname = ?, lname = ?, admin_phone = ?, admin_address = ?, admin_state = ?, admin_country = ? WHERE user_id = ?";
        $stmt = mysqli_stmt_init($conn);
        // Create a prepared statement
        if (mysqli_stmt_prepare($stmt, $updateadmin)) {
            // Bind the parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "sssssss", $fname, $lname, $admin_phone, $admin_address, $admin_state, $admin_country, $user_id);
            if (mysqli_stmt_execute($stmt)) {
                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    $address = $admin_address . ", " . $admin_state . ", " . $admin_country;
                    // $stmt->close();// Close the statement
                    // Success response
                    $response = [
                        'status' => 'success',
                        'message' => 'Admin details updated successfully.',
                        'admin_first_name' => $fname,
                        'admin_last_name' => $lname,
                        // 'admin_email' => $admin_email,
                        'admin_phone' => $admin_phone,
                        'admin_address' => $address,
                    ];
                } else {
                    $response = [
                        'status' => 'info',
                        'message' => 'Details not updated, Please make changes and try again.'
                    ];
                }
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Update not execeuted.'
                ];
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


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_update'])) {
    // Initialize the response array
    $response = ['status' => 'error', 'message' => ''];
    // Trim and sanitize inputs
    $admin_id = trim($_POST['admin_id']);
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $admin_email = trim($_POST['admin_email']);
    $admin_phone = trim($_POST['admin_phone']);
    $admin_level = $_POST['admin_level'];
    $admin_address = trim($_POST['admin_address']);
    $admin_state = trim($_POST['admin_state']);
    $admin_country = trim($_POST['admin_country']);

    // $fullname = $fname . ' ' . $lname;
    // Check if any field is empty
    if (empty($fname) || empty($lname)) {
        $response['message'] = 'Please fill all the fields.';
    }
    // elseif (! filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
    //     // Validate the email format
    //     $response['message'] = 'Invalid Email address.';
    // }
    else {
        // Prepare the SQL statement with placeholders
        $updateadmin = "UPDATE olnee_admin SET fname = ?, lname = ?, admin_phone = ?, admin_email = ?, admin_level = ?, admin_address = ?, admin_state = ?, admin_country = ? WHERE user_id = ?";
        $stmt = mysqli_stmt_init($conn);
        // Create a prepared statement
        if (mysqli_stmt_prepare($stmt, $updateadmin)) {
            // Bind the parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "sssssssss", $fname, $lname, $admin_phone, $admin_email, $admin_level, $admin_address, $admin_state, $admin_country, $admin_id);
            if (mysqli_stmt_execute($stmt)) {
                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    $address = $admin_address . ", " . $admin_state . ", " . $admin_country;
                    // $stmt->close();// Close the statement
                    // Success response
                    $response = [
                        'status' => 'success',
                        'message' => 'Admin details updated successfully.',
                        'admin_first_name' => $fname,
                        'admin_last_name' => $lname,
                        // 'admin_email' => $admin_email,
                        'admin_phone' => $admin_phone,
                        'admin_address' => $address,
                    ];
                } else {
                    $response = [
                        'status' => 'info',
                        'message' => 'Details not updated, Please make changes and try again.'
                    ];
                }
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Update not execeuted.'
                ];
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


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_new'])) {
    header('Content-Type: application/json');
    // Initialize the response array
    $response = ['status' => 'error', 'message' => ''];
    // Trim and sanitize inputs
    $admin_id = trim($_POST['admin_id']);
    $user_id = generateUserID();
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $username = trim($_POST['username']);
    $admin_email = trim($_POST['admin_email']);
    $admin_phone = trim($_POST['admin_phone']);
    $admin_level = $_POST['admin_level'];
    $admin_address = trim($_POST['admin_address']);
    $admin_state = trim($_POST['admin_state']);
    $admin_country = trim($_POST['admin_country']);
    $pwordhash = password_hash('Password', PASSWORD_BCRYPT);


    // $fullname = $fname . ' ' . $lname;
    // Check if any field is empty
    if (empty($fname) || empty($lname)) {
        $response['message'] = 'Please fill all the fields.';
        echo json_encode($response);
        exit;
    }

    if (! filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
        // Validate the email format
        $response['message'] = 'Invalid Email address.';
        echo json_encode($response);
        exit;
    }
   
    // Check if the category already exists using a prepared statement
    $stmt = $conn->prepare("SELECT COUNT(*) FROM olnee_admin WHERE admin_email = ? ");
    $stmt->bind_param("s", $admin_email);
    $stmt->execute();
    $stmt->bind_result($count_row);
    $stmt->fetch();
    $stmt->close();

    if ($count_row > 0) {
        $response['status'] = 'error';
        $response['message'] = 'Email Address already exists!';
        echo json_encode($response);
        exit;
    }


    // Prepare the SQL statement with placeholders
    $insertFormDataQuery = "INSERT INTO olnee_admin (fname, lname, admin_phone, username, admin_email, admin_level, admin_address, admin_state, admin_country,  added_by, pword_hash, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertFormDataQuery);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssissssss", $fname, $lname, $username, $admin_phone, $admin_email, $admin_level, $admin_address, $admin_state, $admin_country, $admin_id, $pwordhash, $user_id);

        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                $address = $admin_address . ", " . $admin_state . ", " . $admin_country;
                // $stmt->close();// Close the statement
                // Success response
                $response = [
                    'status' => 'success',
                    'message' => 'Admin details updated successfully.',
                    'admin_first_name' => $fname,
                    'admin_last_name' => $lname,
                    // 'admin_email' => $admin_email,
                    'admin_phone' => $admin_phone,
                    'admin_address' => $address,
                ];
            } else {
                $response = [
                    'status' => 'info',
                    'message' => 'Details not updated, Please make changes and try again.'
                ];
            }
        }
    }


    // Output the response in JSON format
    echo json_encode($response);
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_socials'])) {
    header('Content-Type: application/json');
    // Initialize the response array
    $response = ['status' => 'error', 'message' => ''];
    // Trim and sanitize inputs
    $twitter = trim($_POST['twitter']);
    $instagram = trim($_POST['instagram']);
    $facebook = trim($_POST['facebook']);


    // Prepare the SQL statement with placeholders
    $updateadmin = "UPDATE olnee_storedata SET twitter = ?, instagram = ?, facebook = ? WHERE id = 1";
    $stmt = mysqli_stmt_init($conn);
    // Create a prepared statement
    if (mysqli_stmt_prepare($stmt, $updateadmin)) {
        // Bind the parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "sss", $twitter, $instagram, $facebook);
        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                // $stmt->close();// Close the statement
                // Success response
                $response = [
                    'status' => 'success',
                    'message' => 'Social details updated successfully.',
                ];
            } else {
                $response = [
                    'status' => 'info',
                    'message' => 'Details not updated, Please make changes and try again.'
                ];
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Update not execeuted.'
            ];
        }
        mysqli_stmt_close($stmt); // Close statement in both cases
    } else {
        $response = ['success' => false, 'message' => 'Failed to prepare statement: ' . mysqli_stmt_error($stmt)];
    }

    echo json_encode($response);
    exit;

    // Output the response in JSON format


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
        $response['message'] = 'Please fill all the fields.';
    } elseif ($cpass != $newpword) {
        $response['message'] = 'New Password do not match';
    } else {
        $sql = "SELECT * FROM olnee_admin WHERE user_id = ?";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $user_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                if ($newpass == $confirmpass) {
                    $enc_pass = $row['pword_hash'];
                    // $2y$10$TP3kRfWlDs25pZxpFLr.1eQN/j2u9ipMBBD2mzwM0EwW33VksMI7W
                    if (password_verify($pword, $enc_pass)) {
                        $newpasshash = password_hash($newpword, PASSWORD_BCRYPT);
                        // Prepare the SQL statement with placeholders
                        $updateuser = "UPDATE olnee_admin SET pword_hash = ? WHERE user_id=?";
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
                                    $response['message'] = 'Password updated successfully.';
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
