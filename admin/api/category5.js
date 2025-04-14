
$(document).ready(function () {
    // console.log('jQuery is loaded');
    // Add category to the Database begin
    // $('#categoryForm').on('submit', function (e) {
    //     e.preventDefault(); // Prevent the default form submission
    //     console.log("You clicked add category button");

    //     var categoryName = $('input[name="categoryname"]').val();

    //     $.ajax({
    //         type: 'POST',
    //         url: 'inc/category.php', // The URL to the PHP script that handles the form submission
    //         data: {
    //             categoryname: categoryName
    //         },
    //         dataType: 'json', // Expect JSON response
    //         success: function (response) {
    //             // $('#error-message').html(response.message);
                // showNotification(response.message);
    //             // showNotification(response.category_id);

    //             if (response.status === 'success') {
    //                 // Append new category to the table only if the category was created successfully
    //                 let emptyRow = $(".empty");
    //                 if (emptyRow.is(":visible")) {
    //                     emptyRow.fadeOut(300, function () {
    //                         $(this).remove();
    //                     });
    //                 }
    //                 $('#categoryTableBody').prepend(
    //                     `<tr id="category-` + response.category_id + `">
    //                         <td>` + categoryName + `</td>
    //                         <td>0</td>
    //                         <td class="dropdown">
    //                             <img src="assets/img/icons/more_horiz.png" alt="" width="50%">
    //                             <div class="dropdown-content">
    //                                 <a data-toggle="modal" data-target="#edit-` + response.category_id + `">Edit Category</a>
    //                                 <a class="copyButton" data-info="Category `+ categoryName + ` link copied" data-link="` + response.category_id + `" >Copy Category link</a>
    //                                 <a data-toggle="modal" data-target="#delete-`+ response.category_id + `">Delete</a>
    //                             </div>
    //                         </td>
    //                     </tr>




    //           `
    //                 );

    //                 $('#modalTableBody').prepend(
    //                     `                        

    //                     <div class="modal fade" id="delete-`+ response.category_id + `" tabindex="-1">
    //                         <div class="modal-dialog modal-dialog-centered">
    //                             <div class="modal-content">
    //                                 <div class="modal-header">
    //                                 <!-- <h5 class="modal-title"></h5> -->
    //                                 <h2 class="modal-title h4">Delete Category/h2>
    //                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    //                                     <img src="assets/img/icons/close.png" alt="close" width="30%">
    //                                 </button>
    //                                 </div>
    //                                 <div class="modal-body p-4">
    //                                     <p class="text-dark">Are you sure you want to delete the category "<span class="fw-600">`+ categoryName + `</span>". This process is irreversible.</p>
    //                                     <p class="text-dark">The products currently listed under the category "<span class="fw-600">`+ categoryName + `</span>" will still be available.</p>
    //                                     <ul class="row gx-4 mt-4">
    //                                         <li class="col-12">
    //                                         <a href="#" class="button -red-1 w-100 button -md -deep-green-1 text-white delete-category-btn" data-categoryid="`+ response.category_id + `">Delete Category</a>
    //                                         </li>
    //                                     </ul>
    //                                 </div>
    //                             </div>
    //                         </div>
    //                     </div>

    //           `
    //                 );

    //                 setTimeout(function () {
    //                     document.getElementById("categoryForm").reset(); // Resets the entire form, including the input field
    //                     $('#modal-categories').modal('hide');
    //                 }, 3000); // 3000 milliseconds = 3 seconds
    //             }
    //         },
    //         error: function (xhr, status, error) {
    //             // $('#error-message').html('An error occurred: ' + xhr.responseText);
    //             showNotification('An error occurred: ' + xhr.responseText);
    //             setTimeout(function () {
    //                 $('#error-message').html('');
    //             }, 3000); // 3000 milliseconds = 3 seconds
    //         }
    //     });
    // });
    // Add category to the Database end



    $(document).on('click', '.delete-category-btn', function (e) {
        e.preventDefault();
        const categoryId = $(this).data('categoryid');
        const categoryElement = $('#category-' + categoryId);
        $.ajax({
            url: 'inc/deletecategory.php',
            type: 'POST',
            data: { category_id: categoryId },
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    // Hide the modal
                    $('#delete-' + categoryId).modal('hide');
                    categoryElement.remove(); // Remove the product element from the DOM
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

Dropzone.autoDiscover = false;

const dz = new Dropzone("#dropzoneArea", {
  url: "inc/category.php", // This is where your image goes
  autoProcessQueue: false,
  uploadMultiple: false,
  maxFiles: 1,
  acceptedFiles: "image/*",
  paramName: "categoryimg",
  dictDefaultMessage: "Click here or drop an image<br/>here for category image.",
  addRemoveLinks: true,
  init: function() {
    const dropzone = this;

    document.getElementById("categoryForm").addEventListener("submit", function(e) {
      e.preventDefault();

      const name = document.getElementById("categoryname").value.trim();
      if (!name) {
        // alert("Enter category name");
        showNotification("Enter category name", "error");

        return;
      }

      if (dropzone.getAcceptedFiles().length === 0) {
        // alert("Please select an image");
        showNotification("Please select an image", 'error');
        return;
      }

      dropzone.options.params = {
        categoryname: name
      };
      dropzone.processQueue();
    });

    dropzone.on("success", function(file, response) {
      // Parse response if it's a string
      if (typeof response === "string") {
        response = JSON.parse(response);
      }
    
      if (response.status === "success") {
        const categoryName = document.getElementById("categoryname").value;
    
        showNotification(response.message, 'success');
        dropzone.removeAllFiles();
        document.getElementById("categoryForm").reset();
    
        // Hide "no category yet" row
        let emptyRow = $(".empty");
        if (emptyRow.is(":visible")) {
          emptyRow.fadeOut(300, function () {
            $(this).remove();
          });
        }
    
        $('#categoryTableBody').prepend(
          `<tr id="category-${response.category_id}">
            <td>${categoryName}</td>
            <td>0</td>
            <td class="dropdown">
              <img src="assets/img/icons/more_horiz.png" alt="" width="50%">
              <div class="dropdown-content">
                <a data-toggle="modal" data-target="#edit-${response.category_id}">Edit Category</a>
                <a class="copyButton" data-info="Category ${categoryName} link copied" data-link="${response.category_id}">Copy Category link</a>
                <a data-toggle="modal" data-target="#delete-${response.category_id}">Delete</a>
              </div>
            </td>
          </tr>`
        );
    
        $('#modalTableBody').prepend(
          `<div class="modal fade" id="delete-${response.category_id}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h2 class="modal-title h4">Delete Category</h2>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="assets/img/icons/close.png" alt="close" width="30%">
                  </button>
                </div>
                <div class="modal-body p-4">
                  <p class="text-dark">Are you sure you want to delete the category "<span class="fw-600">${categoryName}</span>"? This process is irreversible.</p>
                  <p class="text-dark">The products currently listed under the category "<span class="fw-600">${categoryName}</span>" will still be available.</p>
                  <ul class="row gx-4 mt-4">
                    <li class="col-12">
                      <a href="#" class="button -red-1 w-100 button -md -deep-green-1 text-white delete-category-btn" data-categoryid="${response.category_id}">Delete Category</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>`
        );
    
        // Close the modal after a delay
        setTimeout(() => {
          $('#modal-categories').modal('hide');
        }, 500);
    
      } else {
        showNotification(response.message || "Something went wrong", "error");
      }
    });

    
//     dropzone.on("success", function(file, response) {
//       // alert("Upload successful!");
//       showNotification("Upload successful!", 'success');
//       dropzone.removeAllFiles();
//       document.getElementById("categoryForm").reset();

//       // Append new category to the table only if the category was created successfully
//       let emptyRow = $(".empty");
//       if (emptyRow.is(":visible")) {
//           emptyRow.fadeOut(300, function () {
//               $(this).remove();
//           });
//       }
//       $('#categoryTableBody').prepend(
//           `<tr id="category-` + response.category_id + `">
//               <td>` + categoryName + `</td>
//               <td>0</td>
//               <td class="dropdown">
//                   <img src="assets/img/icons/more_horiz.png" alt="" width="50%">
//                   <div class="dropdown-content">
//                       <a data-toggle="modal" data-target="#edit-` + response.category_id + `">Edit Category</a>
//                       <a class="copyButton" data-info="Category `+ categoryName + ` link copied" data-link="` + response.category_id + `" >Copy Category link</a>
//                       <a data-toggle="modal" data-target="#delete-`+ response.category_id + `">Delete</a>
//                   </div>
//               </td>
//           </tr>




// `
//       );

//       $('#modalTableBody').prepend(
//           `                        

//           <div class="modal fade" id="delete-`+ response.category_id + `" tabindex="-1">
//               <div class="modal-dialog modal-dialog-centered">
//                   <div class="modal-content">
//                       <div class="modal-header">
//                       <!-- <h5 class="modal-title"></h5> -->
//                       <h2 class="modal-title h4">Delete Category/h2>
//                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
//                           <img src="assets/img/icons/close.png" alt="close" width="30%">
//                       </button>
//                       </div>
//                       <div class="modal-body p-4">
//                           <p class="text-dark">Are you sure you want to delete the category "<span class="fw-600">`+ categoryName + `</span>". This process is irreversible.</p>
//                           <p class="text-dark">The products currently listed under the category "<span class="fw-600">`+ categoryName + `</span>" will still be available.</p>
//                           <ul class="row gx-4 mt-4">
//                               <li class="col-12">
//                               <a href="#" class="button -red-1 w-100 button -md -deep-green-1 text-white delete-category-btn" data-categoryid="`+ response.category_id + `">Delete Category</a>
//                               </li>
//                           </ul>
//                       </div>
//                   </div>
//               </div>
//           </div>

// `
//       );

//       setTimeout(function () {
//           document.getElementById("categoryForm").reset(); // Resets the entire form, including the input field
//           $('#modal-categories').modal('hide');
//       }, 3000); // 3000 milliseconds = 3 seconds
//     });

    dropzone.on("error", function(file, message) {
      // alert("Error: " + message);
      showNotification(message, 'error');
    });
  }
});


// Dropzone.autoDiscover = false;

// document.querySelectorAll(".dropzoneEdit").forEach(function(el) {
//   const categoryId = el.id.replace("dropzoneEdit-", "");
//   const form = document.getElementById("editForm-" + categoryId);
//   const input = document.getElementById("categoryname-" + categoryId);

//   const myDropzone = new Dropzone(el, {
//     url: "inc/editcategory.php",
//     autoProcessQueue: false,
//     maxFiles: 1,
//     acceptedFiles: "image/*",
//     uploadMultiple: false,
//     paramName: "categoryimg",
//     addRemoveLinks: true,
//     dictDefaultMessage: "Click or drop an image here to update category image.",

//     init: function () {
//       const dz = this;

//       form.addEventListener("submit", function (e) {
//         e.preventDefault();

//         const name = input.value.trim();

//         if (!name) {
//           showNotification("Please enter a category name", "error");
//           return;
//         }

//         dz.options.params = {
//           categoryname: name,
//           categoryid: categoryId,
//           action: "edit"
//         };

//         if (dz.getAcceptedFiles().length > 0) {
//           dz.processQueue();
//         } else {
//           updateCategoryWithoutImage(categoryId, name);
//         }
//       });

//       dz.on("success", function (file, response) {
//         if (typeof response === "string") response = JSON.parse(response);
//         if (response.status === "success") {
//           showNotification(response.message, "success");
//           dz.removeAllFiles();
//           $("#edit-" + categoryId).modal("hide");
//         } else {
//           showNotification(response.message || "Update failed", "error");
//         }
//       });

//       dz.on("error", function (file, message) {
//         showNotification(message, "error");
//       });
//     }
//   });
// });


// function updateCategoryWithoutImage(categoryId, name) {
//   $.ajax({
//     url: "inc/editcategory.php",
//     type: "POST",
//     data: {
//       categoryid: categoryId,
//       categoryname: name,
//       action: "edit"
//     },
//     success: function(response) {
//       try {
//         const response = JSON.parse(response);
//         if (response.status === "success") {
//           showNotification(response.message, 'success');
//           $("#edit-" + categoryId).modal("hide");
//         } else {
//           showNotification(response.message || "Something went wrong", "error");
//         }
//       } catch (e) {
//         showNotification("Unexpected server response", "error");
//       }
//     },
//     error: function() {
//       showNotification("Network error while updating category", "error");
//     }
//   });
// }


Dropzone.autoDiscover = false;

document.querySelectorAll(".dropzoneEdit").forEach(function(el) {
  const categoryId = el.id.replace("dropzoneEdit-", "");
  const form = document.getElementById("editForm-" + categoryId);
  const input = document.getElementById("categoryname-" + categoryId);

  const myDropzone = new Dropzone(el, {
    url: "inc/editcategory.php",
    autoProcessQueue: false,
    maxFiles: 1,
    acceptedFiles: "image/*",
    uploadMultiple: false,
    paramName: "categoryimg",
    addRemoveLinks: true,
    dictDefaultMessage: "Click or drop an image here to update category image.",

    init: function () {
      const dz = this;

      form.addEventListener("submit", function (e) {
        e.preventDefault();

        const name = input.value.trim();

        if (!name) {
          showNotification("Please enter a category name", "error");
          return;
        }

        dz.options.params = {
          categoryname: name,
          categoryid: categoryId,
          action: "edit"
        };

        if (dz.getAcceptedFiles().length > 0) {
          dz.processQueue();
        } else {
          updateCategoryWithoutImage(categoryId, name);
        }
      });

      dz.on("success", function (file, response) {
        if (typeof response === "string") response = JSON.parse(response);
        if (response.status === "success") {
          showNotification(response.message, "success");
          document.querySelector(".name-" + categoryId).textContent = dz.options.params.categoryname;
          dz.removeAllFiles();
          $("#edit-" + categoryId).modal("hide");
        } else {
          showNotification(response.message || "Update failed", "error");
        }
      });

      dz.on("error", function (file, message) {
        showNotification(message, "error");
      });
    }
  });
});

function updateCategoryWithoutImage(categoryId, name) {
  $.ajax({
    url: "inc/editcategory.php",
    type: "POST",
    data: {
      categoryid: categoryId,
      categoryname: name,
      action: "edit"
    },
    success: function(response) {
      if (response.status === "success") {
        showNotification(response.message, 'success');
        document.querySelector(".name-" + categoryId).textContent = name;
        $("#edit-" + categoryId).modal("hide");
      } else if (response.status == 'info') {
        showNotification(response.message, 'info'); // Yellow notification
      } else if (response.status == 'error') {
        showNotification(response.message, 'error'); // Red notification
      } else {
        showNotification(response.message || "Something went wrong", "error");
      }
    
    },
    error: function() {
      showNotification("Network error while updating category", "error");
    }
  });
}


// const d3z = new Dropzone("#dropzoneEdit", {
//   url: "inc/category.php", // This is where your image goes
//   autoProcessQueue: false,
//   uploadMultiple: false,
//   maxFiles: 1,
//   acceptedFiles: "image/*",
//   paramName: "categoryimg",
//   dictDefaultMessage: "Click here or drop an image<br/>here for category image.",
//   addRemoveLinks: true,
//   init: function() {
//     const dropzone = this;

//     document.getElementById("categoryForm").addEventListener("submit", function(e) {
//       e.preventDefault();

//       const name = document.getElementById("categoryname").value.trim();
//       if (!name) {
//         // alert("Enter category name");
//         showNotification("Enter category name", "error");

//         return;
//       }

//       if (dropzone.getAcceptedFiles().length === 0) {
//         // alert("Please select an image");
//         showNotification("Please select an image", 'error');
//         return;
//       }

//       dropzone.options.params = {
//         categoryname: name
//       };
//       dropzone.processQueue();
//     });

//     dropzone.on("success", function(file, response) {
//       // Parse response if it's a string
//       if (typeof response === "string") {
//         response = JSON.parse(response);
//       }
    
//       if (response.status === "success") {
//         const categoryName = document.getElementById("categoryname").value;
    
//         showNotification(response.message, 'success');
//         dropzone.removeAllFiles();
//         document.getElementById("categoryForm").reset();
    
//         // Hide "no category yet" row
//         let emptyRow = $(".empty");
//         if (emptyRow.is(":visible")) {
//           emptyRow.fadeOut(300, function () {
//             $(this).remove();
//           });
//         }
    
//         $('#categoryTableBody').prepend(
//           `<tr id="category-${response.category_id}">
//             <td>${categoryName}</td>
//             <td>0</td>
//             <td class="dropdown">
//               <img src="assets/img/icons/more_horiz.png" alt="" width="50%">
//               <div class="dropdown-content">
//                 <a data-toggle="modal" data-target="#edit-${response.category_id}">Edit Category</a>
//                 <a class="copyButton" data-info="Category ${categoryName} link copied" data-link="${response.category_id}">Copy Category link</a>
//                 <a data-toggle="modal" data-target="#delete-${response.category_id}">Delete</a>
//               </div>
//             </td>
//           </tr>`
//         );
    
//         $('#modalTableBody').prepend(
//           `<div class="modal fade" id="delete-${response.category_id}" tabindex="-1">
//             <div class="modal-dialog modal-dialog-centered">
//               <div class="modal-content">
//                 <div class="modal-header">
//                   <h2 class="modal-title h4">Delete Category</h2>
//                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
//                     <img src="assets/img/icons/close.png" alt="close" width="30%">
//                   </button>
//                 </div>
//                 <div class="modal-body p-4">
//                   <p class="text-dark">Are you sure you want to delete the category "<span class="fw-600">${categoryName}</span>"? This process is irreversible.</p>
//                   <p class="text-dark">The products currently listed under the category "<span class="fw-600">${categoryName}</span>" will still be available.</p>
//                   <ul class="row gx-4 mt-4">
//                     <li class="col-12">
//                       <a href="#" class="button -red-1 w-100 button -md -deep-green-1 text-white delete-category-btn" data-categoryid="${response.category_id}">Delete Category</a>
//                     </li>
//                   </ul>
//                 </div>
//               </div>
//             </div>
//           </div>`
//         );
    
//         // Close the modal after a delay
//         setTimeout(() => {
//           $('#modal-categories').modal('hide');
//         }, 500);
    
//       } else {
//         showNotification(response.message || "Something went wrong", "error");
//       }
//     });

  
//     dropzone.on("error", function(file, message) {
//       // alert("Error: " + message);
//       showNotification(message, 'error');
//     });
//   }
// });