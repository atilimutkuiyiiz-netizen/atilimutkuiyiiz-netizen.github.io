<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Form alanlarını al ve temizle
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST["message"]));

    // Alan doğrulaması
    if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Lütfen tüm alanları doğru şekilde doldurun.'); window.history.back();</script>";
        exit;
    }

    // Alıcı adres
    $to = "atilimutkuiyiiz@gmail.com";

    // Konu başlığı
    $subject = "📩 AUI Platform - Yeni İletişim Formu Mesajı";

    // E-posta içeriği
    $body = "Yeni bir iletişim formu mesajı alındı:\n\n";
    $body .= "👤 Ad Soyad: $name\n";
    $body .= "✉️ E-posta: $email\n\n";
    $body .= "📝 Mesaj:\n$message\n";
    $body .= "\n------------------------------------\n";
    $body .= "Gönderim zamanı: " . date("d.m.Y H:i") . "\n";
    $body .= "Kaynak: https://auiplatform.space/iletisim.html\n";

    // Başlıklar
    $headers = "From: AUI Platform <no-reply@auiplatform.space>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Mail gönder
    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Mesajınız başarıyla gönderildi: Teşekkür ederiz.'); window.location.href='/iletisim.html';</script>";
    } else {
        echo "<script>alert('Mesaj gönderilirken bir hata oluştu. Lütfen tekrar deneyin.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Form gönderme hatası.'); window.history.back();</script>";
}
?>
