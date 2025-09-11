<?php
session_start();

// Połączenie z bazą MySQL
$pdo = new PDO("mysql:host=localhost;dbname=twoja_baza", "twoj_user", "twoje_haslo");

// Pobierz wpisane hasło
$password = $_POST['password'];

// Sprawdź w bazie
$stmt = $pdo->prepare("SELECT * FROM access WHERE password = ?");
$stmt->execute([hash('sha256', $password)]);
$match = $stmt->fetch();

if ($match) {
    $_SESSION['logged_in'] = true;
    header("Location: strona_glowna.php");
    exit;
} else {
    echo "<p style='color:red;text-align:center;margin-top:20px;'>❌ Złe hasło!</p>";
}
?>
