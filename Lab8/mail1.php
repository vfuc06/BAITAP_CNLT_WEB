<?php

require "PHPMailer-master/src/PHPMailer.php";  // Đường dẫn đến PHPMailer.php
require "PHPMailer-master/src/SMTP.php";     // Đường dẫn đến SMTP.php
require 'PHPMailer-master/src/Exception.php'; // Đường dẫn đến Exception.php

$mail = new PHPMailer\PHPMailer\PHPMailer(true);  // True: Bật exceptions

try {
    // $mail->SMTPDebug = 2;  // Uncomment để debug, sau đó set về 0 khi ổn

    $mail->isSMTP();
    $mail->CharSet  = "utf-8";
    $mail->Host = 'smtp.gmail.com';  // SMTP server của Gmail
    $mail->SMTPAuth = true;          // Bật authentication

    $nguoigui = 'vp22tp@gmail.com';  // Email gửi của bạn
    $matkhau = 'pzxu acyb cbxc dvkk';     // App password từ Google
    $tennguoigui = 'Văn Phúc đzaiii';  // Tên người gửi

    $mail->Username = $nguoigui;     // SMTP username
    $mail->Password = $matkhau;      // SMTP password
    $mail->SMTPSecure = 'ssl';       // Sử dụng SSL (hoặc 'tls' nếu port 587)
    $mail->Port = 465;               // Port cho SSL (587 cho TLS)

    $mail->setFrom($nguoigui, $tennguoigui);
    $to = "quyn12479@gmail.com";   // Email nhận
    $to_name = "Quý ";             // Tên người nhận

    $mail->addAddress($to, $to_name); // Thêm người nhận

    $mail->isHTML(true);             // Set format email là HTML
    $mail->Subject = 'Test Website';  // Tiêu đề email
    $noidungthu = "<b>Chào bé Quý!</b><br>Chào bạn!";  // Nội dung email
    $mail->Body = $noidungthu;

    // Đính kèm file (tùy chọn)
    // $mail->AddAttachment("4.jpg", "picture");

    // Cấu hình SSL để tránh lỗi verify
    $mail->smtpConnect(array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true
        )
    ));

    $mail->send();
    echo 'Đã gửi mail xong';

} catch (Exception $e) {
    echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
}

?>