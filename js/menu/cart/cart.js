// CART

// Create an editable cart array
let cart = {};

// On page load, update the cart display
window.onload = updateCartDisplay;

// Check if the cart is empty and return a bool value
function isCartEmpty() {
    return Object.keys(cart).length === 0;
}

// Create and return a cart entry as an HTML string
function createCartEntry(id, item) {
    return `
        <div id="cart-item-${id}" class="cart-item flex align-center space-between">
            <span class="cart-item-name">${item.name}</span>
            <div class="flex align-center gap">
                <div class="flex align-center gap">
                    <button class="cart-item-quantity-button minus pointer" data-id="${id}">-</button>
                    <input type="text" inputmode="numeric" pattern="[0-9]*" min="1" value="${item.quantity}" class="cart-item-quantity-input" data-id="${id}">
                    <button class="cart-item-quantity-button plus pointer" data-id="${id}">+</button>
                </div>
                <button class="clear-item-button pointer" data-id="${id}">X</button>
            </div>
        </div>`;
}

// Update the 'Proceed to Checkout' button state based on whether the cart is empty. If empty create a disabled class making the cursor not allowed to click it
function updateProceedToCheckoutButton() {
    const proceedButton = document.querySelector('.proceed-to-checkout-button');
    proceedButton.disabled = isCartEmpty();
    proceedButton.classList.toggle('disabled', isCartEmpty());
}

// Update the cart display by rendering items using the createCartEntry() and update the proceed-to-checkout-button as well as the cart button number in the menu header
function updateCartDisplay() {
    const cartItems = document.getElementById('cart-item-list');
    cartItems.innerHTML = Object.entries(cart).map(([id, item]) => createCartEntry(id, item)).join('');
    
    updateProceedToCheckoutButton();
    updateCartCount();
}

// Event listener for handling button clicks for quantity change, item clear, and checkout
document.addEventListener('click', e => {
    const { target } = e;
    if (target.classList.contains('cart-item-quantity-button')) handleQuantityChange(target);
    if (target.classList.contains('clear-item-button')) handleClearItem(target);
    if (target.classList.contains('proceed-to-checkout-button')) handleProceedToCheckout();
});

// Update cart item quantity or remove the item if the quantity is 0
function updateCartItem(id, quantity) {
    if (quantity > 0) {
        cart[id].quantity = quantity;
    } else {
        delete cart[id];
        document.getElementById(`cart-item-${id}`).remove();
    }
    updateCartCount();
}

// Handle quantity changes when '+' or '-' buttons are clicked
function handleQuantityChange(target) {
    const id = target.dataset.id;
    const input = target.closest('.flex').querySelector('.cart-item-quantity-input');
    const newQuantity = target.classList.contains('plus') ? +input.value + 1 : Math.max(1, +input.value - 1);
    input.value = newQuantity;
    updateCartItem(id, newQuantity);
}

// Handle item removal when the 'X' button is clicked
function handleClearItem(target) {
    const id = target.dataset.id;
    delete cart[id];
    document.getElementById(`cart-item-${id}`).remove();
    updateCartCount();
}

// If cart us not empty, display the checkout container
function handleProceedToCheckout() {
    if (!isCartEmpty()) {
        document.getElementById('cart-modal').style.display = 'none';
        showCheckoutModal();
    }
}

// converts the input value to integer, if input is empty or invalid, default to 1
document.addEventListener('input', e => {
    if (e.target.classList.contains('cart-item-quantity-input')) {
        const id = e.target.dataset.id;
        const newQuantity = parseInt(e.target.value) || 1;
        e.target.value = newQuantity;
        updateCartItem(id, newQuantity);
    }
});


// close current modal when the close button is clicked
document.querySelectorAll('.close-button').forEach(button => {
    button.onclick = () => button.closest('.modal').style.display = 'none';
});

// Close current modal when clicking outside of it
window.onclick = e => {
    if (e.target.classList.contains('modal')) e.target.style.display = 'none';
};

