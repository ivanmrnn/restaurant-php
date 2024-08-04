<?php
session_start();
include("../scripts/connection.php");

// Fetch menu items from the database
$sql = "SELECT * FROM menu WHERE status = 1 ORDER BY category, name";
$result = $conn->query($sql);

$menu = array(
    'appetizer' => array(),
    'main-course' => array(),
    'dessert' => array()
);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $category = strtolower($row['category']);
        if (isset($menu[$category])) {
            $menu[$category][] = $row;
        }
    }
}

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
    <div class="menu-container flex column">
        <div class="header-container section-container flex justify-center">
            <div class="header section flex align-center space-between">
                <div class="header-left flex big-gap align-center">
                    <a href="../index.html" class="pointer">
                        <div class="company-container flex align-center big-gap">
                            <img class="company-image" src="../images/edible-logo.png">
                            <h2 class="bold">Edible</h2>
                        </div>
                    </a>
                </div>
                <div class="header-right flex big-gap align-center">
                    <?php if (isset($_SESSION['username'])): ?>
                        <h3 class="bold"><?php echo $_SESSION['username']; ?></h3>

                        <form action="../scripts/logout.php" method="post" class="logout-form">
                            <button type="submit" class="logout-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="#333" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h7v2H5v14h7v2zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z"/>
                                </svg>
                            </button>
                        </form>
                    <?php else: ?>
                        <a href="../html/login-page.php">
                            <button class="login-button">
                                <h3 class="bold">Log In</h3>
                            </button>
                        </a>
                    <?php endif; ?>
                    <button class="cart-quantity-button basic-shadow flex gap radius">
                        <h3 class="bold">0</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="white" d="M17 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2M1 2v2h2l3.6 7.59l-1.36 2.45c-.15.28-.24.61-.24.96a2 2 0 0 0 2 2h12v-2H7.42a.25.25 0 0 1-.25-.25q0-.075.03-.12L8.1 13h7.45c.75 0 1.41-.42 1.75-1.03l3.58-6.47c.07-.16.12-.33.12-.5a1 1 0 0 0-1-1H5.21l-.94-2M7 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="categories-tab-list flex justify-center basic-shadow" id="categories-tab-list">
            <button class="appetizer-button categories-tab tab_active" onclick="showTab('appetizer')">
                <h3 class="bold">Appetizers</h3>
            </button>
            <button class="main-course-button categories-tab" onclick="showTab('main-course')">
                <h3>Main Course</h3>
            </button>
            <button class="dessert-button categories-tab" onclick="showTab('dessert')">
                <h3>Desserts</h3>
            </button>
        </div>
        
        <div class="category section-container flex column justify-center align-center big-gap">
            <?php foreach ($menu as $category => $items): ?>
            <div class="<?php echo $category; ?>-container section tab-container big-gap space-between <?php echo $category === 'appetizer' ? 'tab-container-active' : ''; ?>">
                <?php foreach ($items as $item): ?>
                <div class="signature-dish-container basic-shadow flex justify-center radius">
                    <div class="signature-dish flex align-center column big-gap">
                        <h3 class="bold"><?php echo htmlspecialchars($item['name']); ?></h3>
                        <p class="signature-dish-description"><?php echo htmlspecialchars($item['description']); ?></p>
                        <div class="signature-dishes-action-container flex align-center space-between">
                            <h3 class="bold">₱<?php echo number_format($item['price'], 2); ?></h3>
                            <button class="add-to-cart-button radius basic-shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="white" d="M17 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2M1 2v2h2l3.6 7.59l-1.36 2.45c-.15.28-.24.61-.24.96a2 2 0 0 0 2 2h12v-2H7.42a.25.25 0 0 1-.25-.25q0-.075.03-.12L8.1 13h7.45c.75 0 1.41-.42 1.75-1.03l3.58-6.47c.07-.16.12-.33.12-.5a1 1 0 0 0-1-1H5.21l-.94-2M7 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
    function showTab(category) {
        // Hide all tab containers
        var tabContainers = document.getElementsByClassName('tab-container');
        for (var i = 0; i < tabContainers.length; i++) {
            tabContainers[i].classList.remove('tab-container-active');
        }
        
        // Show the selected tab container
        var activeContainer = document.querySelector('.' + category + '-container');
        if (activeContainer) {
            activeContainer.classList.add('tab-container-active');
        }
        
        // Update tab buttons
        var tabButtons = document.getElementsByClassName('categories-tab');
        for (var i = 0; i < tabButtons.length; i++) {
            tabButtons[i].classList.remove('tab_active');
            tabButtons[i].querySelector('h3').classList.remove('bold');
        }
        
        // Add 'tab_active' class and 'bold' class to the clicked button
        var activeButton = document.querySelector('.' + category + '-button');
        if (activeButton) {
            activeButton.classList.add('tab_active');
            activeButton.querySelector('h3').classList.add('bold');
        }
    }

    // Initialize the first tab as active
    window.onload = function() {
        showTab('appetizer');
    };
    </script>
</body>
</html>
