<!-- public/news.php -->
<?php
$title = "News";
include './includes/header.php'; 

// Example placeholder articles
$articles = [
  ["id" => 1, "title" => "Bitcoin Hits $50K", "summary" => "Bitcoin reached an all-time high..."],
  ["id" => 2, "title" => "Ethereum Merge Update", "summary" => "Ethereum's shift to Proof-of-Stake..."],
  ["id" => 3, "title" => "Altcoin Rally", "summary" => "Several altcoins see double-digit gains..."]
];
?>

<main>
  <h2>Cryptocurrency News</h2>
  <ul>
    <?php foreach ($articles as $article): ?>
      <li>
        <!-- Link to a detailed article page, passing ID via GET -->
        <a href="article.php?id=<?php echo $article['id']; ?>">
          <?php echo $article['title']; ?>
        </a>
        <p><?php echo $article['summary']; ?></p>
      </li>
    <?php endforeach; ?>
  </ul>
</main>

<?php include './includes/footer.php'; ?>
