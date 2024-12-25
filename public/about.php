<?php
// No need to call session_start() here, as it is already included in header.php

// Default user session setup for demonstration


$title = "About";
include '../includes/header.php';
?>

<main class="about-main">
    <h2>About Us</h2>
    <p>We are dedicated to bringing you the latest cryptocurrency news and price updates.</p>
    <p>Our mission is to simplify the complex world of digital assets for the everyday user.</p>

    <!-- Admin-Only Action -->
    <form method="POST">
        <button type="submit" name="admin_action">Perform Admin Task</button>
    </form>

    <?php
    // Process admin action
    if (isset($_POST['admin_action'])) {
        // Check if the user role is Admin
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Admin') {
            // Execute admin-specific tasks
            echo "<p style='color: red;'>Admin task performed! Logs cleared, settings updated.</p>";
        } else {
            echo "<p style='color: red;'>You are not authorized to perform this action!</p>";
        }
    }
    ?>
</main>

<?php include '../includes/footer.php'; ?>
