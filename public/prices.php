<?php
$title = "Prices";
include '../includes/header.php';

// Placeholder data (replace with API/database integration)
$cryptos = [
    ["name" => "Bitcoin", "symbol" => "BTC", "price" => "50000", "change" => "+5%"],
    ["name" => "Ethereum", "symbol" => "ETH", "price" => "3500", "change" => "-2%"],
];
?>
<main>
    <h2>Cryptocurrency Prices</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Symbol</th>
                <th>Price (USD)</th>
                <th>Change</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cryptos as $crypto): ?>
            <tr>
                <td><?php echo $crypto['name']; ?></td>
                <td><?php echo $crypto['symbol']; ?></td>
                <td><?php echo $crypto['price']; ?></td>
                <td><?php echo $crypto['change']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
<?php include '../includes/footer.php'; ?>
