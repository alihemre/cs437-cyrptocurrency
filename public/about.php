<?php
session_start(); // Kullanıcı oturumunu başlat

// Kullanıcı giriş yapmış mı kontrol et
if (!isset($_SESSION['user_id'])) {
    http_response_code(403); // 403: Erişim Reddedildi
    echo "Access denied. You must be logged in to view this page.";
    exit;
}

// Sadece admin erişimine izin ver
if ($_SESSION['role'] !== 'admin') {
    http_response_code(403); // 403: Erişim Reddedildi
    echo "Access denied. You do not have the required permissions.";
    exit;
}

// Eval Injection Endpoint (Sadece Test Amaçlı)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['code'])) {
    $input = $_POST['code']; // Kullanıcı girdisi
    try {
        // Kullanıcı girdisini eval() ile çalıştır
        $result = eval($input);
        echo json_encode(["output" => $result]); // Sonucu JSON olarak döndür
    } catch (Throwable $e) {
        // Hata durumunda mesaj döndür
        echo json_encode(["error" => $e->getMessage()]);
    }
    exit; // Ana sayfa içeriğinin yüklenmesini engelle
}
?>

<main class="about-main">
  <h2>About Us</h2>
  <p>We are dedicated to bringing you the latest cryptocurrency news and price updates.</p>
  <p>Our mission is to simplify the complex world of digital assets for the everyday user.</p>
</main>

<?php include '../includes/footer.php'; ?>
