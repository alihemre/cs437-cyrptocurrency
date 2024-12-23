<?php
$title = "Login";
include './includes/header.php';
?>
<main>
    <h2>Login</h2>
    <form action="authenticate.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</main>
<?php include './includes/footer.php'; ?>
