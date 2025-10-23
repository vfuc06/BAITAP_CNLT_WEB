<?php
require "PHPMailer-master/src/PHPMailer.php";
require "PHPMailer-master/src/SMTP.php";
require "PHPMailer-master/src/Exception.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        // ⚙️ Kết nối cơ sở dữ liệu
        $pdo = new PDO('mysql:host=localhost;port=3307;dbname=practicecrud', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 🔍 Lấy tất cả email trong bảng users
        $stmt = $pdo->query("SELECT email FROM users");
        $emails = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // 📧 Cấu hình SMTP Gmail
        $mail->isSMTP();
        $mail->SMTPDebug = 2; // Xem log gửi mail (để test, gửi xong có thể tắt)
        $mail->Debugoutput = 'html';
        $mail->CharSet = "utf-8";
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        $mail->Username = 'vp22tp@gmail.com'; // Gmail của bạn
        $mail->Password = 'pzxu acyb cbxc dvkk'; // Mật khẩu ứng dụng (App Password)
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS; // Chuẩn mới nhất
        $mail->Port = 587;

        $mail->setFrom('vp22tp@gmail.com', 'Văn Phúc đzaiiii 😎');

        // ➕ Thêm tất cả email từ CSDL
        foreach ($emails as $email) {
            $mail->addAddress($email);
        }

        // 📄 Tiêu đề + nội dung từ form
        $mail->isHTML(true);
        $mail->Subject = $_POST['tieude'];
        $mail->Body = '
        <div style="font-family: Arial; padding: 10px; border-radius: 10px; background: #f1f2f6;">
            <h3 style="color:#0984e3;">Xin chào bạn 💌</h3>
            <p>' . nl2br($_POST['content']) . '</p>
            <p style="font-size: 13px; color: gray;">— Gửi từ hệ thống của Văn Phúc đzaiiii</p>
        </div>';

        // 📎 File đính kèm (nếu có)
        if (!empty($_FILES['file']['tmp_name'])) {
            $mail->addAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        }

        // 🚀 Gửi mail
        $mail->send();
        echo "<h3 style='color:green; text-align:center;'>✅ Gửi email thành công đến tất cả người nhận!</h3>";
    } catch (Exception $e) {
        echo "<h3 style='color:red;'>❌ Lỗi gửi mail: {$mail->ErrorInfo}</h3>";
    } catch (PDOException $e) {
        echo "<h3 style='color:red;'>❌ Lỗi CSDL: {$e->getMessage()}</h3>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Gửi Email Hàng Loạt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #74b9ff, #a29bfe);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            width: 520px;
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            background: #fff;
        }
        .card-header {
            background: #0984e3;
            color: white;
            font-size: 1.4rem;
            font-weight: 600;
            text-align: center;
            border-radius: 15px 15px 0 0;
            letter-spacing: 0.5px;
        }
        .btn-primary {
            background: #0984e3;
            border: none;
        }
        .btn-primary:hover {
            background: #74b9ff;
        }
        label {
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">📨 Gửi Email Hàng Loạt</div>
    <div class="card-body p-4">
        <form action="" enctype="multipart/form-data" method="POST">
            <div class="mb-3">
                <label for="tieude" class="form-label">Tiêu đề Email</label>
                <input type="text" class="form-control" name="tieude" placeholder="Nhập tiêu đề email" required>
            </div>

            <div class="mb-3">
                <label for="editor" class="form-label">Nội dung Email</label>
                <textarea name="content" id="editor" class="form-control" rows="6"></textarea>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Tệp đính kèm (nếu có)</label>
                <input type="file" class="form-control" name="file">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary px-4 py-2">🚀 Gửi Email</button>
            </div>
        </form>
    </div>
</div>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
ClassicEditor
    .create(document.querySelector('#editor'))
    .then(editor => { console.log('CKEditor đã khởi tạo!'); })
    .catch(error => { console.error(error); });
</script>

</body>
</html>
