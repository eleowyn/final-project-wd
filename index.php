<?php
// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Error messages (optional for user feedback)
$error = $_GET['error'] ?? '';
$signupError = $_GET['signup_error'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form - UNKLAB Lost & Found</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <!-- Login Box -->
        <div class="login-box" id="loginBox" style="display: block;">
            <div class="login-header">
                <h2>Welcome Back</h2>
                <p>Login to UNKLAB Lost & Found</p>
            </div>
            <form id="loginForm" class="login-form" method="POST" action="auth.php">
                <input type="hidden" name="form_type" value="login">
                <?php if (!empty($error)): ?>
                    <p class="error-message" style="color: red; text-align: center;"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <div class="input-group">
                        <i class="fa fa-user"></i>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            placeholder="Email"
                            required
                        >
                        <span class="input-highlight"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <i class="fa fa-lock"></i>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Password"
                            required
                        >
                        <i class="fa fa-eye-slash toggle-password"></i>
                        <span class="input-highlight"></span>
                    </div>
                </div>

                <button type="submit" class="login-btn">
                    <span>Login</span>
                    <i class="fa fa-arrow-right"></i>
                </button>
            </form>
            <div class="form-options">
                <div class="remember-me">
                    <input type="checkbox" id="rememberMe">
                    <label for="rememberMe">Remember me</label>
                </div>
                <a href="#" class="forgot-password">Forgot password?</a>
            </div>
            <div class="separator">
                <span>or continue with</span>
            </div>
            <div class="social-login">
                <button class="social-btn google">
                    <i class="fab fa-google"></i>
                    Google
                </button>
                <button class="social-btn microsoft">
                    <i class="fab fa-microsoft"></i>
                    Microsoft
                </button>
            </div>
            <p class="signup-link">
                Don't have an account? <a href="#" id="showSignup">Sign up</a>
            </p>
        </div>

        <!-- Signup Box -->
        <div class="signup-box" id="signupBox" style="display: none;">
            <div class="login-header">
                <h2>Create an Account</h2>
                <p>Sign up for UNKLAB Lost & Found</p>
            </div>
            <form id="signupForm" class="login-form" method="POST" action="auth.php">
                <input type="hidden" name="form_type" value="signup">
                <?php if (!empty($signupError)): ?>
                    <p class="error-message" style="color: red; text-align: center;"><?= htmlspecialchars($signupError) ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <div class="input-group">
                        <i class="fa fa-user"></i>
                        <input
                            type="text"
                            name="fullName"
                            id="fullName"
                            placeholder="Full Name"
                            required
                        >
                        <span class="input-highlight"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <i class="fa fa-envelope"></i>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            placeholder="Email"
                            required
                        >
                        <span class="input-highlight"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <i class="fa fa-lock"></i>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Password"
                            required
                        >
                        <i class="fa fa-eye-slash toggle-password"></i>
                        <span class="input-highlight"></span>
                    </div>
                </div>

                <button type="submit" class="login-btn">
                    <span>Sign Up</span>
                    <i class="fa fa-arrow-right"></i>
                </button>
            </form>
            <div class="separator">
                <span>or continue with</span>
            </div>
            <div class="social-login">
                <button class="social-btn google">
                    <i class="fab fa-google"></i>
                    Google
                </button>
                <button class="social-btn microsoft">
                    <i class="fab fa-microsoft"></i>
                    Microsoft
                </button>
            </div>
            <p class="signup-link">
                Already have an account? <a href="#" id="showLogin">Login</a>
            </p>
        </div>
    </div>

    <script>
        // Toggle Password Visibility
        document.querySelectorAll('.toggle-password').forEach(item => {
            item.addEventListener('click', () => {
                const input = item.previousElementSibling;
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                item.classList.toggle('fa-eye-slash');
                item.classList.toggle('fa-eye');
            });
        });

        // Toggle between login and signup
        document.getElementById('showSignup').addEventListener('click', () => {
            document.getElementById('loginBox').style.display = 'none';
            document.getElementById('signupBox').style.display = 'block';
        });
        document.getElementById('showLogin').addEventListener('click', () => {
            document.getElementById('signupBox').style.display = 'none';
            document.getElementById('loginBox').style.display = 'block';
        });
    </script>
</body>
</html>
