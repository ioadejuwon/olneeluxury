// function showNotification(message, type = 'success') {
//     const container = document.getElementById('notification-container');
//     const notification = document.createElement('div');
//     notification.className = `notification ${type}`;
//     notification.textContent = message;
//     container.appendChild(notification);

//     // Show notification
//     setTimeout(() => {
//         notification.classList.add('show');
//     }, 100);

//     // Hide and remove notification after 3 seconds
//     setTimeout(() => {
//         notification.classList.remove('show');
//         setTimeout(() => {
//             container.removeChild(notification);
//         }, 500); // Match the transition duration
//     }, 3000);
// }

$(document).ready(function () {
    // Add category to the Database begin
    $('#deliveryForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission
        // console.log("You clicked add delivery button");

        var formData = $(this).serialize(); // Serialize the form data

        $.ajax({
            type: 'POST',
            url: '../inc/adddelivery.php', // The URL to the PHP script that handles the form submission
            data: formData, // Send the serialized form data
            dataType: 'json', // Expect JSON response
            success: function (response) {
                if (response.status === 'success') {
                    
                    // Append new category to the table only if the category was created successfully
                    $('#deliveryTableBody').prepend(
                        `
                        <tr>
                            <td class="underline">` + response.deliveryname + `</td>
                            <td>` + response.deliverycost + `</td>
                            <td class="dropdown">
                                <img src="assets/img/more_horiz.png" alt="">
                                <div class="dropdown-content">
                                    <a data-toggle="modal" data-target="#edit-` + response.delivery_id + `">Edit Delivery Rate</a>
                                    <a data-toggle="modal" data-target="#delete-`+ response.delivery_id + `">Delete</a>
                                </div>
                            </td>
                        </tr>
                        `
                    );

                    $('#modalTableBody').prepend(
                        `                        
                        <div class="modal fade" id="delete-`+ response.delivery_id + `" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <!-- <h5 class="modal-title"></h5> -->
                                    <h2 class="modal-title h4">Delete Rate</h2>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body p-4">

                                    
                                    <p class="text-dark">Are you sure you want to delete the Delivery Rate "<span class="fw-600">` + response.deliveryname + `</span>". This process is irreversible.</p>
                                    <ul class="row gx-4 mt-4">
                                        <li class="col-12">
                                        <a href="#" class="button -red-1 w-100 button -md -deep-green-1 text-white delete-delivery-btn" data-deliveryid="`+ response.delivery_id + `">Delete Delovery Rate</a>
                                        </li>
                                    </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
              
              `
                    );


                    setTimeout(function () {
                        document.getElementById("deliveryForm").reset(); // Resets the entire form, including the input field
                        $('#modal-delivery-rate').modal('hide');
                        // if ($('.empty').length) hide; // Run only on cart page
                        if ($('.empty').length) {
                            $('.desction').hide();
                        }
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

    $(document).on('click', '.delete-delivery-btn', function (e) {
        e.preventDefault();
        const deliveryid = $(this).data('deliveryid');
        const deliveryElement = $('#delivery-' + deliveryid);
        $.ajax({
            url: '../inc/deletedelivery.php',
            type: 'POST',
            data: { delivery_id: deliveryid },
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    // Hide the modal
                    $('#delete-' + deliveryid).modal('hide');
                    deliveryElement.remove(); // Remove the product element from the DOM
                    showNotification(response.message, 'success'); // Show notification
                } else {
                    showNotification(response.message, 'error'); // Red notification
                }
            },
            error: function (xhr, status, error) {
                showNotification('An error occurred while trying to delete the product.', 'error');
            }
        });
    });

});