function showNotification(message, type = 'success') {
    const container = document.getElementById('notification-container');
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.textContent = message;
    container.appendChild(notification);

    // Show notification
    setTimeout(() => {
        notification.classList.add('show');
    }, 100);

    // Hide and remove notification after 3 seconds
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            container.removeChild(notification);
        }, 500); // Match the transition duration
    }, 3000);
}

$(document).ready(function () {
    // Add category to the Database begin
    $('#couponForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission
        // console.log("You clicked add delivery button");

        var formData = $(this).serialize(); // Serialize the form data
        $.ajax({
            type: 'POST',
            url: '../inc/couponcode.php', // The URL to the PHP script that handles the form submission
            data: formData, // Send the serialized form data
            dataType: 'json', // Expect JSON response
            success: function (response) {
                if (response.status === 'success') {
                    // Append new category to the table only if the category was created successfully
                    $('#couponTableBody').prepend(
                        `<tr><td class="underline">` + response.couponname + `</td><td>` + response.couponcode + `</td> <td>` + response.coupontype + `</td><td>` + response.couponvalue + `</td><td>` + response.coupondate + `</td></tr>`
                    );

                    setTimeout(function () {
                        document.getElementById("couponForm").reset(); // Resets the entire form, including the input field
                        $('#modal-coupon-rate').modal('hide');

                    }, 2000); // 3000 milliseconds = 3 seconds
                    showNotification(response.message), 'success';
                } else if (response.status == 'info') {
                    showNotification(response.message, 'info'); // Yellow notification
                } else if (response.status == 'error') {
                    showNotification(response.message, 'error'); // Red notification
                } else {
                    // setTimeout(function() {
                    //     $('#error-message').html('<input type="text" name="categoryname" id="category" placeholder="Enter the name of the category" required>');
                    // }, 3000); // 3000 milliseconds = 3 seconds
                }
            },
            error: function (xhr, status, error) {
                showNotification('An error occurred: ' + xhr.responseText);
                setTimeout(function () {
                    $('#error-message').html('');
                }, 3000); // 3000 milliseconds = 3 seconds
            }
        });
    });
    // Add category to the Database end


});