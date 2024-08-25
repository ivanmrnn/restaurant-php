// Displays the cart when cart button is clicked
document.querySelector('.cart-button').onclick = () => {
    document.getElementById('cart-modal').style.display = 'flex';
}
// Selects the text inside the cart button and set it to the total calculated sum of items in the cart
function updateCartCount() {
    document.querySelector('.cart-button strong').textContent = Object.values(cart).reduce((sum, item) => sum + item.quantity, 0);
}

