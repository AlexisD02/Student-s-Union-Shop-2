/* cart.js */
/* Author: Alexis Demetriou (G20970098) */
/* Email: ADemetriou5@uclan.ac.uk */

checkLocalStorage(); // Call listener function at run time

// Retrieve saved cart data from localStorage
const cartData = JSON.parse(localStorage.getItem('cart')) || [];
let item_number = cartData.length, item_to_remove=0;

// Display each cart item in the HTML
const cartItemsDiv = document.getElementById("cart_container");
cartData.forEach(item => {
    const { product_id, product_title, product_price, product_image } = item;
    cartItemsDiv.innerHTML += "<div class=\"flex-container\"><div class=\"item\">" + item_number + "</div><div class=\"item_image\">" +
        "<img class=\"cart_image\" alt=\"Product_Image\" src=\"" + product_image + "\" ></div><div class=\"item\"><strong>" + product_title + "</strong></div>" +
        "<div class=\"item\">" + product_price + "</div><div class=\"item\"><a href='cart.php' onclick='removeItem(" + item_to_remove + ")'>" + "Remove" + "</a>" +
        "</div></div>";
    item_number--;
    item_to_remove++;
});

function clearBasket() {  // Function for deleting key/value in localStorage
    localStorage.removeItem('cart'); // The removeItem() method removes the specified Storage Object item.
    window.location.href = "cart.php"; // returns the href (URL) of the cart page (refreshes the page)
    checkLocalStorage(); // Call listener function at run time
}

function removeItem(item_to_remove) {  // Function for removing a product in localStorage
    cartData.splice(item_to_remove, 1); // The splice() method removes array element and overwrites the original array.
    localStorage.cart = JSON.stringify(cartData);
    checkLocalStorage(); // Call listener function at run time
}

function checkLocalStorage() { // Function for checking localStorage
    var src = "images/34568.png";
    if (!localStorage.getItem('cart') || localStorage.cart === "[]") { // check if localStorage exists or the key/value
        // of localStorage is empty
        document.getElementById("hide").style.display = "none";
        document.getElementById("empty_container").innerHTML = "<img class='empty_cart_image' alt='Product_Image' src="+src+" >" +
            "<p class='warning_text'>Your cart is currently empty!</p><a href=\"products.php\" id='center_button' class=\"remove_product_cart_button\">Return To Shop</a>";
    }
}

function submitCheckoutForm() {
    const cartDataInput = document.getElementById("cart-data-input");
    cartDataInput.value = JSON.stringify(cartData);

    const checkoutForm = document.getElementById("checkout-form");
    checkoutForm.submit();

    // Clear the cart and display an alert message
    localStorage.removeItem('cart');
}