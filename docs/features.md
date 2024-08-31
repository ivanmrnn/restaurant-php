# Key Features

This section highlights the key features that include a bit of complexity.

**Summary**

| **Feature**                                                 | **Description**                                                          |
|-------------------------------------------------------------|--------------------------------------------------------------------------|
| [Database Connection](#database-connection)                 | Sql database connected with the menu and log in page.                    |       
| [Sign Up, Log In, and Log Out](#sign-up-log-in-and-log-out) | Users have the option to sign up. If they do, they earn a 10% discount when they log in. Logging out ends the session. |
| [Menu](#menu)                                               | Menu items are fetched from the database and displayed at the menu page. |
| [Order ](#order)                                            | Users can add to cart, view it, and create an order.                     |   


## Database Connection

**PHP**

***connection.php***

    <?php
    // Define database connection parameters
    $servername = "localhost"; // Hostname of the MySQL server
    $username = "root"; //Username for accessing the MySQL server
    $password = ""; //Password for the MySQL user
    $db_name = "restaurant"; //Name of the database to connect to

    // Establishes a connection to a MySQL database. $conn object represents the connection and allows for interacting with the database.
    $conn = new mysqli($servername, $username, $password, $db_name);

    // Check if the connection was successful
    if ($conn->connect_error) {

        // If there was an error connecting, output an error message and stop the script
        die("Connection Failed: " . $conn->connect_error);
    }
    ?>

| **Key Variables** | **Description**                                           |
|-------------------|-----------------------------------------------------------| 
| $servername       | MySQL server hostname.                                    |
| $username         | MySQL username.                                           |
| $password         | MySQL user password.                                      |
| $db_name          | Name of the database.                                     |
| $conn             | Object representing the connection to the MySQL database. |

| **Functions**        | **Description**                                                           |
|----------------------|---------------------------------------------------------------------------|
| new mysqli()         | Creates a connection to the MySQL database.                               |
| die()                | Stops the script and shows an error message if the connection fails.      |
| $conn->connect_error | Checks if there’s an error in the connection and triggers die() if found. |

This PHP script establishes a connection to a MySQL database using the mysqli object and checks if the connection was successful. if it fails, the script outputs an error message and stops executing.

## Sign Up, Log In, and Log Out 

**HTML**

***login-page.php***

    <!-- Sign Up Container -->
    <section id="signup-container" class="login-container flex justify-center align-center column big-gap basic-shadow radius" <?php if (!$show_signup) echo 'style="display:none;"'; ?>>
        <h1 class="bold">Sign Up </h1>
        <form class="signup-form flex column gap" action="../scripts/signup.php" method="post">

            <div class="input-box">
                <input class="input-username" id="signup-username" name="signup-username" type="text" placeholder="Username">
            </div>

            <div class="input-box flex">
                <input class="input-password" id="signup-password" name="signup-password" type="password" placeholder="Password">
                <button type="button" class="reveal-signup-password-button flex center" aria-label="Reveal sign up password">
                    <svg class="show-signup-password-icon" xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"><path fill="var(--black)"/></svg>
                </button>
            </div>

            <div class="input-box flex">
                <input class="input-password" id="signup-confirm-password" name="signup-confirm-password" type="password" placeholder="Confirm Password">
                <button type="button" class="reveal-confirm-password-button flex center" aria-label="reveal sign up confirm password">
                    <svg class="show-confirm-password-icon" xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"><path fill="var(--black)"/></svg>
                </button>
            </div>

            
            <span id="password-match-error" style="color: red; display: none;">Passwords do not match</span>
            <?php
            if (isset($_GET['signup_error'])) {
                if ($_GET['signup_error'] == 1) {
                    echo '<p style="color:red;">Username already exists</p>';
                } elseif ($_GET['signup_error'] == 2) {
                    echo '<p style="color:red;">Failed to create account. Please try again.</p>';
                }
            }
            ?>
            
            <button class="signup-button flex justify-center align-center basic shadow" type="submit">
                <strong>Sign Up</strong>
            </button>
            
        </form>
        
        <button class="back-to-login-button">
            <strong>Back to Login</strong>
        </button>
    </section>

***login-page.php***

    <!-- Login Container -->
    <section id="login-container" class="login-container flex justify-center align-center column big-gap radius basic-shadow" <?php if ($show_signup) echo 'style="display:none;"'; ?>>
        <h1 class="text-large">Log In to your Account</h1>
        <p>Earn a 10% discount by becoming a member</p>
        <form action="../scripts/login.php" class="login-form flex column gap align-center" method="post">
            <div class="input-box">
                <input class="input-username" id="login-username" name="login-username" type="text" placeholder="Username">
            </div>
            <div class="input-box flex">
                <input class="input-password" id="login-password" name="login-password" type="password" placeholder="Password">
                <button type="button" class="reveal-login-password-button flex center" aria-label="Reveal log in password">
                    <svg class="show-login-password-icon" xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"><path></svg>
                    <svg class="hide-login-password-icon" xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" style="display:none;"><path/></svg>
                </button>
            </div>

            <?php if (isset($_GET['login_error']) && $_GET['login_error'] == 1): ?>
                <p style="color: red">Invalid username or password</p>
            <?php endif; ?>

            <button class="login-button flex justify-center align-center basic-shadow" type="submit">
                <strong>Sign In</strong>
            </button>
        </form>
        <button class="signup-page-button">
            <strong>Sign Up</strong>
        </button>
    </section>

***menu-page.php***

    <!-- Log out Button -->
    <form action="../scripts/logout.php" method="post" class="logout-form">
        <button type="submit" class="logout-button" aria-label="Log out">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path/>
            </svg>
        </button>
    </form>

**CSS**

***loginstyles.css***

    .login-container {
        padding: 2rem 4rem;
        background-color: white;
    }

    .login-form .input-box, .signup-form .input-box, .login-form, .signup-form  {
        width: 100%;
    }


    .input-password {
        width: 100%;
    }

    .reveal-login-password-button, .reveal-signup-password-button, .reveal-confirm-password-button {
        margin-right: 1rem;
    }

    .login-button, .signup-button {
        width: 100%;
        margin-top: 1rem;
        padding: 1rem;
        background: var(--green);
        color: white;
    }

    
    .input-username, .input-password, .input-email {
        width: 100%;
        padding: 12px 1rem; 
    }

    .signup-page-button, .back-to-login-button{
        color: var(--green);
    }

**JavaScript**

***login-page.php***

    document.addEventListener('DOMContentLoaded', function() {
        // Common elements for both signup and login
        const signupContainer = document.getElementById('signup-container');
        const loginContainer = document.getElementById('login-container');

        const backToLoginButton = document.querySelector('.back-to-login-button');
        const signupPageButton = document.querySelector('.signup-page-button');

        // Toggle between login and signup forms
        signupPageButton.addEventListener('click', () => {
            loginContainer.style.display = 'none';
            signupContainer.style.display = 'flex';
        });

        backToLoginButton.addEventListener('click', () => {
            signupContainer.style.display = 'none';
            loginContainer.style.display = 'flex';
        });

        // Show signup or login page based on initial condition
        const initialSignupDisplay = <?php echo $show_signup ? 'true' : 'false'; ?>;
        if (initialSignupDisplay) {
            loginContainer.style.display = 'none';
            signupContainer.style.display = 'flex';
        } else {
            loginContainer.style.display = 'flex';
            signupContainer.style.display = 'none';
        }

        /* --- Login functionality --- */
        const revealLoginPasswordButton = document.querySelector('.reveal-login-password-button');
        const loginPasswordInput = document.getElementById('login-password');
        const showLoginPasswordIcon = document.querySelector('.show-login-password-icon');
        const hideLoginPasswordIcon = document.querySelector('.hide-login-password-icon');

        // Toggle login password visibility
        revealLoginPasswordButton.addEventListener('click', () => {
            togglePasswordVisibility(loginPasswordInput, showLoginPasswordIcon, hideLoginPasswordIcon);
        });

        /* --- Signup functionality --- */
        const revealSignupPasswordButton = document.querySelector('.reveal-signup-password-button');
        const signupPasswordInput = document.getElementById('signup-password');
        const showSignupPasswordIcon = document.querySelector('.show-signup-password-icon');
        const hideSignupPasswordIcon = document.querySelector('.hide-signup-password-icon');

        const revealConfirmPasswordButton = document.querySelector('.reveal-confirm-password-button');
        const confirmPasswordInput = document.getElementById('signup-confirm-password');
        const showConfirmPasswordIcon = document.querySelector('.show-confirm-password-icon');
        const hideConfirmPasswordIcon = document.querySelector('.hide-confirm-password-icon');

        const signupForm = document.querySelector('.signup-form');
        const passwordMatchError = document.getElementById('password-match-error');

        // Toggle signup and confirm password visibility
        revealSignupPasswordButton.addEventListener('click', () => {
            togglePasswordVisibility(signupPasswordInput, showSignupPasswordIcon, hideSignupPasswordIcon);
        });

        revealConfirmPasswordButton.addEventListener('click', () => {
            togglePasswordVisibility(confirmPasswordInput, showConfirmPasswordIcon, hideConfirmPasswordIcon);
        });

        // Check if passwords match during signup
        function checkPasswordMatch() {
            return signupPasswordInput.value === confirmPasswordInput.value;
        }

        // Validate password match on form submission
        signupForm.addEventListener('submit', function(e) {
            if (!checkPasswordMatch()) {
                e.preventDefault();
                passwordMatchError.style.display = 'block';
            } else {
                passwordMatchError.style.display = 'none';
            }
        });

        /* --- Helper function --- */
        // Function to toggle password visibility
        function togglePasswordVisibility(inputElement, showIcon, hideIcon) {
            if (inputElement.type === 'password') {
                inputElement.type = 'text';
                showIcon.style.display = 'none';
                hideIcon.style.display = 'block';
            } else {
                inputElement.type = 'password';
                showIcon.style.display = 'block';
                hideIcon.style.display = 'none';
            }
        }
    });

    changeColor();

| **Key Variables**           | **Description**                                                      |
|-----------------------------|----------------------------------------------------------------------| 
| signupContainer             | Element representing the signup form container.                      |
| loginContainer              | Element representing the login form container.                       |
| backToLoginButton           | Button element that navigates back to the login form.                |
| signupPageButton            | Button element that navigates to the signup form.                    |
| initialSignupDisplay        | PHP variable determining whether the signup form is initially shown. |
| revealLoginPasswordButton   | Button to toggle login password visibility.                          |
| loginPasswordInput          | Input element for the login password field.                          |
| showLoginPasswordIcon       | Icon shown when the login password is hidden.                        |
| hideLoginPasswordIcon       | Icon shown when the login password is visible.                       |
| revealSignupPasswordButton  | Button to toggle signup password visibility.                         |
| signupPasswordInput         | Input element for the signup password field.                         |
| showSignupPasswordIcon      | Icon shown when the signup password is hidden.                       |
| hideSignupPasswordIcon      | Icon shown when the signup password is visible.                      |
| revealConfirmPasswordButton | Button to toggle confirm password visibility.                        |
| confirmPasswordInput        | Input element for the confirm password field.                        |
| showConfirmPasswordIcon     | Icon shown when the confirm password is hidden.                      |
| hideConfirmPasswordIcon     | Icon shown when the confirm password is visible.                     |
| signupForm                  | Form element for the signup process.                                 |
| passwordMatchError          | Element displaying an error message when passwords do not match.     |


| **Functions**                        | **Description**                                                                 |
|--------------------------------------|---------------------------------------------------------------------------------|
| togglePasswordVisibility()           | Toggles the visibility of password fields and switches between show/hide icons. |
| checkPasswordMatch()                 | Checks if the signup and confirm passwords match.                               |
| signupPageButton.addEventListener()  | Switches to the signup form when the signup button is clicked.                  |
| backToLoginButton.addEventListener() | Switches back to the login form when the back button is clicked.                |
| signupForm.addEventListener()        | Validates the signup form and prevents submission if passwords don't match.     |

This script includes toggling between log in and sign up containers when the appropriate button is clicked.

It includes checking if the password and confirm password in the sign up match with each other.

It also includes revealing the password when the reveal-password-button is clicked.

**PHP**

***signup.php***

    <?php
    session_start();
    include("connection.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['signup-username'];
        $password = $_POST['signup-password'];
        $confirm_password = $_POST['signup-confirm-password'];

        // Check if passwords match
        if ($password !== $confirm_password) {
            header("Location: ../html/login-page.php?signup_error=3&show_signup=1");
            exit();
        }

        // Check if username already exists
        $check_query = "SELECT * FROM users WHERE username='$username'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            header("Location: ../html/login-page.php?signup_error=1&show_signup=1");
            exit();
        }

        // Insert new user with default discount of 10
        $insert_query = "INSERT INTO users (username, password, discount) VALUES ('$username', '$password', 10)";
        if (mysqli_query($conn, $insert_query)) {
            $_SESSION['username'] = $username;
            header("Location: ../html/menu-page.php");
            exit();
        } else {
            header("Location: ../html/login-page.php?signup_error=2&show_signup=1");
            exit();
        }
    }
    ?>

| **Key Variables**                 | **Description**                                                    |
|-----------------------------------|--------------------------------------------------------------------| 
| $_POST['signup-username']         | The username submitted by the user during signup.                  |
| $_POST['signup-password']         | The password submitted by the user during signup.                  |
| $_POST['signup-confirm-password'] | The confirmation password submitted by the user.                   |
| $conn                             | Database connection object from connection.php.                    |
| $check_query                      | SQL query to check if the username already exists in the database. |
| $check_result                     | Result of the query checking for existing usernames.               |
| $insert_query                     | SQL query to insert a new user with a default discount of 10.      |

| **Functions**     | **Description**                                                                    |
|-------------------|------------------------------------------------------------------------------------|
| session_start()   | Initiates a new session or resumes the existing session.                           |
| header()          | Redirects the user to a different page based on specific conditions.               |
| mysqli_query()    | Executes the SQL query against the database.                                       |
| mysqli_num_rows() | Checks the number of rows returned by the SQL query to see if the username exists. |
| exit()            | Stops the script execution after the redirect.                                     |

If the password and confirm password doesn't match with each other or if the username doesn't match with any existing username, it sends their corresponding error message to the login-page.

If sign up conditions are correct, set the username as session username and redirect the user to the menu page.

***login.php***

    <?php
    session_start();
    include("connection.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the username and password from the submitted form data
        $username = $_POST['login-username'];
        $password = $_POST['login-password'];

        // Prepare the SQL query to select the user with the given username and password
        $loginQuery = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $queryResult = mysqli_query($conn, $loginQuery);

        // Check if the username and password match an existing user
        if (mysqli_num_rows($queryResult) > 0) {
            $user = mysqli_fetch_assoc($queryResult); // Fetch the user's data as an associative array
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['username'] = $user['username']; 

            // Redirect the user to the menu page after successful login
            header("Location: ../html/menu-page.php");
            exit();
        } else {
            // If the login fails, redirect the user back to the login page with an error
            header("Location: ../html/login-page.php?login_error=1");
            exit();
        }
    }
    ?>

| **Key Variables**        | **Description**                                                           |
|--------------------------|---------------------------------------------------------------------------| 
| $_POST['login-username'] | The username submitted by the user during login.                          |
| $_POST['login-password'] | The password submitted by the user during login.                          |
| $conn                    | Database connection object from connection.php.                           |
| $loginQuery              | SQL query to select the user with the given username and password.        |
| $queryResult             | Result of the SQL query checking for the user’s credentials.              |
| $user                    | Associative array containing the user's data retrieved from the database. |

| **Functions**        | **Description**                                                                    |
|----------------------|------------------------------------------------------------------------------------|
| session_start()      | Initiates a new session or resumes the existing session.                           |
| header()             | Redirects the user to a different page based on specific conditions.               |
| mysqli_query()       | Executes the SQL query against the database.                                       |
| mysqli_num_rows()    | Checks the number of rows returned by the SQL query to verify user credentials.    |
| mysqli_fetch_assoc() | Fetches the user's data as an associative array from the query result.             |
| exit()               | Stops the script execution after the redirect.                                     |

Checks if an existing user in the database matches with the input from the log in container. If theres a match, it sets the user as the session user. If the log in conditions is not correct, sends an error to the login page.

***logout.php***

    <?php
    session_start();
    session_destroy();
    header("Location: ../html/menu-page.php");
    exit();
    ?>

| **Functions**        | **Description**                                        |
|----------------------|--------------------------------------------------------|
| session_start()      | Initiates a session to ensure it can be destroyed.     |
| session_destroy()    | Destroys all data associated with the current session. |
| header()             | Redirects the user to the menu page after logging out. |
| exit()               | Stops the script execution after the redirect.         |

Log outs the user by destroying the session.

## Menu

**HTML**

***menu-page.php***

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
                        <strong class="menu-item-title text-medium"><?php echo htmlspecialchars($categoryMenuitem['name']); ?></strong>
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

**CSS**

***menu-styles.css***

    .menu-item-container {
        width: 280px;
        padding: 2rem;
        background: white;
    }

    .menu-item-title {
        text-align: center;
    }

    .menu-item-info {
        width: 100%;
        height: 100%;
        gap: 2rem;
    }

    .menu-item-description {
        min-height: 65px;
    }

    .menu-items-action-container {
        width: 100%;
        color: var(--green);
    }

    .menu-item {
        width: 100%;
    }

    .add-to-cart-button {
        padding: 0.5rem 2rem;
        background: var(--orange);
    }

**PHP**

***menu-page.php***

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

| **Key Variables**    | **Description**                                                                                                                         |
|----------------------|-----------------------------------------------------------------------------------------------------------------------------------------| 
| $fetchMenuItemsQuery | SQL query to select all active records from the menu table, ordered by category and name.                                               |
| $menuItems           | Result set of the executed SQL query that retrieves menu items.                                                                         |
| $menu                | Associative array initialized with categories (appetizer, main-course, dessert) as keys and empty arrays as values to store menu items. |
| $menuItemRow         | Associative array representing a single row of menu item data from the result set.                                                      |
| $menuCategory        | Lowercased category of the current menu item, used to classify the item into the appropriate category in the $menu array.               |

| **Functions**             | **Description**                                                                           |
|---------------------------|-------------------------------------------------------------------------------------------|
| $conn->query()            | Executes the SQL query to fetch active menu items from the database.                      |
| $menuItems->num_rows      | Checks the number of rows returned by the query to determine if there are any menu items. |
| $menuItems->fetch_assoc() | Fetches a single row from the result set as an associative array.                         |

The PHP script fetches active menu items from a database, categorizes them into appetizer, main-course, and dessert, and stores them in an associative array $menu.

The HTML section loops through the $menu array and dynamically generates menu items for each category.

JavaScript allows users to add items to a cart, updating the cart display when items are added.

## Order

***menu-page.php***

**HTML**

    <!-- Cart -->
    <div id="cart-modal" class="modal justify-center align-center">
        <div class="modal-content flex column gap">
            <span class="close-button" aria-label="Close Cart List">&times;</span>
            <span class="text-large">Place your order</span>
            <div id="cart-item-list"></div>
            <button class="proceed-to-checkout-button flex justify-center radius basic-shadow">
                <strong class="capitalize">Proceed To Checkout</strong>
            </button>
        </div>
    </div>

    <!-- Cart Checkout -->
    <div id="checkout-modal" class="modal justify-center align-center">
        <div class="modal-content flex column gap">
            <span class="close-button" aria-label="Close Checkout List">&times;</span>
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
                    <strong class="capitalize">Cancel</strong>
                </button>
                <button class="confirm-order-button radius basic-shadow">
                    <strong class="capitalize">Confirm Order</strong>
                </button>
            </div>
        </div>
    </div>

    <!-- Successful Order -->
    <div id="success-modal" class="modal justify-center align-center">
        <div class="modal-content flex column gap">
            <span class="close-button" aria-label="Close success message">&times;</span>
            <span class="text-large capitalize">Order Placed Successfully!</span>
            <p>Your order has been placed and will be prepared shortly.</p>
        </div>
    </div>

**CSS**

***menustyles.css***

    /* Cart */

    #cart-modal {
        z-index: 10;
    }

    .cart-item {
        width: 100%;
        margin-bottom: 10px;
    }

    .cart-item-name {
        flex-grow: 1;
    }

    .cart-item-quantity-input {
        width: 60px;
        text-align: center;
        border: 1px solid #ccc;
        padding: 5px;
    }

    .cart-item-quantity-button, .clear-item-button {
        padding: 5px 8px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    .cart-item-quantity-button {
        background-color: #f0f0f0;
        width: 30px;
        height: 30px;
    }

    .clear-item-button {
        background-color: #e60000;
        color: white;
    }

    .proceed-to-checkout-button {
        padding: 1rem;
        background: var(--green);
        color: white;
    }

    .proceed-to-checkout-button strong {
        pointer-events: none;
    }

    .proceed-to-checkout-button.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* Cart Checkout */

    .cancel-checkout-button {
        padding: 1rem;
        background: #e60000;
        color: white;
    }

    .confirm-order-button {
        padding: 1rem;
        background: var(--green);
        color: white;
    }

**JavaScript**

***menu-list.js***

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

| **Key Variables** | **Description**                                                                                                 |
|-------------------|-----------------------------------------------------------------------------------------------------------------| 
| button            | Represents a single button element with the class 'add-to-cart-button'.                                         |
| id, name, price   | Variables extracted from the button's data attributes, representing the item's unique ID, name, and price.      |
| cart              | Object used to store items in the cart. Each key corresponds to an item ID and stores its details and quantity. |

| **Functions**               | **Description**                                                     |
|-----------------------------|---------------------------------------------------------------------|
| document.querySelectorAll() | Selects all elements with the class 'add-to-cart-button'            |
| button.onclick              | Event listener that triggers when an add-to-cart button is clicked. |
| cart[id].quantity++         | Increases the quantity of the selected item in the cart.            |
| updateCartDisplay()         | Updates the cart display after an item is added.                    |

When the add-to-cart button is clicked, it retrieves the item's details (ID, name, price) and either updates the quantity if the item is already in the cart or adds it as a new entry. The cart display is also updated.

***cart.js***

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

| **Key Variables** | **Description**                                                                                                            |
|-------------------|----------------------------------------------------------------------------------------------------------------------------| 
| cart              | An object used to store cart items, where each key is an item ID and the value is an object containing the item's details. |
| proceedButton     | The button element that allows the user to proceed to checkout, which is enabled or disabled based on the cart's status.   |
| cartItems         | The container element where the cart items are displayed on the page.                                                      |

| **Functions**                              | **Description**                                                            |
|--------------------------------------------|----------------------------------------------------------------------------|
| window.onload                              | Calls updateCartDisplay() when the page loads.                             |
| isCartEmpty()                              | Returns true if the cart has no items, otherwise false.                    |
| createCartEntry(id, item)                  | Generates the HTML for a cart item using its ID and details.               |
| updateProceedToCheckoutButton()            | Disables or enables the "Proceed to Checkout" button based on cart status. |
| updateCartDisplay()                        | Renders the cart items and refreshes the state of the checkout button.     |
| handleQuantityChange(target)               | Adjusts the quantity of an item when + or - buttons are clicked.           |
| handleClearItem(target)                    | Removes an item from the cart when the X button is clicked.                |
| handleProceedToCheckout()                  | Initiates checkout if the cart is not empty.                               |
| updateCartItem(id, quantity)               | Updates the quantity of an item or removes it if quantity is zero.         |
| document.addEventListener('click')         | Handles clicks for quantity changes, item removal, and checkout.           |
| document.addEventListener('input')         | Updates cart quantities based on user input.                               |
| document.querySelectorAll('.close-button') | Closes modal windows when the close button is clicked.                     |
| window.onclick                             | Closes modal windows when clicking outside of them.                        |

It initializes an empty cart, updates the cart display on page load, and checks if the cart is empty. 

Users can adjust item quantities, remove items, and proceed to checkout.

***checkout.js***

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

| **Key Variables** | **Description**                                                                                                            |
|-------------------|----------------------------------------------------------------------------------------------------------------------------| 
| cart              | An object used to store cart items, where each key is an item ID and the value is an object containing the item's details. |
| checkoutModal     | The modal element that displays the checkout interface.                                                                    |
| checkoutItems     | The container within the checkout modal that lists the items being purchased.                                              |
| checkoutTotal     | The element in the checkout modal displaying the total amount, including discounts.                                        |
| total             | A variable that holds the total cost of all items in the cart before discounts.                                            |
| discountedTotal   | A variable that stores the total cost after applying the discount.                                                         |

| **Functions**                                     | **Description**                                                                                             |
|---------------------------------------------------|-------------------------------------------------------------------------------------------------------------|
| showCheckoutModal()                               | Displays the checkout modal, generates the cart items' HTML, and calculates the total cost with discounts.  |
| document.querySelector('.cancel-checkout-button') | Adds an event listener to close the checkout modal when the cancel button is clicked.                       |
| document.querySelector('.confirm-order-button')   | Adds an event listener to confirm the order, send cart data to the server, and clear the cart upon success. |
| fetch()                                           | Sends a POST request to the server with the cart data and payment method.                                   |

When the checkout modal is shown, it calculates the total price of the items in the cart and displays them, including any discounts.

If the user confirms the order, the cart items and selected payment method are sent to the server via a POST request.

Upon successful order placement, the success modal is shown, the cart is cleared, and the cart display is updated.

**PHP**

***order.php***

    <?php
    session_start();
    include("connection.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Decode the JSON-encoded cart items received from the client side and store them in an array
        $cart_items = json_decode($_POST['cart_items'], true);
        $payment_method = $_POST['payment_method'];
        $total_price = $_POST['total_price'];
        $user_id = $_SESSION['user_id'] ?? null;

        // Fetch user's discount
        $discount = 0;
        // If the user is logged in, fetch their discount from the database
        if ($user_id) {
            $stmt = mysqli_prepare($conn, "SELECT discount FROM users WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "i", $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $discount);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        }

        // Calculate the discounted price by applying discount to the total price
        $discounted_price = $total_price * (1 - $discount / 100);

        mysqli_begin_transaction($conn);

        try {
            // Insert the main order into the orders table with user ID, discounted price, payment method, and current date/time.
            $stmt = mysqli_prepare($conn, "INSERT INTO orders (user_id, total_price, payment_method, order_date) VALUES (?, ?, ?, NOW())");
            mysqli_stmt_bind_param($stmt, "ids", $user_id, $discounted_price, $payment_method);
            mysqli_stmt_execute($stmt);
            $order_id = mysqli_insert_id($conn);

            // Prepare the statement for inserting items into the order_items table.
            $stmt = mysqli_prepare($conn, "INSERT INTO order_items (order_id, menu_item_id, quantity, item_price) VALUES (?, ?, ?, ?)");
            foreach ($cart_items as $item) {
                mysqli_stmt_bind_param($stmt, "iiid", $order_id, $item['id'], $item['quantity'], $item['price']);
                mysqli_stmt_execute($stmt);
            }

            // Commit the transaction to save the changes to the database.
            mysqli_commit($conn);
            echo json_encode(['success' => true, 'message' => 'Order placed successfully']);
        } catch (Exception $e) {
            mysqli_rollback($conn);
            echo json_encode(['success' => false, 'message' => 'Error placing order: ' . $e->getMessage()]);
        }

        mysqli_close($conn);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    }
    ?>

| **Key Variables** | **Description**                                                                                              |
|-------------------|--------------------------------------------------------------------------------------------------------------| 
| cart_items        | Decoded JSON array of cart items received from the client side, containing item IDs, quantities, and prices. |
| payment_method    | The payment method selected by the user during checkout.                                                     |
| total_price       | The total price of the items in the cart before any discounts are applied.                                   |
| user_id           | The ID of the logged-in user, retrieved from the session, or null if the user is not logged in.              |
| discount          | The discount percentage fetched from the database for the logged-in user, or 0 if the user is not logged in. |
| discounted_price  | The total price after applying the user's discount.                                                          |
| order_id          | The ID of the newly inserted order, retrieved after inserting the order into the orders table.               |

| **Functions**              | **Description**                                                                        |
|----------------------------|----------------------------------------------------------------------------------------|
| mysqli_prepare()           | Prepares an SQL statement for execution to prevent SQL injection.                      |
| mysqli_stmt_bind_param()   | Binds variables to a prepared statement as parameters.                                 |
| mysqli_stmt_execute()      | Executes a prepared statement.                                                         |
| mysqli_stmt_bind_result()  | Binds columns from the result set to variables.                                        |
| mysqli_stmt_fetch()        | Fetches the results from a prepared statement into the bound variables.                |
| mysqli_begin_transaction() | Initiates a transaction to ensure that multiple SQL queries are executed atomically.   |
| mysqli_commit()            | Commits the current transaction, saving all changes to the database.                   |
| mysqli_rollback()          | Rolls back the current transaction, reverting any changes made during the transaction. |
| json_encode()              | Encodes a PHP value (like an array) to JSON format.                                    |
| json_decode()              | Decodes a JSON string into a PHP variable.                                             |
| mysqli_insert_id()         | Retrieves the ID generated by the last query on an AUTO_INCREMENT column.              |

The script processes an order by decoding cart items from a POST request, applying any user discount, and storing the order and its items in the database.

it returns a JSON response indicating success or failure.