/* item.js */
/* Author: Alexis Demetriou (G20970098) */
/* Email: ADemetriou5@uclan.ac.uk */

function addToCart(product) {
    var cart = JSON.parse(localStorage.getItem('cart') || '[]');
    cart.push(product);
    alert("Your product has been added to the cart!"); // The alert() method displays an alert box with a message and an OK button.
    localStorage.setItem('cart', JSON.stringify(cart));
}