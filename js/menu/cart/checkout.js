// CHECKOUT

function showCheckoutModal() {
    const checkoutModal = document.getElementById('checkout-modal');
    const checkoutItems = document.getElementById('checkout-items');
    const checkoutTotal = document.getElementById('checkout-total');
    let total = 0;

    // Generate HTML for each cart item and calculate the total price
    checkoutItems.innerHTML = Object.entries(cart).map(([id, item]) => {
        const quantity = parseInt(document.querySelector(`.cart-item-quantity-input[data-id="${id}"]`).value);
        const itemTotal = item.price * quantity;
        total += itemTotal;
        return `
            <div class="flex space-between">
                <span>${item.name} x ${quantity}</span>
                <span>₱${itemTotal.toFixed(2)}</span>
            </div>`;
    }).join('');// Combine all the HTML strings into one

    const discountedTotal = total * (1 - discount / 100);
    checkoutTotal.innerHTML = `
        <span>Subtotal: ₱${total.toFixed(2)}</span><br>
        <span>Discount: ${discount}%</span><br>
        <span>Total: ₱${discountedTotal.toFixed(2)}</span>`;

    checkoutModal.style.display = 'flex';
}


//when cancel button is clicked, close the checkout modal
document.querySelector('.cancel-checkout-button').addEventListener('click', () => 
    document.getElementById('checkout-modal').style.display = 'none'
);

document.querySelector('.confirm-order-button').addEventListener('click', () => {
    const formData = new FormData();

    // Append cart items to the FormData object as a JSON string
    formData.append('cart_items', JSON.stringify(Object.values(cart)));

    // Append the selected payment method to the FormData
    formData.append('payment_method', document.getElementById('payment-method').value);

     // Calculate the total price of the items in the cart and append it to the FormData
    formData.append('total_price', Object.values(cart).reduce((total, item) => total + (item.price * item.quantity), 0));

    // Send a POST request to the server with the FormData
    fetch('../scripts/order.php', { method: 'POST', body: formData }) 
        .then(response => response.ok && response.json())  // Check if the response is successful and parse it as JSON
        .then(data => {
            if (data && data.success) { // If the response contains a success property that is true
                // Hide the checkout modal
                document.getElementById('checkout-modal').style.display = 'none';

                // Display the success modal
                document.getElementById('success-modal').style.display = 'flex';

                // Clear the cart
                cart = {};

                // Update the cart display for empty cart
                updateCartDisplay();
            }
        });
});