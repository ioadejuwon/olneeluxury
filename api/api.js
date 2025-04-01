// console.log('api page is loaded');
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




$(document).ready(function() {
   

    $('.copyButton').click(function() {
    // $(document).on('click', '.copyButton', function() {
        let textToCopy = $(this).data('link');
        let info = $(this).data('info');
        let tempInput = $('<input>');
        $('body').append(tempInput);
        tempInput.val(textToCopy).select();
        document.execCommand('copy');
        tempInput.remove();
        // alert('Copied: ' + textToCopy);
        showNotification(info, 'info');
    });
});




// document.addEventListener('DOMContentLoaded', function() {
//     // Initialize Cart
    
//     displayCartItems();
//     displayOrderSummary();
//     updateCartItemCount();

//     // Add Product to Cart Begin
//     document.querySelectorAll('.toggle-cart').forEach(function(button) {
//         console.log('Button initialized');
//         const productId = button.closest('form').dataset.productId;
//         if (isProductInCart(productId)) {
//             updateButton(button);
//         }

//         button.addEventListener('click', function() {
//             const form = this.closest('form');
//             const formData = new FormData(form);
//             const productquantity = parseInt(formData.get('quantity'), 10);
//             const productId = form.dataset.productId;
//             const price = parseInt(form.dataset.price, 10);
//             const image = form.dataset.image;
//             const name = form.dataset.name;
//             const discountedPrice = parseInt(form.dataset.discountedPrice, 10);

//             const product = {
//                 product_id: productId,
//                 name: name,
//                 price: price,
//                 image: image,
//                 discountedPrice: discountedPrice,
//                 quantity: productquantity
//             };

//             addToCart(product, this);
//         });
//     });

//     function addToCart(product, button) {
//         console.log('Adding to cart:', product);
//         let cart = JSON.parse(localStorage.getItem('olnee_cart')) || [];
//         const existingProductIndex = cart.findIndex(item => item.product_id === product.product_id);

//         if (existingProductIndex !== -1) {
//             cart[existingProductIndex].quantity += product.quantity;
//         } else {
//             cart.push(product);
//         }

//         localStorage.setItem('olnee_cart', JSON.stringify(cart));
//         showNotification('Product added to cart');
//         updateButton(button);
//         updateCartItemCount(); // Ensure this is called after the cart is updated
//     }

//     function updateButton(button) {
//         button.textContent = 'Added to Cart';
//         button.classList.add('-deep-green-1'); // Optional: add a class to style the button differently
//         button.classList.add('text-white'); // Optional: add a class to style the button differently
//         button.classList.remove('text-dark-1'); // Optional: remove a class to style the button differently
//         button.classList.remove('-outline-deep-green-1'); // Optional: remove a class to style the button differently
//     }

//     function isProductInCart(productId) {
//         const cart = JSON.parse(localStorage.getItem('olnee_cart')) || [];
//         return cart.some(item => item.product_id === productId);
//     }

    
//     function updateCartItemCount() {
//         const cart = JSON.parse(localStorage.getItem('olnee_cart')) || [];
//         const itemCount = cart.length; // Count the number of unique items in the cart

//         document.querySelector('.cart-item-count').textContent = itemCount;
//         document.querySelector('.cart-item-count-toolbar').textContent = itemCount;

//     }

//     // Display Product in Cart on the Cart Page Begin
//     function displayCartItems() {
//         const cartItemsContainer = document.getElementById('cartItems');
//         if (!cartItemsContainer) return;

//         cartItemsContainer.innerHTML = '';
//         let cart = JSON.parse(localStorage.getItem('olnee_cart')) || [];

//         if (cart.length === 0) {
//             cartItemsContainer.innerHTML = `
//                 <tr>
//                     <td colspan="6" class="text-center">
//                         Your cart is empty!
//                         <br>
//                         Add items from the <a class="text-underline" href="` + shop + `">shop</a> to view them here.
//                     </td>
//                 </tr>
//             `;
//             updateCartTotals(0, 0);
//             return;
//         }

//         let subtotal = 0;

//         cart.forEach(item => {
//             const itemTotal = item.price * item.quantity;
//             subtotal += itemTotal;
//             const formattedPrice = formatCurrency(parseFloat(item.price));
//             const formattedTotalPrice = formatCurrency(itemTotal);
//             const productHTML = `
//                 <tr class="cart-item" data-product-id="${item.product_id}">
//                     <td>
//                         <div style="width: 100px; height: 100px; background-image: url('${item.image}'); background-size: cover; background-position: center; border-radius: 8px;"></div>
//                     </td>
//                     <td>
//                         <div class="fw-500 text-dark-1">${item.name}</div>
//                     </td>
//                     <td>
//                         <p>${formattedPrice}</p>
//                     </td>
//                     <td>
//                         <div class="input-counter">
//                             <button class="input-counter__down" data-product-id="${item.product_id}">
//                                 <i class='fa-solid fa-minus'></i>
//                             </button>
//                             <input type="number" class="input-counter__counter" value="${item.quantity}" min="1" />
//                             <button class="input-counter__up" data-product-id="${item.product_id}">
//                                 <i class='fa-solid fa-plus'></i>
//                             </button>
//                         </div>
//                     </td>
//                     <td>
//                         <p>${formattedTotalPrice}</p>
//                     </td>
//                     <td>
//                         <i class='fa-solid fa-x' data-product-id="${item.product_id}"></i>
//                     </td>
//                 </tr>
//             `;
//             cartItemsContainer.innerHTML += productHTML;
//         });

//         document.querySelectorAll('.input-counter__down').forEach(button => {
//             button.addEventListener('click', function() {
//                 const productId = this.dataset.productId;
//                 updateQuantity(productId, -1);
//             });
//         });

//         document.querySelectorAll('.input-counter__up').forEach(button => {
//             button.addEventListener('click', function() {
//                 const productId = this.dataset.productId;
//                 updateQuantity(productId, 1);
//             });
//         });

//         document.querySelectorAll('.fa-x').forEach(button => {
//             button.addEventListener('click', function() {
//                 const productId = this.dataset.productId;
//                 removeFromCart(productId);
//             });
//         });

//         updateCartTotals(subtotal, subtotal); // Assuming no additional taxes or discounts
//     }

//     function updateQuantity(productId, change) {
//         let cart = JSON.parse(localStorage.getItem('olnee_cart')) || [];
//         const productIndex = cart.findIndex(item => item.product_id === productId);

//         if (productIndex !== -1) {
//             cart[productIndex].quantity += change;

//             if (cart[productIndex].quantity <= 0) {
//                 cart.splice(productIndex, 1);
//             }

//             localStorage.setItem('olnee_cart', JSON.stringify(cart));
//             displayCartItems();
//             updateCartItemCount(); // Ensure the cart item count is updated when quantities change
//         }
//     }

//     function removeFromCart(productId) {
//         let cart = JSON.parse(localStorage.getItem('olnee_cart')) || [];
//         cart = cart.filter(product => product.product_id !== productId);
//         localStorage.setItem('olnee_cart', JSON.stringify(cart));
//         displayCartItems();
//         updateCartItemCount(); // Ensure the cart item count is updated when items are removed
//     }

//     function updateCartTotals(subtotal, total) {
//         document.getElementById('subtotal').innerText = formatCurrency(subtotal);
//         document.getElementById('total-price2').innerText = formatCurrency(total);
//     }

//     function formatCurrency(amount) {
//         return `₦${amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}`;
//     }
//     // Display Product in Cart on the Cart Page End

//     // Display Product in Cart on the Order Page Begin
//     function displayOrderSummary() {
//         const cartItemsContainer = document.getElementById('totalCartItemsContainer');
//         if (!cartItemsContainer) return;

//         let cart = JSON.parse(localStorage.getItem('olnee_cart')) || [];

//         if (cart.length === 0) {
//             cartItemsContainer.innerHTML = '<div class="px-30 py-15">Your cart is empty</div>';
//             updateOrderTotals(0, 0, 0);
//             return;
//         }

//         let subtotal = 0;

//         cartItemsContainer.innerHTML = cart.map(item => {
//             const itemTotal = item.price * item.quantity;
//             subtotal += itemTotal;
//             return `
//                 <div class="d-flex justify-between border-top-dark px-30">
//                     <div class="py-15 text-grey">${item.name} x${item.quantity}</div>
//                     <div class="py-15 text-grey">${formatCurrency(itemTotal)}</div>
//                 </div>
//             `;
//         }).join('');

//         const shipping = calculateShippingCheckout(subtotal);
//         const total = subtotal + shipping;

//         updateOrderTotals(subtotal, shipping, total);
//     }

//     function updateOrderTotals(subtotal, shipping, total) {
//         document.getElementById('subtotal').innerText = formatCurrency(subtotal);
//         document.getElementById('shipping').innerText = formatCurrency(shipping);
//         document.getElementById('total').innerText = formatCurrency(total);
//     }

//     function calculateShippingCheckout(subtotal) {
//         const shippingRate = 1000; // Example flat rate
//         return subtotal > 0 ? shippingRate : 0;
//     }
//     // Display Product in Cart on the Order Page End
// });



