// Select all elements with the class 'add-to-cart-button'
document.querySelectorAll('.add-to-cart-button').forEach(button => {
    // Attach an 'onclick' event listener to each button
    button.onclick = () => {
        // Extracts the 'id', 'name', and 'price' data attributes from the button element's dataset and assigns them to variables with the same names
        const { id, name, price } = button.dataset;

        // If the item is already in the cart, use it; otherwise, a new entry is created in the cart object for that item and its quantity is set to 0
        cart[id] = cart[id] || { id, name, price: parseFloat(price), quantity: 0 };
        // Increment one of the item in the cart
        cart[id].quantity++;

        // Update the cart display to reflect the new quantity
        updateCartDisplay();
    };
});


// Short for:
// const id = button.dataset.id;      
// const name = button.dataset.name;  
// const price = button.dataset.price;