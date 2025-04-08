
$(document).ready(function () {
    // console.log('jQuery is loaded');
    $(document).on('click', '.delete-image-btn', function (e) {
        e.preventDefault();

        const $btn = $(this);
        const productId = $btn.data('productid');
        const imgId = $btn.data('imgid');
        const targetId = $btn.data('targetid');
        const modalId = $btn.closest('.modal').attr('id');

        $.ajax({
            url: 'inc/delete_img.php',
            type: 'GET',
            dataType: 'json', // Important to parse JSON response automatically
            data: {
                productid: productId,
                img_id: imgId
            },
            success: function (response) {
                if (response.status === 'success') {
                    // Remove the image block
                    $('#' + targetId).fadeOut(300, function () {
                        $(this).remove();
                    });
                    // Close the modal
                    $('#' + modalId).modal('hide');
                    // window.location.href = 'image?productid=' + response.product_id; // Redirect on success
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
                alert("An error occurred while deleting the image.");
                console.error("AJAX Error:", error);
            }
        });
    });



});




// Dropzone for image upload begin
// Dropzone.options.customersCamDropzone = {
//     paramName: 'file', // The name that will be used to transfer the file
//     autoProcessQueue: false, // Disable automatic upload
//     parallelUploads: 10,
//     maxFilesize: 3, // MB
//     acceptedFiles: '.png,.jpg,.jpeg,.gif',
//     addRemoveLinks: true,
//     success:function (file, responseText) {
//         let response;
//         try {
//             response = typeof responseText === 'string' ? JSON.parse(responseText) : responseText;
//         } catch (e) {
//             console.log('JSON parse error:', e);
//             return;
//         }

//         // Check if the response status is success before redirecting
//         if (response.status === 'success') {
//             // console.log('File uploaded successfully:', response);
//             showNotification(response.message, 'success'); // Show notification
//         } else {
//             console.log('Upload error:', response.message);
//             showNotification(response.message, 'error'); // Show notification
//         }
//     },
//     error: function (file, response) {
//         showNotification(response.message, 'error'); // Show notification
//         console.log('Error uploading file:', response);
//     },
//     init: function () {
//         // Adding an event listener to the custom button
//         const submitButton = document.querySelector("#upload-button");
//         const myDropzone = this;

//         submitButton.addEventListener("click", function () {
//             // Process all files in the Dropzone queue
//             myDropzone.processQueue();
//         });

//         // this.on("sending", function (file, xhr, formData) {
//         //     formData.append("product_id", document.getElementById('product_id').value);
//         // });
//     }
// };

Dropzone.autoDiscover = false;
const myDropzone = new Dropzone("#customers-cam-dropzone", {
    url: "upload.php", // Set to your actual upload handler
    paramName: 'file',
    autoProcessQueue: false,
    parallelUploads: 10,
    maxFilesize: 3, // MB
    acceptedFiles: '.png,.jpg,.jpeg,.gif',
    addRemoveLinks: true,

    init: function () {
        const dz = this;
        const submitButton = document.querySelector("#upload-button");

        submitButton.addEventListener("click", function () {
            console.log("Upload button clicked");
            console.log("Files queued:", dz.getQueuedFiles());
            dz.processQueue();
        });

        dz.on("success", function (file, responseText) {
            console.log("Dropzone success callback fired");

            let response;
            try {
                response = typeof responseText === 'string' ? JSON.parse(responseText) : responseText;
                console.log("Parsed response:", response);
            } catch (e) {
                console.error("Error parsing response:", e, responseText);
                return;
            }

            if (response.status === 'success') {
                showNotification(response.message, 'success');
            } else {
                showNotification(response.message, 'error');
            }
        });

        dz.on("error", function (file, responseText) {
            console.log("Dropzone error callback fired");

            let response;
            try {
                response = typeof responseText === 'string' ? JSON.parse(responseText) : responseText;
                showNotification(response.message, 'error');
            } catch (e) {
                console.error("Failed to parse error response:", responseText);
                showNotification("Upload failed unexpectedly.", 'error');
            }
        });
    }
});

// Dropzone for image upload end

// Dropzone for edit image begin
// Dropzone.options.editImagesDropzone = {
//     paramName: 'file', // The name that will be used to transfer the file
//     autoProcessQueue: false, // Disable automatic upload
//     parallelUploads: 10,
//     maxFilesize: 3, // MB
//     acceptedFiles: '.png,.jpg,.jpeg,.gif',
//     addRemoveLinks: true,
//     success: function (file, response) {
//         console.log('File uploaded successfully:', response);

//         if (response.status === 'success') {
//             // document.getElementById('success-message').innerText = response.message;
//             // document.getElementById('success-message').style.display = 'block';
//             showNotification(response.message);
//             // Optionally redirect after displaying success message
//             // window.location.href = 'thumbnail.php?productid=' + response.product_id;
//         } else {
//             document.getElementById('error-message').innerText = response.message;
//             document.getElementById('error-message').style.display = 'block';
//             showNotification(response.message, 'error');
//         }
//     },
//     error: function (file, response) {
//         // document.getElementById('error-message').innerText = response.message || 'An error occurred during the upload.';
//         // document.getElementById('error-message').style.display = 'block';
//         showNotification(response.message || 'An error occurred during the upload.', 'error');
//     },
//     init: function () {
//         const submitButton = document.querySelector("#upload-button");
//         const myDropzone = this;

//         submitButton.addEventListener("click", function () {
//             myDropzone.processQueue();
//         });

//         this.on("sending", function (file, xhr, formData) {
//             formData.append("product_id", document.getElementById('product_id').value);
//         });
//     }
// };
// Dropzone for edit image end