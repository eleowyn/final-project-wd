<?php
// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database configuration
require_once 'config.php';

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = connectDB();
    $formType = $_POST['form_type'] ?? '';

    if ($formType === 'login') {
        // Login Logic
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = trim($_POST['password']);

        $stmt = $conn->prepare("SELECT id, full_name, email, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if ($password === $user['password']) { // Compare passwords directly
                $_SESSION['id'] = $user['id'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['email'] = $user['email'];

                // Redirect to dashboard
                header("Location: dashboard.html");
                exit();
            }
        }

        // Redirect to index with error message
        header("Location: index.php?error=Invalid email or password");
        exit();
    } elseif ($formType === 'signup') {
        // Signup Logic
        $fullName = htmlspecialchars(trim($_POST['fullName']));
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = trim($_POST['password']);

        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            header("Location: index.php?error=Email already registered");
            exit();
        }

        // Insert user into database
        $stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $fullName, $email, $password);

        if ($stmt->execute()) {
            header("Location: index.php?signup_success=Registration successful. Please login.");
            exit();
        } else {
            header("Location: index.php?error=Registration failed");
            exit();
        }
    }

    $conn->close();
} else {
    header("Location: index.php?error=Invalid request method");
    exit();
}
?>
