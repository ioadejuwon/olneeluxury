
$(document).ready(function () {
    // console.log('jQuery is loaded');
    // Update the store in the Database begin
    $('#store-update').on('submit', function (event) {
        event.preventDefault(); // Prevent default form submission
        // Disable the submit button to prevent multiple submissions
        var $submitButton = $(this).find('button[type="submit"]');
        $submitButton.prop('disabled', true).text('Updating Store Detai'); // Change button text to indicate it's processing
        // Gather form data
        var formData = $(this).serialize();
        // Send AJAX request
        $.ajax({
            url: 'inc/updatestore.php', // Replace with your server-side processing URL
            type: 'POST',
            data: formData,
            success: function (response) {
                if (response.status === 'success') {
                    // $('.brand-name').text(response.brandName);
                    // console.log(response);
                    showNotification(response.message, 'success'); // Show notification
                } else if (response.status == 'info') {
                    showNotification(response.message, 'info'); // Yellow notification
                } else if (response.status == 'error') {
                    showNotification(response.message + 'error now', 'error'); // Red notification
                } else {
                    showNotification(response.message + 'error now 2', 'error');
                }

            },
            error: function (xhr, status, error) {
                // Handle the error response here
                // console.error(xhr.responseText);
                // alert('An error occurred while updating the store details.');
                showNotification('An error occurred while updating the store details.', 'error');
                showNotification('An error occurred: ' + xhr.responseText, 'error');
                showNotification('An error occurred: ' + error.responseText, 'error');
            },
            complete: function () {
                // Re-enable the submit button after the request is complete
                $submitButton.prop('disabled', false).text('Update Store Details');
            }
        });
    });
    // Update the store in the Database end

    // Edit Account Form Begin
    $('#edit_password').on('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission
        // Get the password and confirmation password values
        var newPassword = $('#newPassword').val();
        var confirmPassword = $('#confirmnewPassword').val();
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

});

