<?php
$title = "Contact Us";
include '../includes/header.php';
?>
<main>
    <h2>Contact Us</h2>
    <form action="send_message.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>

        <button type="submit">Send</button>
    </form>
</main>
<?php include '../includes/footer.php'; ?>
