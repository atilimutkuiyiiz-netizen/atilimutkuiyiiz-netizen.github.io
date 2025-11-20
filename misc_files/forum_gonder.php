<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form verilerini al
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $konu_basligi = htmlspecialchars($_POST['konu_basligi']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $mesaj = htmlspecialchars($_POST['mesaj']);
    
    // E-posta ayarları
    $to = "atilimutkuiyiiz@gmail.com";
    $subject = "Yeni Forum Konusu: " . $konu_basligi;
    
    // E-posta içeriği
    $message = "
    YENİ FORUM KONUSU - AUI PLATFORM
    
    E-posta: $email
    Konu Başlığı: $konu_basligi
    Kategori: $kategori
    
    Mesaj:
    $mesaj
    
    ---
    Bu mesaj AUI Platform Forum'undan gönderilmiştir.
    Tarih: " . date('d.m.Y H:i:s') . "
    ";
    
    // E-posta başlıkları
    $headers = "From: AUI Platform Forum <noreply@auiplatform.space>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";
    
    // E-posta gönder
    if (mail($to, $subject, $message, $headers)) {
        echo json_encode(["success" => true, "message" => "✅ Mesajınız başarıyla gönderildi!"]);
    } else {
        echo json_encode(["success" => false, "message" => "❌ E-posta gönderilemedi. Lütfen tekrar deneyin."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "❌ Geçersiz istek methodu."]);
}
?>