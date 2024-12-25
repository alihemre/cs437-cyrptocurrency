<?php

// Create connection
session_start(); // Start the session

$servername = "127.0.0.1"; // Use 127.0.0.1 to avoid socket issues
$username = "root"; // Default MySQL username
$password = "aliemre3169"; // Leave blank if no password is set
$dbname = "news_site"; // Your database name
$port = 3306; // Default MySQL port

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve inputs directly without sanitization (intentional for vulnerability testing)
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vulnerable SQL query: Concatenate user inputs directly into the query
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

    // Execute the query
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Fetch the first user row
        $user = $result->fetch_assoc();

        // Set session variables for login
        $_SESSION['logged_in'] = true;
        $_SESSION['user_email'] = $user['email']; // Save user's email in session

        // Redirect to index.php
        header("Location: index.php");
        exit();
    } else {
        echo "<p>Invalid email or password.</p>";
    }


}

$conn->close();

?>
<style>
  /* Specific styles for login and signup pages */
  #login-page, #signup-page {
    font-family: Arial, sans-serif;
    background-color: #eef2f7;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    margin: 0;
    padding: 20px;
  }

    
  #login-page h1, #signup-page h1 {
    margin-bottom: 20px;
    color: #2c3e50;
  }

  #login-form, #signup-form {
    background: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    text-align: center; /* Centers the button inside the form */
  }

  #login-form label, #signup-form label {
    display: block;
    margin-top: 10px;
    font-weight: 600;
    color: #333;
    text-align: left;
  }

  #login-form input, #signup-form input {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  #login-form button, #signup-form button {
    margin-top: 15px;
    padding: 10px 15px;
    background: #2980b9;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 600;
    display: inline-block; /* Ensures proper alignment */
    margin: 0 auto; /* Center-aligns the button */
  }

  #login-form button:hover, #signup-form button:hover {
    background: #1f5f85;
  }

  #login-form a, #signup-form a {
    display: inline-block;
    margin-top: 15px;
    text-decoration: none;
    color: #2980b9;
    font-weight: 500;
    transition: color 0.3s;
  }

  #login-form a:hover, #signup-form a:hover {
    color: #1f5f85;
  }
</style>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        /* Include your styles here */
    </style>
</head>
<body id="login-page">
    <h1>Login</h1>
    <form id="login-form" action="login.php" method="POST">
        <label for="email">Email or Phone:</label>
        <input type="text" id="email" name="email" ><br>
<main>
    
    <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
        <p style="color: red;">Invalid username or password. Please try again.</p>
    <?php endif; ?>

    <form action="authenticate.php" method="post">
        <!-- <label for="username">Username:</label>
        <input type="text" id="username" name="username" required> -->

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" ><br>

        <button type="submit">Login</button>
        <a href="signup.php">I do not have an account. Signup?</a>
    </form>

    <?php
    if (!empty($error_message)) {
        echo "<p style='color:red;'>$error_message</p>";
    }
    ?>
</body>
</html>


