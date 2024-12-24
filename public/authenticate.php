<?php
session_start(); // Kullanıcı oturumunu başlat

// Örnek kullanıcı bilgileri (gerçek bir veritabanıyla değiştirilmeli)
$users = [
    'admin' => ['password' => 'admin123', 'role' => 'admin'],
    'user' => ['password' => 'user123', 'role' => 'user']
];

// Formdan gelen kullanıcı bilgilerini al
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Kullanıcı adı doğrulaması
if (isset($users[$username]) && $users[$username]['password'] === $password) {
    // Giriş başarılı, oturum verilerini ayarla
    $_SESSION['user_id'] = $username;
    $_SESSION['role'] = $users[$username]['role'];
    header('Location: /about.php'); // Başarılı girişten sonra yönlendirme
    exit;
} else {
    // Giriş başarısız
    header('Location: /login.php?error=1');
    exit;
}
?>
