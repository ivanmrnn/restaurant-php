<?php
    include("../scripts/connection.php");
    $show_signup = isset($_GET['show_signup']) && $_GET['show_signup'] == 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/loginstyles.css">
</head>
<body>
    <div class="login flex justify-center align-center">
        <a href="../index.html" class="pointer">
            <div class="company-container flex big-gap align-center" aria-label="Edible company logo">
                <img class="company-image" src="../images/restaurant/edible-logo.png" alt="Edible company logo">
                <strong class="text-largest capitalize">Edible</strong>
            </div>
        </a>
        

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
                        <svg class="show-login-password-icon" xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"><path fill="var(--black)" d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5"/></svg>
                        <svg class="hide-login-password-icon" xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" style="display:none;"><path fill="var(--black)" d="M11.83 9L15 12.16V12a3 3 0 0 0-3-3zm-4.3.8l1.55 1.55c-.05.21-.08.42-.08.65a3 3 0 0 0 3 3c.22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53a5 5 0 0 1-5-5c0-.79.2-1.53.53-2.2M2 4.27l2.28 2.28l.45.45C3.08 8.3 1.78 10 1 12c1.73 4.39 6 7.5 11 7.5c1.55 0 3.03-.3 4.38-.84l.43.42L19.73 22L21 20.73L3.27 3M12 7a5 5 0 0 1 5 5c0 .64-.13 1.26-.36 1.82l2.93 2.93c1.5-1.25 2.7-2.89 3.43-4.75c-1.73-4.39-6-7.5-11-7.5c-1.4 0-2.74.25-4 .7l2.17 2.15C10.74 7.13 11.35 7 12 7"/></svg>
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
                        <svg class="show-signup-password-icon" xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"><path fill="var(--black)" d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5"/></svg>
                        <svg class="hide-signup-password-icon" xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" style="display:none;"><path fill="var(--black)" d="M11.83 9L15 12.16V12a3 3 0 0 0-3-3zm-4.3.8l1.55 1.55c-.05.21-.08.42-.08.65a3 3 0 0 0 3 3c.22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53a5 5 0 0 1-5-5c0-.79.2-1.53.53-2.2M2 4.27l2.28 2.28l.45.45C3.08 8.3 1.78 10 1 12c1.73 4.39 6 7.5 11 7.5c1.55 0 3.03-.3 4.38-.84l.43.42L19.73 22L21 20.73L3.27 3M12 7a5 5 0 0 1 5 5c0 .64-.13 1.26-.36 1.82l2.93 2.93c1.5-1.25 2.7-2.89 3.43-4.75c-1.73-4.39-6-7.5-11-7.5c-1.4 0-2.74.25-4 .7l2.17 2.15C10.74 7.13 11.35 7 12 7"/></svg>
                    </button>
                </div>

                <div class="input-box flex">
                    <input class="input-password" id="signup-confirm-password" name="signup-confirm-password" type="password" placeholder="Confirm Password">
                    <button type="button" class="reveal-confirm-password-button flex center" aria-label="reveal sign up confirm password">
                        <svg class="show-confirm-password-icon" xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"><path fill="var(--black)" d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5"/></svg>
                        <svg class="hide-confirm-password-icon" xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" style="display:none;"><path fill="var(--black)" d="M11.83 9L15 12.16V12a3 3 0 0 0-3-3zm-4.3.8l1.55 1.55c-.05.21-.08.42-.08.65a3 3 0 0 0 3 3c.22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53a5 5 0 0 1-5-5c0-.79.2-1.53.53-2.2M2 4.27l2.28 2.28l.45.45C3.08 8.3 1.78 10 1 12c1.73 4.39 6 7.5 11 7.5c1.55 0 3.03-.3 4.38-.84l.43.42L19.73 22L21 20.73L3.27 3M12 7a5 5 0 0 1 5 5c0 .64-.13 1.26-.36 1.82l2.93 2.93c1.5-1.25 2.7-2.89 3.43-4.75c-1.73-4.39-6-7.5-11-7.5c-1.4 0-2.74.25-4 .7l2.17 2.15C10.74 7.13 11.35 7 12 7"/></svg>
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

    </div>
</body>
<script>
    
    document.addEventListener('DOMContentLoaded', function() {
    const signupContainer = document.getElementById('signup-container');
    const loginContainer = document.getElementById('login-container');

    const revealLoginPasswordButton = document.querySelector('.reveal-login-password-button');
    const loginPasswordInput = document.getElementById('login-password');
    const showLoginPasswordIcon = document.querySelector('.show-login-password-icon');
    const hideLoginPasswordIcon = document.querySelector('.hide-login-password-icon');

    const revealSignupPasswordButton = document.querySelector('.reveal-signup-password-button');
    const signupPasswordInput = document.getElementById('signup-password');
    const showSignupPasswordIcon = document.querySelector('.show-signup-password-icon');
    const hideSignupPasswordIcon = document.querySelector('.hide-signup-password-icon');

    const revealConfirmPasswordButton = document.querySelector('.reveal-confirm-password-button');
    const confirmPasswordInput = document.getElementById('signup-confirm-password');
    const showConfirmPasswordIcon = document.querySelector('.show-confirm-password-icon');
    const hideConfirmPasswordIcon = document.querySelector('.hide-confirm-password-icon');

    const backToLoginButton = document.querySelector('.back-to-login-button')
    const signupPageButton = document.querySelector('.signup-page-button')

    const signupForm = document.querySelector('.signup-form');
    const passwordMatchError = document.getElementById('password-match-error');

    // Toggle password visibility functions
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

    revealLoginPasswordButton.addEventListener('click', () => togglePasswordVisibility(loginPasswordInput, showLoginPasswordIcon, hideLoginPasswordIcon));
    revealSignupPasswordButton.addEventListener('click', () => togglePasswordVisibility(signupPasswordInput, showSignupPasswordIcon, hideSignupPasswordIcon));
    revealConfirmPasswordButton.addEventListener('click', () => togglePasswordVisibility(confirmPasswordInput, showConfirmPasswordIcon, hideConfirmPasswordIcon));

    signupPageButton.addEventListener('click', () => {
        loginContainer.style.display = 'none';
        signupContainer.style.display = 'flex';
    });

    backToLoginButton.addEventListener('click', () => {
        signupContainer.style.display = 'none';
        loginContainer.style.display = 'flex';
    });

    function checkPasswordMatch() {
        return signupPasswordInput.value === confirmPasswordInput.value;
    }

    signupForm.addEventListener('submit', function(e) {
        if (!checkPasswordMatch()) {
            e.preventDefault();
            passwordMatchError.style.display = 'block';
        } else {
            passwordMatchError.style.display = 'none';
        }
    });

    const initialSignupDisplay = <?php echo $show_signup ? 'true' : 'false'; ?>;
    if (initialSignupDisplay) {
        loginContainer.style.display = 'none';
        signupContainer.style.display = 'flex';
    } else {
        loginContainer.style.display = 'flex';
        signupContainer.style.display = 'none';
    }
});


</script>
</html>