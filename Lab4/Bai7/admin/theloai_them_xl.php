<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('../connect.php');

// Xử lý upload ảnh
$icon = $_FILES['image']['name'];
$anhminhhoa_tmp = $_FILES['image']['tmp_name'];

// Đường dẫn tuyệt đối tới thư mục image
$upload_dir = 'C:/xampp/htdocs/XamppAtSchool/Lab4/Bai7/image/';
$upload_path = $upload_dir . basename($icon);

// Kiểm tra thư mục tồn tại, nếu không thì tạo
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Validate file upload
$allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
if ($icon && !in_array($_FILES['image']['type'], $allowed_types)) {
    echo "<script>alert('Chỉ chấp nhận file JPG, PNG, hoặc GIF!'); location.href='theloai_them.php';</script>";
    exit;
}
if ($icon && !move_uploaded_file($anhminhhoa_tmp, $upload_path)) {
    echo "<script>alert('Lỗi khi upload ảnh!'); location.href='theloai_them.php';</script>";
    exit;
}
if (!$icon) {
    $icon = ''; // Nếu không có ảnh, đặt giá trị rỗng
}

$theloai = $_POST['TenTL'];
$thutu = $_POST['ThuTu'] ?: 0;
$an = $_POST['AnHien'];

// Kiểm tra input rỗng
if (empty($theloai)) {
    echo "<script>alert('Tên thể loại không được để trống.'); location.href='theloai_them.php';</script>";
    exit;
}

try {
    // Kiểm tra xem TenTL đã tồn tại chưa
    $sql_check = "SELECT COUNT(*) as count FROM theloai WHERE TenTL = :TenTL";
    $stmt_check = $connect->prepare($sql_check);
    $stmt_check->execute([':TenTL' => $theloai]);
    $result = $stmt_check->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        echo "<script>alert('Tên thể loại \"$theloai\" đã tồn tại. Vui lòng chọn tên khác.'); location.href='theloai_them.php';</script>";
        exit;
    }

    // Insert dữ liệu
    $sql = "INSERT INTO theloai (TenTL, ThuTu, AnHien, icon) VALUES (:TenTL, :ThuTu, :AnHien, :icon)";
    $stmt = $connect->prepare($sql);
    $stmt->execute([
        ':TenTL' => $theloai,
        ':ThuTu' => $thutu,
        ':AnHien' => $an,
        ':icon' => $icon
    ]);
    echo "<script>alert('Thêm thành công'); location.href='theloai.php';</script>";
} catch (PDOException $e) {
    error_log("PDO Error: " . $e->getMessage());
    echo "<script>alert('Lỗi khi thêm: " . addslashes($e->getMessage()) . "'); location.href='theloai_them.php';</script>";
}
