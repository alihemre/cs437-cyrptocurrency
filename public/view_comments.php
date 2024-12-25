<!-- public/view_comments.php -->
<?php
$title = "View Comments";
include '../includes/header.php'; 

// Database connection
$servername = "127.0.0.1"; // Use 127.0.0.1 to avoid socket issues
$username = "root"; // Default MySQL username
$password = ""; // Leave blank if no password is set
$dbname = "news_site"; // Your database name
$port = 3306; // Default MySQL port

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Fetch all comments from the Comment table
$sql = "SELECT name, message FROM Comment";
$result = $conn->query($sql);
?>

<style>
  .comments-container {
    padding: 20px;
  }

  .comment {
    padding: 15px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
  }

  .comment strong {
    display: block;
    font-size: 1.2em;
    margin-bottom: 5px;
  }
</style>

<main class="comments-container">
  <h2>All Comments</h2>

  <?php if ($result && $result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="comment">
        <strong><?php echo htmlspecialchars($row['name']); ?></strong>
        <p><?php echo htmlspecialchars($row['message']); ?></p>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>No comments available.</p>
  <?php endif; ?>

  <?php $conn->close(); ?>
</main>

<?php include '../includes/footer.php'; ?>
