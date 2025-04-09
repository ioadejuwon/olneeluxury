
$(document).ready(function () {
    // console.log('jQuery is loaded');
    // Assuming jQuery is available
    // $(document).on('click', '.delete-image-btn', function () {
    //     const imgID = $(this).data('imgid');
    //     const targetID = $(this).data('targetid');

    //     // Optional: AJAX call to delete image on backend

    //     // Remove the image box from the DOM
    //     $('#' + targetID).remove();

    //     showNotification('Image deleted successfully.', 'success');
    // });

    $(document).on('click', '.delete-customer-image-btn', function (e) {
        e.preventDefault();

        const $btn = $(this);
        const imgId = $btn.data('imgid');
        const targetId = $btn.data('targetid');
        const modalId = $btn.closest('.modal').attr('id');

        $.ajax({
            url: 'inc/delete_customer_img.php',
            type: 'GET',
            dataType: 'json', // Important to parse JSON response automatically
            data: {
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

// Dropzone.autoDiscover = false;
// const myDropzone = new Dropzone("#customers-cam-dropzone", {
//     url: "inc/customers_cam.php", // Set to your actual upload handler
//     paramName: 'file',
//     autoProcessQueue: false,
//     parallelUploads: 10,
//     maxFilesize: 3, // MB
//     acceptedFiles: '.png,.jpg,.jpeg,.gif',
//     addRemoveLinks: true,

//     init: function () {
//         const dz = this;
//         const submitButton = document.querySelector("#upload-button");

//         submitButton.addEventListener("click", function () {
//             console.log("Upload button clicked");
//             console.log("Files queued:", dz.getQueuedFiles());
//             dz.processQueue();
//         });

//         dz.on("success", function (file, responseText) {
//             console.log("Dropzone success callback fired");

//             let response;
//             try {
//                 response = typeof responseText === 'string' ? JSON.parse(responseText) : responseText;
//                 console.log("Parsed response:", response);
//             } catch (e) {
//                 console.error("Error parsing response:", e, responseText);
//                 return;
//             }

//             if (response.status === 'success') {
//                 showNotification(response.message, 'success');
//                 this.removeAllFiles(true);

//                 // console.log("Parsed response:", response);

//                 // Create new image box HTML
//                 const imageBox = `
//                 <div id="image-box-${response.img_id}" class="col-md-2 col-4">
//                     <div class="relative shrink-0">
//                         <div class="bg-image ratio ratio-30:35 js-lazy -outline-deep-green-1 rounded-8" 
//                              style="background-image: url('${response.img_path ?? 'path/to/placeholder.jpg'}');"></div>
        
//                         <div class="absolute-full-center justify-between d-flex justify-end py-10 px-10">
//                             <div>
//                                 <div class="d-flex justify-center items-center size-30 rounded-8 bg-light-3">
//                                     <div class="icon-bin text-16" data-toggle="modal" data-target="#myModal-${response.img_id}"></div>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                 </div>
        
//                 <!-- Modal -->
//                 <div class="modal fade" id="myModal-${response.img_id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
//                     <div class="modal-dialog modal-dialog-centered">
//                       <div class="modal-content">
//                         <div class="modal-header">
//                           <h2 class="modal-title h4">Delete Image</h2>
//                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
//                             <img src="assets/img/icons/close.png" alt="close" width="30%">
//                           </button>
//                         </div>
//                         <div class="modal-body p-4 pt-0">
//                           <p class="text-dark">
//                             Are you sure you want to delete this image?
//                             <br>This process is not reversible.
//                           </p>
        
//                           <ul class="row gx-4 mt-4">
//                             <li class="col-12">
//                               <button type="button" class="button -md -red-1 w-100 text-white delete-customer-image-btn"
//                                   data-imgid="${response.img_id}"
//                                   data-targetid="image-box-${response.img_id}"
//                                   data-dismiss="modal">
//                                   Delete Image
//                               </button>
//                             </li>
//                           </ul>
//                         </div>
//                       </div>
//                     </div>
//                 </div>`;

//                 // Append to gallery
//                 document.getElementById("image-gallery").insertAdjacentHTML("beforeend", imageBox);

//             } else {
//                 showNotification(response.message, 'error');
//             }
//         });

//         dz.on("error", function (file, responseText) {
//             console.log("Dropzone error callback fired");

//             let response;
//             try {
//                 response = typeof responseText === 'string' ? JSON.parse(responseText) : responseText;
//                 showNotification(response.message, 'error');
//             } catch (e) {
//                 console.error("Failed to parse error response:", responseText);
//                 showNotification("Upload failed unexpectedly.", 'error');
//             }
//         });
//     }
// });

Dropzone.autoDiscover = false;

const myDropzone = new Dropzone("#customers-cam-dropzone", {
    url: "inc/customers_cam.php", // Set to your actual upload handler
    paramName: 'file',
    autoProcessQueue: false,  // Prevent automatic upload
    parallelUploads: 10,
    maxFilesize: 3, // MB
    acceptedFiles: '.png,.jpg,.jpeg,.gif',
    addRemoveLinks: true,

    init: function () {
        const dz = this;
        const submitButton = document.querySelector("#upload-button");

        // When the upload button is clicked
        submitButton.addEventListener("click", function () {
            console.log("Upload button clicked");
            console.log("Files queued:", dz.getQueuedFiles());

            if (dz.getQueuedFiles().length > 0) {
                dz.processQueue();  // Process all queued files
            } else {
                showNotification("No files selected for upload.", 'error');
            }
        });

        // Handle success callback for each file upload
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

                // Create new image box HTML
                const imageBox = `
                <div id="image-box-${response.img_id}" class="col-md-2 col-4">
                    <div class="relative shrink-0">
                        <div class="bg-image ratio ratio-30:35 js-lazy -outline-deep-green-1 rounded-8" 
                             style="background-image: url('${response.img_path ?? 'path/to/placeholder.jpg'}');"></div>
        
                        <div class="absolute-full-center justify-between d-flex justify-end py-10 px-10">
                            <div>
                                <div class="d-flex justify-center items-center size-30 rounded-8 bg-light-3">
                                    <div class="icon-bin text-16" data-toggle="modal" data-target="#myModal-${response.img_id}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                <!-- Modal -->
                <div class="modal fade" id="myModal-${response.img_id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h2 class="modal-title h4">Delete Image</h2>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="assets/img/icons/close.png" alt="close" width="30%">
                          </button>
                        </div>
                        <div class="modal-body p-4 pt-0">
                          <p class="text-dark">
                            Are you sure you want to delete this image?
                            <br>This process is not reversible.
                          </p>
        
                          <ul class="row gx-4 mt-4">
                            <li class="col-12">
                              <button type="button" class="button -md -red-1 w-100 text-white delete-customer-image-btn"
                                  data-imgid="${response.img_id}"
                                  data-targetid="image-box-${response.img_id}"
                                  data-dismiss="modal">
                                  Delete Image
                              </button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                </div>`;

                // Append the new image box HTML to the gallery
                document.getElementById("image-gallery").insertAdjacentHTML("beforeend", imageBox);

                // After successful upload, remove the file preview from Dropzone
                dz.removeFile(file); // Remove the individual file from the queue
            } else {
                showNotification(response.message, 'error');
            }
        });

        // Handle error callback for failed uploads
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