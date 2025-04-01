// document.addEventListener("DOMContentLoaded", function () {
//     document.querySelector(".toggle-product-cart").addEventListener("click", function (event) {
//         event.preventDefault();

//         let form = document.getElementById("productpageForm");
//         let productId = form.dataset.productId;
//         let name = form.dataset.name;
//         let price = form.dataset.price;
//         let discountedPrice = form.dataset.discountedPrice;
//         let image = form.dataset.image;
//         let quantity = parseInt(document.querySelector(".input-counter__counter").value, 10) || 1;
//         let size = ""; // You can update this logic if there's a size selection

//         let cartItem = {
//             cart_id: `cart-${Math.random().toString(36).substr(2, 9)}`,
//             product_id: productId,
//             name: name,
//             price: price,
//             discountedPrice: discountedPrice,
//             image: image,
//             quantity: quantity,
//             size: size
//         };


//         let cart = JSON.parse(localStorage.getItem("olnee_cart")) || [];

//         let existingItemIndex = cart.findIndex(item => item.product_id === productId);
//         if (existingItemIndex !== -1) {
//             cart[existingItemIndex].quantity += quantity;
//         } else {
//             cart.push(cartItem);
//         }

//         localStorage.setItem("cart", JSON.stringify(cart));
//         alert("Item added to cart!"); // You can replace this with your notification system
//     });
// });


// document.addEventListener("DOMContentLoaded", function () {
//     document.addEventListener("click", function (e) {
//         if (e.target.closest(".toggle-product-cart")) {
//             e.preventDefault();
            
//             let button = e.target.closest(".toggle-product-cart");
//             let productForm = button.closest("div");
//             let setCartId = localStorage.getItem("olnee_cart_id");
//             let productId = productForm.dataset.productId;
//             let productName = productForm.dataset.name;
//             let productPrice = productForm.dataset.price;
//             let productImage = productForm.dataset.image;
//             let discountedPrice = productForm.dataset.discountedPrice || productPrice;
            
//             // Get selected size and quantity
//             let selectedSize = productForm.querySelector(".tf-select option:checked")?.textContent || "";
//             let selectedQuantity = parseInt(productForm.querySelector("input[name='quantity']")?.value) || 1;
            
//             let cart = JSON.parse(localStorage.getItem("olnee_cart")) || [];
//             let existingProduct = cart.find(item => item.product_id === productId);
            
//             if (existingProduct) {
//                 // Remove product if it is already in the cart
//                 cart = cart.filter(product => product.product_id !== productId);
//                 showNotification("Product removed from cart", "error");
//                 updateButton(button, "Add to Cart");
//             } else {
//                 // Add product if it is not in the cart
//                 cart.push({
//                     cart_id: setCartId,
//                     product_id: productId,
//                     name: productName,
//                     price: productPrice,
//                     discountedPrice: discountedPrice,
//                     image: productImage,
//                     quantity: selectedQuantity,
//                     size: selectedSize
//                 });
//                 showNotification("Product added to cart");
//                 updateButton(button, "Remove from Cart");
//             }
            
//             // Save the updated cart to local storage
//             localStorage.setItem("olnee_cart", JSON.stringify(cart));
//             updateCartItemCount(); // Ensure this is called after the cart is updated
//             displayCartItems();
//             updateQuickAddButtons(); // Run when the page loads
//             updateCartTotal();
//         }
//     });
// });


document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("click", function (e) {
        if (e.target.closest(".toggle-product-cart")) {
            e.preventDefault();
            
            let button = e.target.closest(".toggle-product-cart");
            let productForm = button.closest("#productpageForm"); // Fix dataset reference
            
            let setCartId = localStorage.getItem("olnee_cart_id") || `cart-${Math.random().toString(36).substr(2, 9)}`; // Generate if not set
            let productId = productForm.dataset.productId;
            let productName = productForm.dataset.name;
            let productPrice = productForm.dataset.price;
            let productImage = productForm.dataset.image;
            let discountedPrice = productForm.dataset.discountedPrice || productPrice;
            
            // Get selected size and quantity
            let selectedSize = productForm.querySelector(".tf-select option:checked")?.textContent || "";
            let selectedQuantity = parseInt(productForm.querySelector("input[name='quantity']")?.value) || 1;
            
            let cart = JSON.parse(localStorage.getItem("olnee_cart")) || [];
            let existingProduct = cart.find(item => item.product_id === productId);
            
            if (existingProduct) {
                // Remove product if it is already in the cart
                cart = cart.filter(product => product.product_id !== productId);
                showNotification("Product removed from cart", "error");
                updateButton(button, "Add to Cart");
            } else {
                // Add product if it is not in the cart
                cart.push({
                    cart_id: setCartId,
                    product_id: productId,
                    name: productName,
                    price: productPrice,
                    discountedPrice: discountedPrice,
                    image: productImage,
                    quantity: selectedQuantity,
                    size: selectedSize
                });
                showNotification("Product addedd to cart");
                updateButton(button, "Remove from Cart");
            }
            
            // Save the updated cart to local storage
            localStorage.setItem("olnee_cart", JSON.stringify(cart));
            updateCartItemCount(); // Ensure this is called after the cart is updated
            displayCartItems();
            updateQuickAddButtons(); // Run when the page loads
            updateCartTotal();
        }
    });
});
