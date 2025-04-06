
$(document).ready(function () {
    // console.log('jQuery is loaded');

    // Add product to the database Begin
    $('#productFormSubmit').click(function (e) {
        e.preventDefault();

        // Clear previous error messages
        $('#error-message').text('');

        // Validate form fields
        let isValid = true;
        $('#product-details-form').find('input[required], textarea[required], select[required]').each(function () {
            if ($(this).val() === '') {
                isValid = false;
                $(this).addClass('error');  // Add a class to highlight the error (you can style it in CSS)
            } else {
                $(this).removeClass('error');
            }
        });

        if (!isValid) {
            // $('#error-message').text('Please, fill all required fields.');
            showNotification('Please, fill all required fields.', 'error');
            return;
        }

        // Proceed with AJAX request if validation passes
        $.ajax({
            url: 'inc/upload_product_details.php',
            type: 'POST',
            data: $('#product-details-form').serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    // console.log(response);
                    // showNotification(response.message, 'info'); // Show notification
                    // showNotification(response.message2, 'info'); // Show notification
                    window.location.href = 'image?productid=' + response.product_id; // Redirect on success
                } else if (response.status == 'info') {
                    showNotification(response.message, 'info'); // Yellow notification
                } else if (response.status == 'error') {
                    showNotification('kkk ' + response.message, 'error'); // Red notification
                } else {
                    showNotification('kkddsk ' + response.message, 'error');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // $('#error-message').html('An error occurred: ' + textStatus + ' - ' + errorThrown);
                showNotification('An error occurredj: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });
    // Add product to the database end

    //Code for the delete product button on the products page begin
    $(document).on('click', '.delete-product-btn', function (e) {
        e.preventDefault();
        const productId = $(this).data('productid');
        const productElement = $('#product-' + productId);
        $.ajax({
            url: 'inc/deleteproduct.php',
            type: 'POST',
            data: { product_id: productId },
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    // Hide the modal
                    $('#delete-' + productId).modal('hide');
                    productElement.remove(); // Remove the product element from the DOM
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
    //Code for the delete product button on the products page end

    // Edit product in the database Begin
    $('#productFormUpdate').click(function (event) {
        event.preventDefault();
        var formData = $('#product-details-update').serialize();

        $.ajax({
            type: 'POST',
            url: 'inc/update_product.php',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    // console.log(response);
                    // showNotification(response.message, 'info'); // Show notification
                    // showNotification(response.message2, 'info'); // Show notification
                    // window.location.href = 'image?productid=' + response.product_id; // Redirect on success
                    showNotification(response.message, 'success'); // Yellow notification

                    setTimeout(() => {
                        window.location.href = 'product';
                    }, 2000);
                } else if (response.status == 'info') {
                    showNotification(response.message, 'info'); // Yellow notification
                } else if (response.status == 'error') {
                    showNotification(response.message, 'error'); // Red notification
                } else {
                    showNotification(response.message, 'error');
                }
            },
            error: function (xhr, status, error) {
                // $('#error-message').text('An error occurred: ' + error);
                showNotification('An error occurred: ' + error);
            }
        });
    });
    // Edit product in the database end

    $(document).on("click", ".toggle-availability", function (event) {
        event.preventDefault(); // Prevent default link behavior

        let link = $(this);
        let productId = link.data("product-id");
        let newStatus = link.data("status") == 1 ? 0 : 1; // Toggle between 1 and 0

        $.ajax({
            url: "inc/update_availability.php",
            type: "POST",
            data: { product_id: productId, status: newStatus },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    // Update the UI
                    link.data("status", newStatus);
                    link.find("#availability-text").text(newStatus ? "Available" : "Unavailable");

                    // Optional: Change icon color based on status
                    let icon = link.find(".fa-eye");
                    if (newStatus === 1) {
                        icon.css("color", "green");
                    } else {
                        icon.css("color", "red");
                    }

                    showNotification(response.message, "success");
                } else {
                    console.error("Error updating availability:", response.message);
                    showNotification(response.message, "error");
                }
            },
            error: function () {
                console.error("AJAX request failed");
                showNotification("Request failed, try again.", "error");
            }
        });
    });


});





// Set Thumbnail for the product begin
document.querySelectorAll('.thumbnail-form').forEach(form => {
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        fetch('inc/update_thumbnail.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // console.log('Thumbnail updated successfully.');


                    // Remove the 'thumbnail-selected' class from all checkmark buttons
                    document.querySelectorAll('.thumbnail-form button').forEach(button => {
                        button.classList.remove('thumbnail-selected');
                    });

                    // Add the 'thumbnail-selected' class to the clicked checkmark button
                    this.querySelector('button').classList.add('thumbnail-selected');
                    showNotification('Thumbnail updated successfully.');
                } else {
                    console.error('Error updating thumbnail:', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
});
// Set Thumbnail for the product end

// Dropzone for image upload begin
Dropzone.options.productImagesDropzone = {
    paramName: 'file', // The name that will be used to transfer the file
    autoProcessQueue: false, // Disable automatic upload
    parallelUploads: 10,
    maxFilesize: 3, // MB
    acceptedFiles: '.png,.jpg,.jpeg,.gif',
    addRemoveLinks: true,
    success: function (file, response) {
        console.log('File uploaded successfully:', response);

        // Check if the response status is success before redirecting
        if (response.status === 'success') {
            console.log('Redirecting to:', 'thumbnail?productid=' + response.product_id);
            // Redirect to another page after successful upload
            window.location.href = 'thumbnail?productid=' + response.product_id;
        } else {
            console.log('Upload error:', response.message);
            showNotification(response.message, 'error'); // Show notification
        }
    },
    error: function (file, response) {
        console.log('Error uploading file:', response);
    },
    init: function () {
        // Adding an event listener to the custom button
        const submitButton = document.querySelector("#upload-button");
        const myDropzone = this;

        submitButton.addEventListener("click", function () {
            // Process all files in the Dropzone queue
            myDropzone.processQueue();
        });

        this.on("sending", function (file, xhr, formData) {
            formData.append("product_id", document.getElementById('product_id').value);
        });
    }
};
// Dropzone for image upload end

// Dropzone for edit image begin
Dropzone.options.editImagesDropzone = {
    paramName: 'file', // The name that will be used to transfer the file
    autoProcessQueue: false, // Disable automatic upload
    parallelUploads: 10,
    maxFilesize: 3, // MB
    acceptedFiles: '.png,.jpg,.jpeg,.gif',
    addRemoveLinks: true,
    success: function (file, response) {
        console.log('File uploaded successfully:', response);

        if (response.status === 'success') {
            // document.getElementById('success-message').innerText = response.message;
            // document.getElementById('success-message').style.display = 'block';
            showNotification(response.message);
            // Optionally redirect after displaying success message
            // window.location.href = 'thumbnail.php?productid=' + response.product_id;
        } else {
            document.getElementById('error-message').innerText = response.message;
            document.getElementById('error-message').style.display = 'block';
            showNotification(response.message, 'error');
        }
    },
    error: function (file, response) {
        // document.getElementById('error-message').innerText = response.message || 'An error occurred during the upload.';
        // document.getElementById('error-message').style.display = 'block';
        showNotification(response.message || 'An error occurred during the upload.', 'error');
    },
    init: function () {
        const submitButton = document.querySelector("#upload-button");
        const myDropzone = this;

        submitButton.addEventListener("click", function () {
            myDropzone.processQueue();
        });

        this.on("sending", function (file, xhr, formData) {
            formData.append("product_id", document.getElementById('product_id').value);
        });
    }
};
// Dropzone for edit image end