<?php
$title = "Top 100 Prices";
include '../includes/header.php';

/**
 * cURL ile HTTP GET isteği yapıp yanıtı döndüren yardımcı fonksiyon
 */
function curl_get_contents($url) {
    $ch = curl_init();
    // İstek yapılacak URL
    curl_setopt($ch, CURLOPT_URL, $url);

    // Dönen cevabı direkt ekrana basmak yerine değişkende tutalım
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // Coingecko bazen User-Agent başlığı olmayan isteklere sınırlama uygulayabiliyor.
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (CryptoApp)');

    // Zaman aşımı sürelerini ayarlayabilirsiniz (opsiyonel)
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);

    // İstek gönder, cevabı al
    $response = curl_exec($ch);

    // cURL bir hata döndürmüşse görelim
    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
        return false;
    }

    // HTTP status kodunu da kontrol edebilirsiniz
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($httpCode !== 200) {
        echo "HTTP status code: $httpCode<br>";
        echo "Response: $response<br>";
        return false;
    }

    curl_close($ch);
    return $response;
}

/*
  1. Adım: İlk 100 coini (piyasa değeri en yüksek) USD cinsinden çek.
     - vs_currency=usd
     - order=market_cap_desc (piyasa değerine göre büyükten küçüğe)
     - per_page=100 (ilk 100 coin)
     - page=1 (birinci sayfa)
     - sparkline=false (grafik verisi istemiyoruz)
*/
$usd_endpoint = "https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=100&page=1&sparkline=false";
$responseUSD = curl_get_contents($usd_endpoint);
if ($responseUSD === false) {
    echo "USD verisi çekilirken bir sorun oluştu!";
    exit;
}
$dataUSD = json_decode($responseUSD, true);

/*
  2. Adım: Aynı 100 coini TRY cinsinden çek.
*/
$try_endpoint = "https://api.coingecko.com/api/v3/coins/markets?vs_currency=try&order=market_cap_desc&per_page=100&page=1&sparkline=false";
$responseTRY = curl_get_contents($try_endpoint);
if ($responseTRY === false) {
    echo "TRY verisi çekilirken bir sorun oluştu!";
    exit;
}
$dataTRY = json_decode($responseTRY, true);

/*
  3. Adım: TRY verilerini coin 'id' üzerinden bir diziye kaydediyoruz.
     Daha sonra USD listesini dolaşırken, ilgili 'id' sayesinde TRY fiyatını eşleştirip tek dizide birleştireceğiz.
*/
$tryPrices = [];
foreach ($dataTRY as $coin) {
    $coinId = $coin['id'];
    $tryPrices[$coinId] = $coin['current_price'];
}

/*
  4. Adım: USD verileri üzerinden dönüp, tek bir $prices dizisi oluşturuyoruz.
     - name, symbol, price_usd, price_try gibi alanları tutacağız.
*/
$prices = [];
foreach ($dataUSD as $coin) {
    $coinId     = $coin['id'];
    $coinName   = $coin['name'];
    $coinSymbol = strtoupper($coin['symbol']);
    $priceUSD   = $coin['current_price'];

    // TRY fiyatını, TRY dizisinden eşleştiriyoruz.
    $priceTRY   = isset($tryPrices[$coinId]) ? $tryPrices[$coinId] : 0;

    $prices[] = [
        'id'         => $coinId,
        'name'       => $coinName,
        'symbol'     => $coinSymbol,
        'price_usd'  => $priceUSD,
        'price_try'  => $priceTRY
    ];
}

/*
  5. Adım: Search (Arama) işlemi
  GET parametresinden 'search' değeri alınıyor.
  Bu değer boş değilse, $prices üzerinde name veya symbol eşleşmeleri aranıyor.
*/
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';

if (!empty($searchQuery)) {
    // Arama terimini küçük harfe çevir (case-insensitive arama için)
    $lowerSearch = mb_strtolower($searchQuery);

    // $prices dizisini filtrele
    $prices = array_filter($prices, function($coin) use ($lowerSearch) {
        // Coin'in adı veya sembolünde arama terimini arayalım
        $coinName   = mb_strtolower($coin['name']);
        $coinSymbol = mb_strtolower($coin['symbol']);

        // Ad veya sembolde geçiyorsa true döner
        return (strpos($coinName, $lowerSearch) !== false || 
                strpos($coinSymbol, $lowerSearch) !== false);
    });
    // array_filter sonucu yine bir dizi döner,
    // eğer sonuç boşsa, tablo boş görünür.
}
?>

<div class="content">
  <main>
    <h2>Top 100 Cryptocurrency Prices (USD & TRY)</h2>
    
    <!-- 6. Adım: Arama Formu -->
    <form method="GET" style="margin-bottom: 20px;">
      <input 
        type="text" 
        name="search" 
        placeholder="Search by coin name or symbol..." 
        value="<?php echo htmlspecialchars($searchQuery); ?>"
      />
      <button type="submit">Search</button>
    </form>

    <!-- Sonuç Tablosu -->
    <table>
      <thead>
        <tr>
          <th>Coin</th>
          <th>Symbol</th>
          <th>Price (USD)</th>
          <th>Price (TRY)</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($prices)): ?>
          <?php foreach ($prices as $coin): ?>
            <tr>
              <td><?php echo htmlspecialchars($coin['name']); ?></td>
              <td><?php echo htmlspecialchars($coin['symbol']); ?></td>
              <td><?php echo number_format($coin['price_usd'], 2); ?></td>
              <td><?php echo number_format($coin['price_try'], 2); ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="4">No coins found for "<?php echo htmlspecialchars($searchQuery); ?>"</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </main>
</div>

<?php include '../includes/footer.php'; ?>
