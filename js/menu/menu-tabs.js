// Display the active tab whether it's appetizer, main course, or dessert
function showTab(category) {
    // Remove 'active' class from all tabs
    document.querySelectorAll('.categories-tab').forEach(tab => {
        tab.classList.remove('active');
    });

    // Add 'active' class to the clicked tab
    document.querySelector(`.${category}-button`).classList.add('active');

    // Hide all tab containers
    document.querySelectorAll('.tab-container').forEach(container => {
        container.classList.remove('tab-container-active');
    });

    // Show the clicked tab's container
    document.querySelector(`.${category}-container`).classList.add('tab-container-active');
}