// Sign Up and Login show password
function Pass() {
    var x = document.getElementById("loginPassword");
    var passwordeyeicon = document.getElementById("loginPasswordicon");
    if (x.type === "password") {
        x.type = "text";
        passwordeyeicon.innerHTML = "<i class='fa-regular fa-eye'></i>";
    } else {
        x.type = "password";
        passwordeyeicon.innerHTML = "<i class='fa-regular fa-eye-slash'></i>";
    }
}

function confirmPass() {
    var confirmPassword = document.getElementById("confirmPassword");
    var confirmpasswordeyeicon = document.getElementById("confirmPasswordicon");
    if (confirmPassword.type === "password") {
        confirmPassword.type = "text";
        confirmpasswordeyeicon.innerHTML = "<i class='fa-regular fa-eye'></i>";
    } else {
        confirmPassword.type = "password";
        confirmpasswordeyeicon.innerHTML = "<i class='fa-regular fa-eye-slash'></i>";
    }
}



// Function to toggle password visibility
function togglePasswordVisibility(inputId, iconId) {
    var input = document.getElementById(inputId);
    var icon = document.getElementById(iconId);

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
}



// document.addEventListener('DOMContentLoaded', function() {
//     // console.log('Script loaded.');

//     var currentUrl = window.location.href;
//     // console.log('Current URL:', currentUrl);

//     var sidebarLinks = document.querySelectorAll('.sidebar__item a');
//     // console.log('Sidebar links:', sidebarLinks);

//     sidebarLinks.forEach(function(link) {
//         // console.log('Link HREF:', link.href);
//         if (link.href === currentUrl) {
//             // console.log('Match found:', link.href);
//             link.parentElement.classList.add('-is-active');
//         }
//     });
//   });

document.addEventListener('DOMContentLoaded', function () {
    var currentUrl = window.location.href;
    var currentPathname = new URL(currentUrl).pathname;

    // Extract the base domain and path dynamically
    var baseUrl = new URL(currentUrl).origin; // Gets the protocol + domain
    var basePath = new URL(currentUrl).pathname.replace(/\/[^\/]*$/, '/'); // Extracts the base path

    // console.log('Base URL:', baseUrl);
    // console.log('Base Path:', basePath);
    // console.log('Current Pathname:', currentPathname);

    var sidebarLinks = document.querySelectorAll('.sidebar__item a');
    // console.log('Sidebar links:', sidebarLinks);

    sidebarLinks.forEach(function (link) {
        var linkHref = new URL(link.href).pathname;
        // console.log('Link Href:', linkHref);

        // Ensure base path is removed from paths for comparison
        var relativeLinkHref = linkHref.replace(basePath, '');
        var relativeCurrentPathname = currentPathname.replace(basePath, '');

        // Check if the current path is within the section or matches the link
        if (relativeCurrentPathname === relativeLinkHref ||
            (relativeLinkHref === 'orders' && relativeCurrentPathname.startsWith('order')) ||
            (relativeLinkHref === 'product' && (relativeCurrentPathname.startsWith('image') || relativeCurrentPathname.startsWith('thumbnail'))) ||
            (relativeLinkHref === 'product' && (relativeCurrentPathname.startsWith('edit') || relativeCurrentPathname.startsWith('create')))
        ) {
            link.parentElement.classList.add('-is-active');
        }
    });
});



// $(document).on('click', function (event) {
//     // Check if the click is outside the dropdown and button
//     if (!$(event.target).closest('.cart-dropdown, [data-toggle-target=".cart-dropdown"]').length) {
//         $('.cart-dropdown').hide();
//     }
// });

// // Toggle the cart dropdown when clicking the button
// $('[data-toggle-target=".cart-dropdown"]').on('click', function (event) {
//     event.stopPropagation(); // Prevents click from reaching the document
//     $('.cart-dropdown').toggle();
// });




// $(document).on('click', function (event) {
//     // Check if the click is outside the dropdown and button
//     if (!$(event.target).closest('#cart-dropdown, .cart-toggle-btn').length) {
//         $('#cart-dropdown').hide();
//     }
// });

// // Toggle the cart dropdown when clicking the button
// $('.cart-toggle-btn').on('click', function (event) {
//     event.stopPropagation(); // Prevents click from reaching the document
//     $('#cart-dropdown').toggle();
// });

// // Prevent clicks inside the dropdown from closing it
// $('#cart-dropdown').on('click', function (event) {
//     event.stopPropagation(); // Stops event from bubbling up to document
// });



$(document).on('click', function (event) {
    // Check if the click is outside the dropdown and button
    if (!$(event.target).closest('.cart-dropdown, .cart-toggle-btn').length) {
        $('.cart-dropdown').hide();
    }
});

// Toggle the cart dropdown when clicking the button
$('.cart-toggle-btn').on('click', function (event) {
    event.stopPropagation(); // Prevents click from reaching the document
    $('.cart-dropdown').toggle();
});

// Prevent clicks inside the dropdown from closing it
$('.cart-dropdown').on('click', function (event) {
    event.stopPropagation(); // Stops event from bubbling up to document
});







$(document).on("click", ".toggle_button", function (event) {
    event.stopPropagation(); // Prevents the click from bubbling up and closing immediately

    let classes = $(this).attr("class"); // Get button classes
    let match = classes.match(/toggle-btn-([A-Za-z0-9-]+)/); // Match product IDs with letters, numbers, and dashes

    if (!match) {
        console.error("Product ID not found in class:", classes);
        return;
    }

    let productId = match[1]; // Extract product ID
    let dropdown = $("#dropdown-" + productId);

    if (dropdown.length === 0) {
        console.error("Dropdown not found for product ID:", productId);
        return;
    }

    // Hide all other dropdowns first
    $(".dropdown-main-content").not(dropdown).hide();

    // Toggle the clicked dropdown
    dropdown.toggle();
});

// **Fix: Use `mousedown` instead of `click` to prevent early closing**
$(document).on("mousedown", function (event) {
    if (!$(event.target).closest(".dropdown-main-content, .toggle_button").length) {
        $(".dropdown-main-content").hide();
    }
});


// Function to toggle dropdown visibility
function toggleDropdown() {
    var dropdownContent = document.getElementById("orderDropdown");
    if (dropdownContent.style.display === "none" || dropdownContent.style.display === "") {
        dropdownContent.style.display = "block";
    } else {
        dropdownContent.style.display = "none";
    }
}


function updateOrderStatus(status) {
    // Hide the dropdown after a selection
    $('#orderDropdown').hide();

    // Update the dropdown button text with the selected timeframe
    $('#dropdownTitle').text(status.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase())); // Formats timeframe text

    // Retrieve the unique_id from the data attribute
    // const userId = $('[data-user-id]').data('user-id');

    const orderID = $('[data-order-id]').data('order-id');

    // Send an AJAX request using jQuery
    $.ajax({
        url: 'inc/updateorderstatus.php',
        type: 'GET',
        data: {
            status: status,
            orderid: orderID
        },
        dataType: 'json',
        success: function (response) {
            // Update the store visits


            if (response.status === 'success') {
                showNotification(response.message, 'success');
                $('#orderStatusText').text(response.order_status);
            
                console.log('Status level '+response.order_status_level);
                // Force flex display for "Payment Failed"
                if (Number(response.order_status_level) === 0) {
                    $('#paymentFailedStep').css('display', 'flex');
                } else {
                    $('#paymentFailedStep').hide();
                }
            
                // Clear all steps first
                for (let i = 1; i <= 4; i++) {
                    $('#step' + i).removeClass('bg-deep-green-1 text-white');
                }
            
                // Add classes to completed steps
                for (let i = 1; i <= Number(response.order_status_level); i++) {
                    $('#step' + i).addClass('bg-deep-green-1 text-white');
                }
            
                // Optional: re-render feather icons
                // feather.replace();
            }
            else if (response.status == 'info') {
                showNotification(response.message, 'info'); // Yellow notification
            } else if (response.status == 'error') {
                showNotification('kkk ' + response.message, 'error'); // Red notification
            } else {
                showNotification('kkddsk ' + response.message, 'error');
            }

        },
        error: function () {
            console.error('Failed to fetch filtered data');
        }
    });
}





$(document).on("click", ".order_update", function (event) {
    event.stopPropagation(); // Prevents the click from bubbling up and closing immediately

    let classes = $(this).attr("class"); // Get button classes
    let match = classes.match(/toggle-btn-([A-Za-z0-9-]+)/); // Match product IDs with letters, numbers, and dashes

    if (!match) {
        console.error("Product ID not found in class:", classes);
        return;
    }

    let productId = match[1]; // Extract product ID
    let dropdown = $("#dropdown-" + productId);

    if (dropdown.length === 0) {
        console.error("Dropdown not found for product ID:", productId);
        return;
    }

    // Hide all other dropdowns first
    $(".dropdown-main-content").not(dropdown).hide();

    // Toggle the clicked dropdown
    dropdown.toggle();
});

// **Fix: Use `mousedown` instead of `click` to prevent early closing**
$(document).on("mousedown", function (event) {
    if (!$(event.target).closest(".dropdown-main-content, .order_update").length) {
        $(".dropdown-main-content").hide();
    }
});







function togglefilterDropdown() { // Dashboard filter
    const dropdown = document.getElementById('filterDropdown');
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
}

function fetchFiltered(timeframe) {
    // Hide the dropdown after a selection
    $('#filterDropdown').hide();

    // Update the dropdown button text with the selected timeframe
    $('#dropdownFilter').text(timeframe.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase())); // Formats timeframe text

    // Retrieve the unique_id from the data attribute
    const userId = $('[data-user-id]').data('user-id');

    // Send an AJAX request using jQuery
    $.ajax({
        url: 'inc/filterdashboard.php',
        type: 'GET',
        data: {
            filter: timeframe,
            userid: userId
        },
        dataType: 'json',
        success: function (response) {
            // Update the store visits

            $('#storeVisits').text(response.storeclickstotal);

            if (response.totalAmount === null) {
                $('#totalAmount').text(formatCompactCurrency(0));
            } else {
                $('#totalAmount').text(formatCompactCurrency(response.totalAmount));
            }
            // Update the total amount

            $('#numorders').text(response.numorders);

            // console.log(response.totalAmount);

            // Clear existing product table rows
            $('#productstable tbody').empty();

            // Check if there are no products
            // if (response.products.length === 0) {
            //     $('#noProductsMessage').remove();
            //     $('#productstable').append(
            //         `<tr class="col-md-12 text-center">
            //             <td colspan="4">
            //                 <div class="py-30 bg-light-4 rounded-8 border-light col-md-12 mt-50 mb-50 move-center">
            //                     <img src="assets/img/edit/store.png" style="width:20%">
            //                     <h3 class="px-30 text- fw-500 mt-20 mb-20">
            //                         No products found for the specified period.
            //                     </h3>

            //                     <div class="col-md-6 col-8 move-center">
            //                         <a href="create" class="button -md -deep-green-1 text-white p-0">Add Products</a>
            //                     </div>
            //                 </div>
            //             </td>
            //         </tr>`
            //     );
            // } else {
            //     $('#noProductsMessage').remove();
            //     response.products.forEach(function(product) {
            //         $('#productstable tbody').append(
            //             `<tr>
            //                 <td class="sm:d-none">
            //                     <div class="size-50 rounded-8 brand-pic-display" style="background-image: url('${product.image_path_thumbnail}');"></div>
            //                 </td>
            //                 <td>${product.ptitle}</td>
            //                 <td>${product.pprice}</td>
            //                 <td>${product.orders_count}</td>
            //             </tr>`
            //         );
            //     });
            // }

        },
        error: function () {
            console.error('Failed to fetch filtered data');
        }
    });
}
