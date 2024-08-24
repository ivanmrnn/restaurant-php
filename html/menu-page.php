<?php
// Initializes a session or resumes the current one 
session_start();

// Include Database Connection
include("../scripts/connection.php");

// Fetch menu items from the database

// The string $fetchMenuItemsQuery stores an instruction to select all records from the menu table where the status is active
$fetchMenuItemsQuery = "SELECT * FROM menu WHERE status = 1 ORDER BY category, name";

// Executes the query using $conn->query($fetchMenuItemsQuery), storing the result in $menuItems.
$menuItems = $conn->query($fetchMenuItemsQuery);

// Initializes an associative array $menu with keys corresponding to different menu categories. Each key holds an empty array to store menu items.
$menu = array(
    'appetizer' => array(),
    'main-course' => array(),
    'dessert' => array()
);

// Checks if the query returned any rows
if ($menuItems->num_rows > 0) {
    // fetches each row in the menuItems as an associative array and store them to menuItemRow.
    while ($menuItemRow = $menuItems->fetch_assoc()) {
        // Convert the category to lowercase for consistency.
        $menuCategory = strtolower($menuItemRow['category']);
        
        // Check if the category exists in the $menu array.
        if (isset($menu[$menuCategory])) {
            // Append the current menu item row to the array for the corresponding category.
            $menu[$menuCategory][] = $menuItemRow;
        }
    }
}

// Initializes the user discount
$userDiscountPercentage = 0;
// Checks if the user is logged
$isUserLoggedIn = isset($_SESSION['username']);

// If the user is logged in... retrieves their username from the session and queries the users table to get their discount.
if ($isUserLoggedIn) {
    // then retrieve their username from the session
    $sessionUsername = $_SESSION['username'];
    // store an instruction to get the discount information of the user from the database
    $discountQuery = "SELECT discount FROM users WHERE username = '$sessionUsername'";
    // Executes the query, storing the discount.
    $discountItem = $conn->query($discountQuery);
    // If a discount is found for the username, updates $userDiscount with the retrieved value.
    if ($discountItem->num_rows > 0) {
        $discountRow = $discountItem->fetch_assoc();
        $userDiscountPercentage = $discountRow['discount'];
    }
}

// Closes the MySQL database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/menustyles.css">
</head>

<body>
        <!-- Header -->
        <header class="header-container section-container flex justify-center">
            <div class="header section-content flex align-center space-between">
                <div class="header-left flex big-gap align-center">
                    <a href="../index.html" class="pointer">
                        <div class="company-container flex align-center big-gap">
                            <img class="company-image" src="../images/restaurant/edible-logo.png" alt="Company Image">
                            <h1 class="bold capitalize">Edible</h1>
                        </div>
                    </a>
                </div>

                <div class="header-right flex big-gap align-center">
                    <!-- If the user is logged in, display the username and a log-out button-->
                    <?php if (isset($_SESSION['username'])): ?>
                        <span class="bold capitalize text-medium"><?php echo $_SESSION['username']; ?></span>

                        <form action="../scripts/logout.php" method="post" class="logout-form">
                            <button type="submit" class="logout-button" aria-label="Logout">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="#333" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h7v2H5v14h7v2zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z"/>
                                </svg>
                            </button>
                        </form>
                    <!-- If there is no user logged in, display a log-in button -->
                    <?php else: ?>
                        <a href="../html/login-page.php">
                            <button class="login-button">
                                <span class="bold capitalize text-medium">Log In</span>
                            </button>
                        </a>
                    <?php endif; ?>

                    <button class="cart-button basic-shadow flex gap radius" aria-label="Cart Button">
                        <span class="bold text-medium">0</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="white" d="M17 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2M1 2v2h2l3.6 7.59l-1.36 2.45c-.15.28-.24.61-.24.96a2 2 0 0 0 2 2h12v-2H7.42a.25.25 0 0 1-.25-.25q0-.075.03-.12L8.1 13h7.45c.75 0 1.41-.42 1.75-1.03l3.58-6.47c.07-.16.12-.33.12-.5a1 1 0 0 0-1-1H5.21l-.94-2M7 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2"/>
                        </svg>
                    </button>

                </div>
            </div>
        </header>

    <!-- Menu -->
    <main class="menu-container flex column">
        
        <!-- Cart -->
        <div id="cart-modal" class="modal justify-center align-center">
            <div class="modal-content flex column gap">
                <span class="close-button">&times;</span>
                <span class="text-large">Place your order</span>
                <div id="cart-item-list"></div>
                <button class="proceed-to-checkout-button flex justify-center radius basic-shadow">
                    <span class="bold capitalize">Proceed To Checkout</span>
                </button>
            </div>
        </div>

        <!-- Cart Checkout -->
        <div id="checkout-modal" class="modal justify-center align-center">
            <div class="modal-content flex column gap">
                <span class="close-button">&times;</span>
                <span class="text-large">Confirm your order</span>
                <div id="checkout-items"></div>
                <div id="checkout-total"></div>
                <select id="payment-method">
                    <option value="cash">
                        <span class="capitalize">Cash</span>
                    </option>
                    <option value="credit_card">
                        <span class="capitalize">Credit Card</span>
                    </option>
                    <option value="debit_card">
                        <span class="capitalize">Debit Card</span>
                    </option>
                </select>
                <div class="checkout-buttons flex space-between">
                    <button class="cancel-checkout-button radius basic-shadow">
                        <span class="bold capitalize">Cancel</span>
                    </button>
                    <button class="confirm-order-button radius basic-shadow">
                        <span class="bold capitalize">Confirm Order</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Successful Order -->
        <div id="success-modal" class="modal justify-center align-center">
            <div class="modal-content flex column gap">
                <span class="close-button">&times;</span>
                <span class="text-large">Order Placed Successfully!</span>
                <p>Your order has been placed and will be prepared shortly.</p>
            </div>
        </div>

        <!-- Category Tabs -->
        <section class="categories-tab-list flex justify-center basic-shadow">
            <button class="appetizer-button categories-tab active " onclick="showTab('appetizer')">
                <span class="capitalize text-medium">Appetizers</span>
            </button>
            <button class="main-course-button categories-tab" onclick="showTab('main-course')">
                <span class="capitalize text-medium">Main Course</span>
            </button>
            <button class="dessert-button categories-tab" onclick="showTab('dessert')">
                <span class="capitalize text-medium">Desserts</span>
            </button>
        </section>
        
        <!-- Menu items by category -->
        <section class="category section-container flex column justify-center align-center big-gap">
             <!-- Loop through each category in the menu array and assigns it to the categoryMenuItems -->
            <?php foreach ($menu as $category => $categoryMenuItems): ?>
            <!-- Creates a category-container class for the div. Adds 'tab-container-active' class if it's the appetizer category -->
            <div class="<?php echo $category; ?>-container section-content tab-container big-gap space-between <?php echo $category === 'appetizer' ? 'tab-container-active' : ''; ?>">
                <!-- Creates a container for each menu item by iterating through the $categoryMenuItems and storing each item in $categoryMenuitem-->
                <?php foreach ($categoryMenuItems as $categoryMenuitem): ?>
                    <article class="menu-item-container basic-shadow flex justify-center radius">
                        <div class="menu-item flex align-center column big-gap">
                            <!-- Displays the menu item name. htmlspecialchars() converts special characters to HTML -->
                            <span class="menu-item-title bold text-medium"><?php echo htmlspecialchars($categoryMenuitem['name']); ?></span>
                            <div class="menu-item-info flex column space-between">
                                <!-- Displays the description of the menu item -->
                                <p class="menu-item-description"><?php echo htmlspecialchars($categoryMenuitem['description']); ?></p>
                                <div class="menu-items-action-container flex align-center space-between">
                                    <!-- Display the price and rounds it to 2 decimal places -->
                                    <span class="bold text-medium">₱<?php echo number_format($categoryMenuitem['price'], 2); ?></span>
                                    <button class="add-to-cart-button radius basic-shadow" aria-label="Add to cart" data-id="<?php echo $categoryMenuitem['id']; ?>" data-name="<?php echo htmlspecialchars($categoryMenuitem['name']); ?>" data-price="<?php echo $categoryMenuitem['price']; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <path fill="white" d="M17 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2M1 2v2h2l3.6 7.59l-1.36 2.45c-.15.28-.24.61-.24.96a2 2 0 0 0 2 2h12v-2H7.42a.25.25 0 0 1-.25-.25q0-.075.03-.12L8.1 13h7.45c.75 0 1.41-.42 1.75-1.03l3.58-6.47c.07-.16.12-.33.12-.5a1 1 0 0 0-1-1H5.21l-.94-2M7 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
        </section>

    </main>

    <script>
    const discount = <?php echo $userDiscountPercentage; ?>;
    </script>

    <script src="../js/menu/cart/cart.js"></script>
    <script src="../js/menu/cart/checkout.js"></script>
    <script src="../js/menu/menu-tabs.js"></script>
    <script src="../js/menu/menu-list.js"></script>
    <script src="../js/menu/menu-header.js"></script>

</body>
</html>
