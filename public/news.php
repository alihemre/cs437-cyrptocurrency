<?php
$title = "News";
include '../includes/header.php';

// Placeholder news articles
$articles = [
    ["id" => 1, "title" => "Bitcoin Hits $50K!", "summary" => "Bitcoin reaches a new milestone."],
    ["id" => 2, "title" => "Ethereum Merge Update", "summary" => "Ethereum completes its major update."]
];
?>
<main>
    <h2>Cryptocurrency News</h2>
    <ul>
        <?php foreach ($articles as $article): ?>
        <li>
            <a href="article.php?id=<?php echo $article['id']; ?>"><?php echo $article['title']; ?></a>
            <p><?php echo $article['summary']; ?></p>
        </li>
        <?php endforeach; ?>
    </ul>
</main>
<?php include '../includes/footer.php'; ?>
