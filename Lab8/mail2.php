<?php

require "PHPMailer-master/src/PHPMailer.php";  // Đường dẫn đến PHPMailer.php
require "PHPMailer-master/src/SMTP.php";     // Đường dẫn đến SMTP.php
require 'PHPMailer-master/src/Exception.php'; // Đường dẫn đến Exception.php

if (isset($_POST)) {
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);  // True: Bật exceptions

    try {
        // $mail->SMTPDebug = 2;  // Uncomment để debug

        $mail->isSMTP();
        $mail->CharSet  = "utf-8";
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        $nguoigui = 'vp22tp@gmail.com';  // Email gửi
        $matkhau = 'pzxu acyb cbxc dvkk';                 // App password
        $tennguoigui = 'Văn Phúc';             // Tên người gửi

        $mail->Username = $nguoigui;
        $mail->Password = $matkhau;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom($nguoigui, $tennguoigui);
        $to = $_POST['email'];                // Email nhận từ form
        $to_name = "mấy con gà";                     // Tên người nhận mặc định

        $tieude = $_POST['tieude'];           // Tiêu đề từ form

        $mail->addAddress($to, $to_name);
        
        $mail->isHTML(true);
        $mail->Subject = $tieude;

        $noidungthu = '<div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><b>Xin chào ' . $to_name . '</b></h5>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <p class="card-text">' . $_POST['content'] . '</p>
            </div>
        </div>';
        $mail->Body = $noidungthu;

        // Xử lý file đính kèm nếu có
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
            $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['file']['name']));
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                $mail->addAttachment($uploadfile, $_FILES['file']['name']);
            }
        }

        // Cấu hình SSL
        $mail->smtpConnect(array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        ));

        if ($mail->send()) {
            header("Location: bai2.php");  // Redirect về form sau khi gửi thành công
        }
    } catch (Exception $e) {
        echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
    }
}

?>