<?php
$title = "Home";
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
<body id="signup-page">
    <h1>Signup</h1>
    <form id="signup-form" action="#" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="phone">Phone:</label>
        <input type="phone" id="phone" name="phone" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">Signup</button>
        <a href="login.php">Already have an account? Login</a>
    </form>
</body>
<?php include '../includes/footer.php'; ?>
