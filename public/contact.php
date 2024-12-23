<!-- public/contact.php -->
<?php
$title = "Contact";
include './includes/header.php'; 
?>

<main>
  <h2>Contact Us</h2>
  <form action="#" method="post">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br><br>
  
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>
  
    <label for="message">Message:</label><br>
    <textarea id="message" name="message" rows="5" cols="40" required></textarea><br><br>
  
    <button type="submit">Send</button>
  </form>
</main>

<?php include './includes/footer.php'; ?>
