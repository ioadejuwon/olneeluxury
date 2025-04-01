$(document).ready(function () {
    // Login Form Begin
    $('#loginForm').on('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        var $submitButton = $(this).find('button[type="submit"]');
        $submitButton.prop('disabled', true).text('Logging you in'); // Change button text to indicate it's processing

        $.ajax({
            type: 'POST',
            url: 'inc/admin_auth.php',
            data: $(this).serialize() + '&login=true', // Serialize form data
            dataType: 'json',
            success: function (response) {
                // Clear any previous notifications
                if (response.status === 'success') {
                    // console.log(response);
                    // showNotification(response.message, 'info'); // Show notification
                    // showNotification(response.message2, 'info'); // Show notification
                    window.location.href = response.redirect_url; // Redirect on success
                } else if (response.status == 'info') {
                    showNotification(response.message, 'info'); // Yellow notification
                } else if (response.status == 'error') {
                    showNotification(response.message, 'error'); // Red notification
                } else {
                    showNotification(response.message, 'error');
                }
            },
            error: function (xhr, status, error) {
                showNotification(`An error occurred while processing your request. ${error}`, `error`);
            },
            complete: function () {
                // Re-enable the submit button after the request is complete
                $submitButton.prop('disabled', false).text('You are logged in');
                // $submitButton.text('You are logged in!');
            }
        });
    });
    // Login Form End
    // Signup Form Begin
    $('#signupForm').on('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission
        // Get the password and confirmation password values
        var newPassword = $('#signupPassword').val();
        var confirmPassword = $('#confirmPassword').val();
        // Password validation regex: at least one uppercase letter, one number, one special character, and at least 7 characters long
        var passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^\w\s]).{7,}$/;
        // var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{7,}$/;
        if (!passwordPattern.test(newPassword)) {
            showNotification('Password must be at least 7 characters long, include at least one uppercase letter, one number, and one special character.', 'error');
            return; // Stop form submission
        }
        if (newPassword !== confirmPassword) {
            showNotification('New password and confirm password do not match.', 'error');
            return; // Stop form submission
        }
        $.ajax({
            type: 'POST',
            url: 'inc/account_auth.php',
            data: $(this).serialize() + '&signup=true', // Serialize form data
            dataType: 'json',
            success: function (response) {
                console.log(response);
                // Clear any previous notifications
                if (response.status == 'success') {
                    // console.log(response);
                    showNotification(response.message, 'success'); // Show notification
                    setTimeout(() => {
                        window.location.href = response.redirect_url; // Redirect on success
                    }, 2000);
                } else if (response.status == 'info') {
                    showNotification(response.message, 'info'); // Yellow notification
                } else if (response.status == 'error') {
                    showNotification('error 1' + response.message, 'error'); // Red notification
                } else {
                    showNotification('Error 2: ' + response.message, 'error');
                }
            },
            error: function (xhr, status, error) {
                // Handle errors (e.g., network issues)
                // $('#errorMessage').html(`<p class="fw-300 text-error-1">An error occurred: ${error}</p>`);
                showNotification(`An error occurred while processing your request. ${error}`, `error`);
                showNotification(`An error occurred while processing your request. ${xhr}`, `error`);
            }
        });
    });
    // Signup Form End

    // Edit Account Form Begin
    $('#edit_account').on('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission
        // Get the password and confirmation password values
        $.ajax({
            type: 'POST',
            url: 'inc/account_auth.php',
            data: $(this).serialize() + '&edit_account=true', // Serialize form data
            dataType: 'json',
            success: function (response) {
                // Clear any previous notifications
                if (response.status == 'success') {
                    // console.log(response);
                    showNotification(response.message, 'success'); // Show notification
                    setTimeout(() => {
                        // window.location.href = response.redirect_url; // Redirect on success
                    }, 2000);
                } else if (response.status == 'info') {
                    showNotification(response.message, 'info'); // Yellow notification
                } else if (response.status == 'error') {
                    showNotification(response.message, 'error'); // Red notification
                } else {
                    showNotification('Error 2: ' + response.message, 'error');
                }
            },
            error: function (xhr, status, error) {
                // Handle errors (e.g., network issues)
                // $('#errorMessage').html(`<p class="fw-300 text-error-1">An error occurred: ${error}</p>`);
                showNotification(`An error occurred while processing your request. ${error}`, `error`);
                showNotification(`An error occurred while processing your request. ${xhr}`, `error`);
            }
        });
    });
    // Edit Account Form Form End

    // Edit Account Form Begin
    $('#edit_password').on('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission
        // Get the password and confirmation password values
        var newPassword = $('#property5').val();
        var confirmPassword = $('#property6').val();
        // Password validation regex: at least one uppercase letter, one number, one special character, and at least 7 characters long
        var passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^\w\s]).{7,}$/;

        if (!passwordPattern.test(newPassword)) {
            showNotification('Password must be at least 7 characters long, include at least one uppercase letter, one number, and one special character.', 'error');
            return; // Stop form submission
        }
        if (newPassword !== confirmPassword) {
            showNotification('New password and confirm password do not match.', 'error');
            return; // Stop form submission
        }
        $.ajax({
            type: 'POST',
            url: 'inc/account_auth.php',
            data: $(this).serialize() + '&edit_password=true', // Serialize form data
            dataType: 'json',
            success: function (response) {
                // Clear any previous notifications
                if (response.status == 'success') {
                    // console.log(response);
                    showNotification(response.message, 'success'); // Show notification
                    setTimeout(() => {
                        // window.location.href = response.redirect_url; // Redirect on success
                    }, 2000);
                } else if (response.status == 'info') {
                    showNotification(response.message, 'info'); // Yellow notification
                } else if (response.status == 'error') {
                    showNotification(response.message, 'error'); // Red notification
                } else {
                    showNotification('Error 2: ' + response.message, 'error');
                }
            },
            error: function (xhr, status, error) {
                // Handle errors (e.g., network issues)
                // $('#errorMessage').html(`<p class="fw-300 text-error-1">An error occurred: ${error}</p>`);
                showNotification(`An error occurred while processing your request. ${error}`, `error`);
                showNotification(`An error occurred while processing your request. ${xhr}`, `error`);
            }
        });
    });
    // Edit Account Form Form End



    // Verify email Begin
    $('#verifyemailForm').on('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission
        $.ajax({
            type: 'POST',
            url: 'inc/auth.php',
            data: $(this).serialize() + '&verify=true', // Serialize form data
            dataType: 'json',
            success: function (response) {
                // Clear any previous notifications
                if (response.status === 'success') {
                    // console.log(response);
                    // window.location.href = response.redirect_url; // Redirect on success
                    showNotification(response.message, 'success'); // Green notification
                } else if (response.status == 'info') {
                    showNotification(response.message, 'info'); // Yellow notification
                } else if (response.status == 'error') {
                    showNotification(response.message, 'error'); // Red notification
                } else {
                    showNotification(response.message, 'error');
                }
            },
            error: function (xhr, status, error) {
                // Handle errors (e.g., network issues)
                // $('#errorMessage').html(`<p class="fw-300 text-error-1">An error occurred: ${error}</p>`);
                showNotification(`An error occurred while processing your request. ${error}`, `error`);
            }
        });
    });
    // Verify email End
    // Recover Form Begin
    $('#recoverForm').on('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission
        $.ajax({
            type: 'POST',
            url: 'inc/recoverpassword.php',
            data: $(this).serialize() + '&recover=true', // Serialize form data
            dataType: 'json',
            success: function (response) {
                // Clear any previous notifications
                if (response.status === 'success') {
                    // console.log(response);
                    // showNotification(response.message, 'success'); // Show notification
                    // window.location.href = response.redirect_url; // Redirect on success
                    showNotification(response.message, 'success'); // Yellow notification
                } else if (response.status == 'info') {
                    showNotification(response.message, 'info'); // Yellow notification
                } else if (response.status == 'error') {
                    showNotification(response.message, 'error'); // Red notification
                } else {
                    showNotification(response.message, 'error');
                }
            },
            error: function (xhr, status, error) {
                // Handle errors (e.g., network issues)
                // $('#errorMessage').html(`<p class="fw-300 text-error-1">An error occurred: ${error}</p>`);
                showNotification(`An error occurred while processing your request. ${error}`, `error`);
            }
        });
    });
    // Recover Form End
    // Reset Form Begin
    $('#resetForm').on('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission
        // Get the password and confirmation password values
        var newPassword = $('#Password').val();
        var confirmPassword = $('#confirmPassword').val();
        // Password validation regex: at least one uppercase letter, one number, one special character, and at least 7 characters long
        var passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^\w\s]).{7,}$/;
        // var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{7,}$/;
        if (!passwordPattern.test(newPassword)) {
            showNotification('Password must be at least 7 characters long, include at least one uppercase letter, one number, and one special character.', 'error');
            return; // Stop form submission
        }
        if (newPassword !== confirmPassword) {
            showNotification('New password and confirm password do not match.', 'error');
            return; // Stop form submission
        }
        $.ajax({
            type: 'POST',
            url: 'inc/resetpassword.php',
            data: $(this).serialize() + '&reset=true', // Serialize form data
            dataType: 'json',
            success: function (response) {
                // Clear any previous notifications
                if (response.status === 'success') {
                    window.location.href = response.redirect_url; // Redirect on success
                    // showNotification(response.message, 'success'); // Yellow notification
                } else if (response.status == 'info') {
                    showNotification(response.message, 'info'); // Yellow notification
                } else if (response.status == 'error') {
                    showNotification(response.message, 'error'); // Red notification
                } else {
                    showNotification(response.message, 'error');
                }
            },
            error: function (xhr, status, error) {
                showNotification(`An error occurred while processing your request. ${error}`, `error`);
                showNotification(`An error occurred while processing your request. ${xhr}`, `info`);
                showNotification(`An error occurred while processing your request. ${status}`, `success`);
            }
        });
    });
    // Reset Form End 
    // Store Setup Form Begin
    $('#storesetup').on('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission
        console.log('I got here');
        // Disable the submit button to prevent multiple submissions
        var $submitButton = $(this).find('button[type="submit"]');
        $submitButton.prop('disabled', true).text('Setting up Store'); // Change button text to indicate it's processing
        var setupForm = document.getElementById('storeSetupForm');
        $.ajax({
            type: 'POST',
            url: 'inc/setup.php',
            data: $(this).serialize() + '&storesetup=true', // Serialize form data
            dataType: 'json',
            success: function (response) {
                // Clear any previous notifications
                if (response.status === 'success') {
                    // console.log(response);
                    showNotification(response.message, 'success'); // Show notification
                    showNotification('Store details updated. You can edit your cover photo and brand picture.', 'success'); // Show notification
                    setupForm.innerHTML = `
                                <div class="col-md-12 text-center">
                                <div class="py-30 bg-light-4 rounded-8 border-light col-md-8 mt-50 mb-50" style="margin: 0% auto;">
                                    <img src="assets/img/store.png" style="width:20%">
                                    <h3 class="px-30 text- fw-500 mt-20">
                                        Store Details Saved
                                    </h3>
                                    <p class="pt-10 mb-20">
                                        You can edit your logo and cover image now.
                                    </p>
                                </div>
                            </div>`;
                    // window.location.href = response.redirect_url; // Redirect on success
                } else if (response.status == 'info') {
                    showNotification(response.message, 'info'); // Yellow notification
                } else if (response.status == 'error') {
                    showNotification(response.message, 'error'); // Red notification
                } else {
                    showNotification(response.message, 'error');
                }
            },
            error: function (xhr, status, error) {
                // Handle errors (e.g., network issues)
                // $('#errorMessage').html(`<p class="fw-300 text-error-1">An error occurred: ${error}</p>`);
                showNotification(`An error occurred while processing your request. ${error}`, `error`);
                showNotification(`An error occurred while processing your requestd. ${xhr}`, `error`);
                console.log(`Error: ${error}`);
            },
            complete: function () {
                // Re-enable the submit button after the request is complete
                $submitButton.prop('disabled', false).text('Store Setup');
            }
        });
    });
    // Store Setup Form End
});