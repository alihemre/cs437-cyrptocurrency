<?php
$articles = [
    ["id" => 1, "title" => "İlk Haber", "content" => "Bu, sitemizin ilk haberidir."],
    ["id" => 2, "title" => "İkinci Haber", "content" => "Bu, ikinci haberin detaylarıdır."]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haber Sitesi</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <h1>Haberler</h1>
    <ul>
        <?php foreach ($articles as $article): ?>
            <li>
                <a href="article.php?id=<?php echo $article['id']; ?>">
                    <?php echo $article['title']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
