<?php
$articles = [
    1 => ["title" => "İlk Haber", "content" => "Bu, sitemizin ilk haberidir."],
    2 => ["title" => "İkinci Haber", "content" => "Bu, ikinci haberin detaylarıdır."]
];

$id = $_GET['id'] ?? null;

if (!isset($articles[$id])) {
    die("Haber bulunamadı.");
}

$article = $articles[$id];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $article['title']; ?></title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <h1><?php echo $article['title']; ?></h1>
    <p><?php echo $article['content']; ?></p>
    <a href="index.php">Geri Dön</a>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
