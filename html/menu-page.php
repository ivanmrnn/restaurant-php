<?php
session_start();
include("../scripts/connection.php");
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
            <button class="appetizers-button categories-tab tab_active" onclick="showTab(1)">
                <h3 class="bold">Appetizers</h3>
            </button>
            <button class="main-course-button categories-tab" onclick="showTab(2)">
                <h3>Main Course</h3>
            </button>
            <button class="deserts-button categories-tab" onclick="showTab(3)">
                <h3>Deserts</h3>
            </button>
        </div>
        <div class="category section-container flex column justify-center align-center big-gap">
            <div class="appetizers-container section tab-container tab-container-active">
                <div class="signature-dish-container basic-shadow flex justify-center radius">
                    <div class="signature-dish flex align-center column big-gap">
                        <h3 class="bold">Beef Salad</h3>
                        <p class="signature-dish-description">Tender beef liver stir-fried with onions and tomatoes.</p>
                        <div class="signature-dishes-action-container flex align-center space-between">
                            <h3 class="bold">₱200</h3>
                            <button class="add-to-cart-button radius basic-shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="white" d="M17 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2M1 2v2h2l3.6 7.59l-1.36 2.45c-.15.28-.24.61-.24.96a2 2 0 0 0 2 2h12v-2H7.42a.25.25 0 0 1-.25-.25q0-.075.03-.12L8.1 13h7.45c.75 0 1.41-.42 1.75-1.03l3.58-6.47c.07-.16.12-.33.12-.5a1 1 0 0 0-1-1H5.21l-.94-2M7 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>
