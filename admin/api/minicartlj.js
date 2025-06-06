// ======================== Utility Functions ========================

//Generate UUID
function generateUUID() {
    // Function to generate a UUID (version 4)
    return ('cart' + -1e2 + -4e2).replace(/[018]/g, c =>
        (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
    );
}




function getShippingInfo() {
    return JSON.parse(localStorage.getItem('olnee_shipping')) || { id: '', cost: 0 };
}

function setShippingInfo(id, cost) {
    localStorage.setItem('olnee_shipping', JSON.stringify({ id, cost }));
}

// Get cart items from localStorage
function getCartItems() {
    return JSON.parse(localStorage.getItem('olnee_cart')) || [];
}


// Get coupon_id from localStorage
function getCouponId() {
    return JSON.parse(localStorage.getItem('cartDiscount')) || [];
}


// Get cart ID from localStorage
function getCartId() {
    let cartId = localStorage.getItem('olnee_cart_id');
    if (!cartId) {
        cartId = generateUUID();
        localStorage.setItem('olnee_cart_id', cartId);
    }
    return cartId;
}

// Save cart items to localStorage
function saveCartItems(cartItems) {
    localStorage.setItem('olnee_cart', JSON.stringify(cartItems));
}

// Save cart items to localStorage
function updateCartItemCount() {
    // const cart = JSON.parse(localStorage.getItem('olnee_cart')) || [];
    const cart = getCartItems();
    const itemCount = cart.length; // Count the number of unique items in the cart
    ;
    if ($('.cart-item-count-toolbar').length) document.querySelector('.cart-item-count-toolbar').textContent = itemCount; // Run only on when the class is seen
    if ($('.cart-item-count').length) document.querySelector('.cart-item-count').textContent = itemCount; // Run only on button is seen
}



// ======================== Catalog Page ========================

// Add item to cart
function addToCart(productId) {
    let cartItems = getCartItems(); // Retrieve cart items from localStorage

    // Get product details from the HTML element
    let setCartId = getCartId();
    let productElement = $(`[data-product-id='${productId}']`);
    let productName = productElement.data('name');
    // let productPrice = parseFloat(productElement.data('discounted-price') || productElement.data('price'));
    var productPrice = productElement.data('price');
    let productImage = productElement.data('image');
    var discountedPrice = productElement.data('discounted-price') || productPrice;
    var selectedYards = parseInt(productElement.find('input[name="yards"]').val()) || 1;

    let availableYards = parseInt(productElement.data('available-yards')) || 0; // 👈 assuming you pass this in


    // Check if the item already exists in the cart
    let existingItem = cartItems.find(item => item.product_id === productId);

    if (existingItem) {

        let newTotal = existingItem.yards + selectedYards;
        if (newTotal > availableYards) {
            showNotification(`Only ${availableYards} yards left in stock.`, 'info'); // yellow notification
            return;
        }

        existingItem.yards = newTotal;

        // existingItem.yards += selectedYards; // Increase Yards if item exists
        showNotification('Yards increased.', 'success');
        // Remove product if it is already in the cart
        // cartItems.filter(item => item.product_id !== productId);
        // cartItems = cartItems.filter(item => item.product_id !== productId);
        // showNotification(productName +' removed from cart.', 'error');
        // showNotification('Removed from cart.', 'error');
        // updateButton($button, 'Add to Cart');
    } else {
        // Add new item
        cartItems.push({
            cart_id: setCartId,
            product_id: productId,
            name: productName,
            price: productPrice,
            discountedPrice: discountedPrice,
            image: productImage,
            yards: selectedYards,
        });
        // showNotification(productName + ' added to cart', 'success');
        showNotification('Added to cart.', 'success');
    }
    saveCartItems(cartItems); // Save updated cart items
    updateCartTotal();
    updateCartItemCount();
    displayCartItems();
    displayCartHeader();
    capitalizeEachWordByClass('capitalize-each');

    // updateQuickAddButtons(); // Update button UI
    updateCartButtonText(productId);

}

// Separate function to change button text
function updateCartButtonText(productId) {
    let cartItems = getCartItems();
    let productElement = $(`[data-product-id='${productId}']`);
    let addButton = productElement.find('.add-to-cart-btn');

    let isInCart = cartItems.some(item => item.product_id === productId);

    if (isInCart) {
        addButton.text('Added to Cart').prop('disabled', false);
        addButton.removeClass('-deep-green-1').addClass('-yellow-1');
    } else {
        addButton.text('Add to Cart').prop('disabled', false);
        addButton.removeClass('-yellow-1').addClass('-deep-green-1');
    }
}

// Call this function on page load to set button states correctly
function updateAllCartButtons() {
    let cartItems = getCartItems();
    $('.add-to-cart-btn').each(function () {
        let productId = $(this).closest('[data-product-id]').data('product-id');
        updateCartButtonText(productId);
    });
}

// Update quick add buttons based on cart
function updateQuickAddButtons() {
    let cartItems = getCartItems();

    $('.add-to-cart-btn').each(function () {
        let productId = $(this).data('product-id');
        let inCart = cartItems.some(item => item.product_id == productId);

        if (inCart) {
            $(this).removeClass('-deep-green-1').addClass('-red-1');
            $(this).innerHTML = "Remove from Cart";
            // button.innerHTML = "Remove from Cart";
        } else {
            $(this).removeClass('-red-1').addClass('-deep-green-1');
            // $(this).find('.tooltip').text('Quick Add');
            // button.innerHTML = "Add to Cart";
            $(this).innerHTML = "Add to Cart";
        }
    });
}

// ======================== Cart Display ========================

// Display cart items on the cart page
function displayCartItems() {
    let cartItems = getCartItems();
    var emptyCartMessage = $('.tf-page-cart');
    var emptyCartWrap = $('.tf-page-cart-wrap');
    var emptycouponinputWrap = $('.shopCart-footer');

    let cartContainer = $('#cartItems'); // Ensure this exists on the page

    if (!cartContainer.length) return; // Exit if not on cart page

    cartContainer.empty(); // Clear previous items


    if (cartItems.length === 0) {
        // cartContainer.html('<p>Your cart is empty.</p>');
        emptyCartMessage.show();
        emptyCartWrap.hide();

        // updateCartTotal();
        return;
    } else {
        emptycouponinputWrap.show();
        emptyCartMessage.hide();
        emptyCartWrap.show();
        cartItems.forEach(item => {
            var totalPrice = (item.price * item.yards).toFixed(2);
            cartContainer.append(`
                <tr>
                    <td>
                        <div style="width: 100px; height: 100px; background-image: url('${item.image}'); background-size: cover; background-position: center; border-radius: 8px;"></div>
                    </td>
                    <td class="pt0  md:pt-30">
                        <div class="fw-500 text-dark-1">${item.name}</div>
                    </td>
                    <td  class="pt-40  md:pt-30">
                        <p class="cart-price price">${item.price}</p>
                    </td>
                    <td class="pt0 md:pt-10">
                        <div class="input-counter md:mt-20 js-input-counter">
                            <input class="input-counter__counter" type="number"  name="yards" placeholder="" value="${item.yards}">
                            <div class="input-counter__controls">
                                <button class="btn-quantity btndecrease input-counter__up js-down" onclick="updateYards('${item.product_id}', -1)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus icon">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>

                                <button class="btn-quantity btnincrease input-counter__down js-up" onclick="updateYards('${item.product_id}', 1)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus icon">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td  class="pt-40 md:pt-30">
                        <p class="cart-total price">${totalPrice}</p>
                    </td>
                    <td  class="pt-30 md:pt-30">
                    
                        <button class='remove-cart link remove' onclick="removeCartItem('${item.product_id}')"><img src="admin/assets/img/icons/close.png" alt="close" width="30%"></button>
                    </td>
                </tr>
            `);
        });
    }

    capitalizeEachWordByClass('capitalize-each');
    updateCartTotal();
    formatAllPrices(); // Ensure prices are formatted
}

// Display cart items in the header
function displayCartHeader() {
    let cartItems = getCartItems();
    // let productId = $(this).closest('[data-product-id]').data('product-id');
    var emptyHeaderMessage = $('.tf-page-header');
    var emptyCartWrap = $('.headerCartWrap');
    let headerContainer = $('#headerCart');
    if (!headerContainer.length) return;
    headerContainer.empty(); // Clear previous items

    if (cartItems.length === 0) {
        emptyHeaderMessage.show();
        emptyCartWrap.hide();
        return;
    } else {
        emptyHeaderMessage.hide();
        emptyCartWrap.show();
        cartItems.forEach(item => {
            var itemYards = item.yards;
            if (itemYards > 1) {
                statement = ' Yards';
            } else {
                statement = ' Yards';
            }

            headerContainer.append(`
                <div class="row justify-between x-gap-40 pb-20">
                    <div class="col">
                        <div class="row x-gap-10 y-gap-10 justify-between">
                            <div class="col-2" style="width: 60px; height: 60px; background-image: url('${item.image}'); background-size: cover; background-position: center; border-radius: 8px;">
                            </div>
                            <div class="col-8 pl-5">
                                <div class="text-dark-1 lh-15 h4 fw-500 text-line-clamp-1 mb-0 capitalize-each">${item.name} </div>
                                <div class="d-flex items-center mt-">
                                    <div class="text-18 lh-12 fw-500 text-dark-1"><span class="price">₦${item.price}</span> <span class="text-dark-1 h5">x ${item.yards} ${statement}</span></div>
                                </div>
                            </div>
                    
                            <div class="col-1 text-right">
                                <button class='remove-cart link remove' onclick="removeCartItem('${item.product_id}')">
                                    <img src="admin/assets/img/icons/close.png" alt="close" width="70%" style="min-width: 14px;">
                                </button>
                             

                            </div>
                        </div>
                    </div>
                </div>
                
            `);
        });

    }
    capitalizeEachWordByClass('capitalize-each');
    updateCartTotal();
    formatAllPrices(); // Ensure prices are formatted
}

// document.addEventListener('click', function (e) {
//     console.log('I got here');
//     const removeBtn = e.target.closest('.remove-cart');
//     if (removeBtn) {
//       e.stopPropagation(); // prevent cart dropdown from closing
  
//       const productId = removeBtn.getAttribute('data-product-id');
//       if (productId) {
//         console.log('None');
//         removeCartItem(productId); // this should now work
//       } else {
//         console.warn("Missing data-product-id on .remove-cart button");
//       }
//     }
//   });

// ======================== Checkout Display ========================

// Display cart items on the Checkout page
function displayCheckoutItems() {
    let cartItems = getCartItems();
    var emptyCartMessage = $('.emptyCheckoutCart');
    var emptyCartWrap = $('.tf-page-cart-wrap');
    var checkoutContainer = $('.totalCartItemsContainer');
    if (!checkoutContainer.length) return; // Exit if not on cart page

    checkoutContainer.empty(); // Clear previous items

    if (cartItems.length === 0) {
        emptyCartMessage.show();
        checkoutContainer.hide();
        return;
    } else {
        emptyCartMessage.hide();
        checkoutContainer.show();
        cartItems.forEach(item => {
            var totalPrice = (item.price * item.yards).toFixed(2);
            checkoutContainer.append(`
                <li class="checkout-product-item d-none" data-product-id="${item.product_id}">
                    <figure class="img-product">
                        <img src="${item.image}" alt="${item.name}">
                        <span class="yards">${item.yards}</span>
                    </figure>
                    <div class="content">
                        <div class="info">
                            <p class="name text-line-clamp- capitalize-each">${item.name}</p>
                        </div>
                        <span class="price">₦${totalPrice}</span>
                    </div>
                </li>
                <div class="d-flex justify-between px-30" data-product-id="${item.product_id}">
                    <div class="py-15 text-grey capitalize-each"> ${item.name} x ${item.yards}</div>
                    <div class="py-15 text-grey price">${totalPrice}</div>
                </div>
            `);
        });
    }

    updateCartTotal();
    formatAllPrices(); // Ensure prices are formatted
}


// ======================== Cart Operations ========================

// Remove item from cart
function removeCartItem(productId) {
    let cartItems = getCartItems();
    cartItems = cartItems.filter(item => item.product_id !== productId);

    saveCartItems(cartItems);
    updateCartTotal();
    updateCartItemCount();
    displayCartItems();
    displayCartHeader();
    displayCheckoutItems();
    updateCheckoutTotal();
    updateCartButtonText(productId);
    capitalizeEachWordByClass('capitalize-each');

    showNotification('Product removed from cart.', 'error');
}

// Function to calculate total with discount
function updateCartTotal() {
    let cartItems = getCartItems();
    let subtotal = cartItems.reduce((sum, item) => sum + (parseFloat(item.price) * item.yards), 0);

    // Retrieve stored discount from local storage
    let discountData = JSON.parse(localStorage.getItem("cartDiscount")) || { couponType: "none", couponValue: 0 };
    let discountAmount = 0;

    // Apply discount if valid
    if (discountData.couponType === 1) {
        discountAmount = (discountData.couponValue / 100) * subtotal;
    } else if (discountData.couponType === 2) {
        discountAmount = discountData.couponValue;
    }


    let total = subtotal - discountAmount; // Apply discount

    // Ensure total is not negative
    total = total < 0 ? 0 : total;

    // Format prices
    let formattedSubtotal = formatCurrency(subtotal);
    let formattedDiscount = formatCurrency(discountAmount);
    let formattedTotal = formatCurrency(total);

    // Update UI
    $("#subtotal").text(formattedSubtotal);
    $("#discount").text('-' + formattedDiscount); // Add an element for this
    $("#total-price2, #headerTotal").text(formattedTotal);

    formatAllPrices(); // Ensure all prices are formatted
}


// Update Yards
function updateYards(productId, change) {
    let cartItems = getCartItems();
    cartItems = cartItems.map(item => {
        if (item.product_id === productId) {
            item.yards = Math.max(1, item.yards + change); // Ensure Yards is at least 1
        }
        return item;
    });

    saveCartItems(cartItems);
    updateCartTotal();
    displayCartItems();
    displayCartHeader();
    capitalizeEachWordByClass('capitalize-each');
}

// Apply Coupon
function applyCoupon() {
    let code = document.getElementById("couponCode").value.trim();
    if (code === "") {
        showNotification('Please enter a coupon code.', 'error');
        return;
    }
    $.ajax({
        url: "admin/inc/check_coupon.php",
        method: "POST",
        data: { couponCode: code },
        dataType: "json",
        success: function (response) {
            if (response.status === 'success') {
                // Store discount details in local storage
                localStorage.setItem("cartDiscount", JSON.stringify(response.discount));
                showNotification(response.message, 'success'); // Yellow notification
                // showNotification('Discount Applied: ' + response.discount.couponName, 'success');
                updateCartTotal();
            } else if (response.status == 'info') {
                showNotification(response.message, 'info'); // Yellow notification
            } else if (response.status == 'error') {
                showNotification(response.message, 'error'); // Red notification
            } else {
                showNotification('Invalid or expired coupon.', 'error');
            }
            
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // console.error('Error:', textStatus, errorThrown); // Log any errors
            showNotification('An error occurred while processing your request.', 'error');
        }
    });
}



// ======================== Checkout Operations ========================

// Update checkout total (subtotal + shipping)
function updateCheckoutTotal() {
    let cartItems = getCartItems();
    let subtotal = cartItems.reduce((sum, item) => sum + (parseFloat(item.price) * item.yards), 0);
    let selectedOption = $('select[name="deliverycost"]').find(':selected');
    let shippingCost = parseFloat(selectedOption.attr('data-cost')) || 0;
    let shippingId = selectedOption.val();

    // Save shipping details
    localStorage.setItem('olnee_shipping', JSON.stringify({ id: shippingId, cost: shippingCost }));

    let discountData = JSON.parse(localStorage.getItem("cartDiscount")) || { couponType: "none", couponValue: 0 };
    let discountAmount = 0;

    // Apply discount if valid
    if (discountData.couponType === 1) {
        discountAmount = (discountData.couponValue / 100) * subtotal;
    } else if (discountData.couponType === 2) {
        discountAmount = discountData.couponValue;
    }
    // showNotification (discountData.couponType);
    discountAmount = Math.min(discountAmount, subtotal);

    let total = subtotal - discountAmount + shippingCost; // Apply discount

    total = total < 0 ? 0 : total; // Ensure total is not negative
    // Update UI
    $('#subtotal').text(formatCurrency(subtotal));
    $('#shipping').text(formatCurrency(shippingCost));
    $('#checkout-total').text(formatCurrency(total));
    formatAllPrices(); // Ensure all prices are formatted
}

// Restore shipping selection on checkout page
function restoreShippingSelection() {
    let savedShipping = JSON.parse(localStorage.getItem('olnee_shipping'));
    if (savedShipping && savedShipping.cost) {
        $('select[name="deliverycost"]').val(savedShipping.cost).trigger('change');
    }
}

// Clear the cart after submission for order is successful  
function clearCartAfterPayment() {
    localStorage.removeItem("olnee_cart"); // Remove cart items
    localStorage.removeItem("cartDiscount"); // Remove applied discount
    // localStorage.removeItem("olnee_shipping"); // Remove applied discount
    updateCartTotal(); // Update cart total to reset displayed values
    // Optional: Redirect user or show a success message
    // alert("Payment successful! Your cart has been cleared.");
}

// Function to save customer details to local storage
function saveCustomerDetailsToLocalStorage() {
    var customerDetails = {
        firstName: $('input[name="firstName"]').val(),
        lastName: $('input[name="lastName"]').val(),
        phone: $('input[name="phone"]').val(),
        email: $('input[name="email"]').val(),
        // deliveryCost: $('select[name="deliverycost"]').val(),
        street: $('input[name="street"]').val(),
        city: $('input[name="city"]').val(),
        state: $('input[name="state"]').val(),
        country: $('select[name="country"]').val(),
        delivery: $('select[name="deliverycost"]').val(),
        notes: $('textarea[name="notes"]').val()
    };

    localStorage.setItem('olnee_customerDetails', JSON.stringify(customerDetails));
}

// Function to get customer details and populate form
function getCustomerDetails() {
    var customerDetailsKey = 'olnee_customerDetails';
    var customerDetails = JSON.parse(localStorage.getItem(customerDetailsKey)) || {};

    if (Object.keys(customerDetails).length > 0) {
        $('input[name="firstName"]').val(customerDetails.firstName || '');
        $('input[name="lastName"]').val(customerDetails.lastName || '');
        $('input[name="phone"]').val(customerDetails.phone || '');
        $('input[name="email"]').val(customerDetails.email || '');
        $('input[name="street"]').val(customerDetails.street || '');
        $('input[name="city"]').val(customerDetails.city || '');
        $('input[name="state"]').val(customerDetails.state || '');
        $('select[name="country"]').val(customerDetails.country || '');
        $('textarea[name="notes"]').val(customerDetails.notes || '');
    }
}

function restoreCustomerDetails() {
    let savedShipping = JSON.parse(localStorage.getItem('olnee_shipping'));
    let savedCustomerDetails = JSON.parse(localStorage.getItem('olnee_customerDetails'));
    if (savedCustomerDetails) {
        $('select[name="deliverycost"]').val(savedShipping.cost).trigger('change');
        getCustomerDetails();
    }
}

// Submit form for paymentBegin
$('#checkoutForm').on('submit', function (event) {
    event.preventDefault(); // Prevent the form from submitting the traditional way

    // Retrieve items from localStorage
    var items = getCartItems(); // Ensure it's an array
    var couponID = getCouponId(); // Ensure it's an array
    saveCustomerDetailsToLocalStorage();// Save the customer details to local storage before processing
    // let cartItems = getCartItems();
    const paymentOptionRadio = document.querySelectorAll('input[name="radio"]');

    let selectedOption = '';
    paymentOptionRadio.forEach(option => {
        if (option.checked) {
            selectedOption = option.value;
        }
    });

    // Check if a radio option is selected
    if (!selectedOption) {
        showNotification('Please select a payment option.', 'error');
        return;
    }


    // Serialize form data
    var formData = $(this).serializeArray();

    // Add items from localStorage to formData
    formData.push({ name: 'items', value: JSON.stringify(items) });
    formData.push({ name: 'coupon', value: JSON.stringify(couponID) });
    formData.push({ name: 'subtotal', value: parseFloat(document.getElementById('subtotal').innerText.replace(/[^\d.]/g, '')) });
    formData.push({ name: 'discount', value: parseFloat(document.getElementById('discount').innerText.replace(/[^\d.]/g, '')) });
    formData.push({ name: 'shipping', value: parseFloat(document.getElementById('shipping').innerText.replace(/[^\d.]/g, '')) });
    formData.push({ name: 'checkout-total', value: parseFloat(document.getElementById('checkout-total').innerText.replace(/[^\d.]/g, '')) });
    formData.push({ name: 'paymentOption', value: selectedOption }); // Include payment option in request

    // Convert formData array to an object
    var data = {};
    $.each(formData, function (index, field) {
        data[field.name] = field.value;
    });

    // console.log('Sending data:', data); // Debug message

    $.ajax({
        url: 'admin/inc/pay.php', // Replace with the path to your PHP script
        type: 'POST',
        data: data,
        success: function (response) {
            // console.log('Form Data: ', formData); // Check the data being sent to the server
            // console.log('Response:', response); // Check the response from the server
            if (response.status === 'success') {
                // Redirect to the Flutterwave payment page
                // window.location.href = response.link;
                // localStorage.removeItem('olnee_cart');
                clearCartAfterPayment();
                updateCartItemCount();
                displayCartHeader();
                displayCheckoutItems();
                updateCheckoutTotal();
                window.open(response.link, '_blank');
            } else if (response.status == 'info') {
                showNotification(response.message, 'info'); // Yellow notification
            } else if (response.status == 'error') {
                showNotification(response.message, 'error'); // Red notification
            } else {
                showNotification('Failed to store items. Please try again.', 'error');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // console.error('Error:', textStatus, errorThrown); // Log any errors
            // showNotification('An error occurred while processing your request.', 'error');

            let message = 'An error occurred while processing your request.';
            let status = 'error';

            try {
                const response = JSON.parse(jqXHR.responseText);
                if (response.message) message = response.message;
                if (response.status) status = response.status;
            } catch (e) {
                // Failed to parse JSON, fallback to default
            }

            showNotification(message, status);
        }
    });
});
// Submit form for payment end


// Example usage


// ======================== Event Listeners ========================

// Ensure these functions only run when needed
$(document).ready(function () {
    if ($('#cartItems').length) displayCartItems(); // Run only on cart page
    if ($('#headerCart').length) displayCartHeader(); // Run only on cart page
    if ($('.totalCartItemsContainer').length) displayCheckoutItems(); // Run only on checkout page
    if ($('select[name="deliverycost"]').length) restoreShippingSelection(); // Run only on checkout page
    if ($('#checkoutForm').length) restoreCustomerDetails(); // Run only on checkout page
    $(document).on('change', 'select[name="deliverycost"]', updateCheckoutTotal); // Listen for shipping selection change

    $(document).on('click', '.add-to-cart-btn', function () {
        let productId = $(this).data('product-id'); // Get product ID from button
        addToCart(productId);
    });


    capitalizeEachWordByClass('capitalize-each');
    updateCartTotal();
    updateCheckoutTotal();
    updateCartItemCount();
    // updateQuickAddButtons();
    formatAllPrices(); // Ensure all prices are formatted
    updateAllCartButtons();
});
