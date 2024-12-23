<?php
$title = "Article Details";
include '../includes/header.php';

$article_id = $_GET['id'] ?? null;

// Placeholder article details
$article = [
    "id" => $article_id,
    "title" => "Bitcoin Hits $50K!",
    "content" => "Bitcoin has reached a new milestone, hitting $50,000 for the first time.",
];

if (!$article_id || $article_id != $article['id']) {
    die("Article not found.");
}
?>
<main>
    <h2><?php echo $article['title']; ?></h2>
    <p><?php echo $article['content']; ?></p>
</main>
<?php include '../includes/footer.php'; ?>
