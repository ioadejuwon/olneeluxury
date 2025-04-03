
$(document).ready(function () {
    // console.log('jQuery is loaded');
    // Add category to the Database begin
    $('#categoryForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission
        console.log("You clicked add category button");

        var categoryName = $('input[name="categoryname"]').val();

        $.ajax({
            type: 'POST',
            url: 'inc/category.php', // The URL to the PHP script that handles the form submission
            data: {
                categoryname: categoryName
            },
            dataType: 'json', // Expect JSON response
            success: function (response) {
                // $('#error-message').html(response.message);
                showNotification(response.message);
                // showNotification(response.category_id);

                if (response.status === 'success') {
                    // Append new category to the table only if the category was created successfully
                    let emptyRow = $(".empty");
                    if (emptyRow.is(":visible")) {
                        emptyRow.fadeOut(300, function () {
                            $(this).remove();
                        });
                    }
                    $('#categoryTableBody').prepend(
                        `<tr id="category-` + response.category_id + `">
                            <td>` + categoryName + `</td>
                            <td>0</td>
                            <td class="dropdown">
                                <img src="assets/img/icons/more_horiz.png" alt="" width="50%">
                                <div class="dropdown-content">
                                    <a data-toggle="modal" data-target="#edit-` + response.category_id + `">Edit Category</a>
                                    <a class="copyButton" data-info="Category `+ categoryName + ` link copied" data-link="` + response.category_id + `" >Copy Category link</a>
                                    <a data-toggle="modal" data-target="#delete-`+ response.category_id + `">Delete</a>
                                </div>
                            </td>
                        </tr>
                        
                        
                       
              
              `
                    );

                    $('#modalTableBody').prepend(
                        `                        
                        
                        <div class="modal fade" id="delete-`+ response.category_id + `" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <!-- <h5 class="modal-title"></h5> -->
                                    <h2 class="modal-title h4">Delete Category/h2>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <p class="text-dark">Are you sure you want to delete the category "<span class="fw-600">`+ categoryName + `</span>". This process is irreversible.</p>
                                        <p class="text-dark">The products currently listed under the category "<span class="fw-600">`+ categoryName + `</span>" will still be available.</p>
                                        <ul class="row gx-4 mt-4">
                                            <li class="col-12">
                                            <a href="#" class="button -red-1 w-100 button -md -deep-green-1 text-white delete-category-btn" data-categoryid="`+ response.category_id + `">Delete Category</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
              
              `
                    );

                    setTimeout(function () {
                        document.getElementById("categoryForm").reset(); // Resets the entire form, including the input field
                        $('#modal-categories').modal('hide');
                    }, 3000); // 3000 milliseconds = 3 seconds
                }
            },
            error: function (xhr, status, error) {
                // $('#error-message').html('An error occurred: ' + xhr.responseText);
                showNotification('An error occurred: ' + xhr.responseText);
                setTimeout(function () {
                    $('#error-message').html('');
                }, 3000); // 3000 milliseconds = 3 seconds
            }
        });
    });
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

