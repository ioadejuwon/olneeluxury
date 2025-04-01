
$(document).ready(function() {
    // console.log('jQuery is loaded');
    // Update the store in the Database begin
    $('#store-update').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        // Disable the submit button to prevent multiple submissions
        var $submitButton = $(this).find('button[type="submit"]');
        $submitButton.prop('disabled', true).text('Updating Store Detai'); // Change button text to indicate it's processing
        // Gather form data
        var formData = $(this).serialize();
        // Send AJAX request
        $.ajax({
            url: '../inc/updatestore.php', // Replace with your server-side processing URL
            type: 'POST',
            data: formData,
            success: function(response) {
                if(response.status === 'success'){
                    // $('.brand-name').text(response.brandName);
                    // console.log(response);
                    showNotification(response.message, 'success'); // Show notification
                } else if (response.status == 'info'){
                    showNotification(response.message, 'info'); // Yellow notification
                } else if (response.status == 'error'){
                    showNotification(response.message+'error now', 'error'); // Red notification
                } else{
                    showNotification(response.message+'error now 2', 'error');
                }
                
            },
            error: function(xhr, status, error) {
                // Handle the error response here
                // console.error(xhr.responseText);
                // alert('An error occurred while updating the store details.');
                showNotification('An error occurred while updating the store details.' , 'error');
                showNotification('An error occurred: ' + xhr.responseText, 'error');
                showNotification('An error occurred: ' + error.responseText , 'error');
            },
            complete: function() {
                // Re-enable the submit button after the request is complete
                $submitButton.prop('disabled', false).text('Update Store Details');
            }
        });
    });
    // Update the store in the Database end

});

