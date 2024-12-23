<?php
$title = "Prices";
include './includes/header.php';

// Placeholder price data
$prices = [
  ["name" => "Bitcoin",   "symbol" => "BTC", "price" => 50000],
  ["name" => "Ethereum",  "symbol" => "ETH", "price" => 2000],
  ["name" => "Litecoin",  "symbol" => "LTC", "price" => 150],
  ["name" => "Cardano",   "symbol" => "ADA", "price" => 1.20],
];
?>

<div class="content">
  <main>
    <h2>Current Cryptocurrency Prices</h2>
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Symbol</th>
          <th>Price (USD)</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($prices as $coin): ?>
        <tr>
          <td><?php echo $coin['name']; ?></td>
          <td><?php echo $coin['symbol']; ?></td>
          <td><?php echo number_format($coin['price'], 2); ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </main>
</div>

<?php include './includes/footer.php'; ?>
