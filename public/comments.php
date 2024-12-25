<!-- public/comment.php -->
<?php
$title = "Comment";
include '../includes/header.php'; 

// Database connection
$servername = "127.0.0.1"; // Use 127.0.0.1 to avoid socket issues
$username = "root"; // Default MySQL username
$password = "aliemre3169"; // Leave blank if no password is set
$dbname = "news_site"; // Your database name
$port = 3306; // Default MySQL port

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Initialize variables
$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
$comment = isset($_POST['comment']) ? htmlspecialchars($_POST['comment']) : '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($name) && !empty($comment)) {
    // Prepare SQL to insert data into the Comment table
    $sql = "INSERT INTO Comment (name, message) VALUES (?, ?)";

    // Use prepared statements to avoid SQL injection
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $name, $comment);
        if ($stmt->execute()) {
            $message = "Thank you for your comment!";
        } else {
            $message = "Error: Could not save your comment. Please try again later.";
        }
        $stmt->close();
    } else {
        $message = "Error: Could not prepare the statement.";
    }
}
?>

<style>
  .comment-main {
    padding: 20px;
  }

  .comment-form {
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
  }

  .form-group {
    margin-bottom: 15px;
  }

  .form-group label {
    display: block;
    margin-bottom: 5px;
  }

  .form-group input, .form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .submit-button {
    padding: 10px 15px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .submit-button:hover {
    background-color: #0056b3;
  }
</style>

<main class="comment-main">
  <h2>Comment</h2>

  <?php if (isset($message)): ?>
    <div class="user-input">
      <p><?php echo $message; ?></p>
    </div>
  <?php endif; ?>

  <form action="#" method="post" class="comment-form">
    <div class="form-group">
      <label for="name">Your Name:</label>
      <input type="text" id="name" name="name" required>
    </div>

    <div class="form-group">
      <label for="comment">Your Comment:</label>
      <textarea id="comment" name="comment" required></textarea>
    </div>

    <button type="submit" class="submit-button">Send</button>
  </form>
</main>

<?php include '../includes/footer.php'; ?>
