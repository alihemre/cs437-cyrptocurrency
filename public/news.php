<?php
$title = "News";
include '../includes/header.php';

/* ===============================
   FETCH NEWS FROM COINTELEGRAPH RSS
================================= */
$rss_url = "https://cointelegraph.com/rss";  // CoinTelegraph’s RSS feed
$rss = @simplexml_load_file($rss_url);       // Use '@' to suppress warnings if feed fails

$articles = []; // This will hold the parsed RSS items

if ($rss && isset($rss->channel->item)) {
    // Build an $articles array similar to your previous structure
    $i = 1;
    foreach ($rss->channel->item as $item) {
        $title    = (string) $item->title;
        $summary  = (string) $item->description;  // Short description from the RSS
        $link     = (string) $item->link;
        $pubDate  = (string) $item->pubDate;      // e.g. "Mon, 09 Oct 2023 08:00:00 +0000"

        // If you want to format the date: 
        // $formattedDate = date("d M Y, H:i", strtotime($pubDate));

        // Push into $articles array
        $articles[] = [
            'id'      => $i++,
            'title'   => $title,
            'summary' => $summary,
            'link'    => $link,
            // 'date' => $formattedDate, // (optional if you want to show formatted date)
        ];
    }
} else {
    // RSS feed couldn’t be loaded or is invalid
    // Optionally display an error message or leave $articles empty
    echo "<p style='color:red;'>CoinTelegraph RSS feed alınamadı. Lütfen bağlantıyı kontrol edin.</p>";
    // $articles stays empty
}

/* ===============================
   DEFINE YOUR COINS ARRAY (RIGHT SIDEBAR)
================================= */
$coins = [
  [
    'name' => 'Bitcoin',
    'symbol' => 'BTC',
    'price_usd' => 50000,
    'price_try' => 1350000,
    // Make sure to use forward slashes in paths, especially on Windows:
    'image' => 'assets/coins/Bitcoin.svg.png'
  ],
  [
    'name' => 'Ethereum',
    'symbol' => 'ETH',
    'price_usd' => 2000,
    'price_try' => 54000,
    'image' => 'assets/coins/Ethereum-icon-purple.svg.png'
  ],
  // ... up to 40 coins ...
];
?>

<div class="content">
  <main class="news-wrapper">
    
    <!-- LEFT: Main News Content -->
    <div class="news-content">
      <h2>Cryptocurrency News (CoinTelegraph)</h2>

      <div class="news-list">
        <?php if (!empty($articles)): ?>
          <?php foreach ($articles as $article): ?>
            <div class="news-card">
              <!-- Title -->
              <h3>
                <!-- Link to CoinTelegraph article in new tab -->
                <a href="<?php echo $article['link']; ?>" target="_blank" rel="noopener noreferrer">
                  <?php echo $article['title']; ?>
                </a>
              </h3>

              <!-- Optional: If you wanted to show date:
              <p><strong>Date:</strong> <?php // echo $article['date']; ?></p>
              -->

              <!-- Summary from RSS -->
              <p><?php echo $article['summary']; ?></p>

              <!-- "Read More" link to direct user to the original article -->
              <a href="<?php echo $article['link']; ?>" target="_blank" rel="noopener noreferrer" class="read-more">
                Read More &rarr;
              </a>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No news found or RSS could not be loaded.</p>
        <?php endif; ?>
      </div>
    </div>

    <!-- RIGHT: Coins Sidebar -->
    <aside class="coins-sidebar">
      <h3>Coins</h3>
      <!-- Search box to filter coins -->
      <input
        type="text"
        id="coinSearch"
        placeholder="Search a coin..."
        class="coins-searchbox"
      />

      <!-- List of coins -->
      <ul id="coinsList" class="coins-list">
        <?php foreach ($coins as $index => $coin): ?>
          <li class="coin-row">
            <!-- Image on left -->
            <img
              src="<?php echo $coin['image']; ?>"
              alt="<?php echo $coin['symbol']; ?>"
              class="coin-icon"
            >
            
            <!-- Coin name/symbol in middle -->
            <span class="coin-name">
              <?php echo $coin['name']; ?> (<?php echo $coin['symbol']; ?>)
            </span>
            
            <!-- Prices on the right -->
            <span class="coin-price">
              $<?php echo number_format($coin['price_usd'], 2); ?>
              /
              <?php echo number_format($coin['price_try'], 2); ?> TRY
            </span>
          </li>
        <?php endforeach; ?>
      </ul>

      <!-- Show More button -->
      <button id="showMoreCoins" class="show-more-btn">
        Show More
      </button>
    </aside>

  </main>
</div>

<?php include '../includes/footer.php'; ?>

<!-- JavaScript for searching & "Show More" logic -->
<script>
  // DOM elements
  const coinRows = document.querySelectorAll('.coin-row');
  const showMoreBtn = document.getElementById('showMoreCoins');
  const coinSearch = document.getElementById('coinSearch');

  // How many rows to show initially
  const initialLimit = 10;

  // Hide beyond the first 10 by default
  function applyInitialLimit() {
    coinRows.forEach((row, index) => {
      if (index < initialLimit) {
        row.style.display = 'flex';
      } else {
        row.style.display = 'none';
      }
    });
    // Only show the button if more than 10 coins
    showMoreBtn.style.display =
      (coinRows.length > initialLimit) ? 'block' : 'none';
  }

  // "Show More" reveals all
  showMoreBtn.addEventListener('click', () => {
    coinRows.forEach(row => {
      row.style.display = 'flex';
    });
    showMoreBtn.style.display = 'none';
  });

  // Filter coins by search query
  coinSearch.addEventListener('input', () => {
    const query = coinSearch.value.toLowerCase().trim();
    coinRows.forEach((row) => {
      const text = row.innerText.toLowerCase();
      if (text.includes(query)) {
        row.style.display = 'flex';
      } else {
        row.style.display = 'none';
      }
    });
    // If searching, hide the "Show More" button because
    // we don't want to limit results. If query is empty, revert.
    if (query.length > 0) {
      showMoreBtn.style.display = 'none';
    } else {
      applyInitialLimit();
    }
  });

  // On page load, set initial limit
  applyInitialLimit();
</script>
