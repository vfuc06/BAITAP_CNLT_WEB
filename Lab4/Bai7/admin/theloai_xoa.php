<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("../connect.php");

try {
    if (!isset($_GET["idTL"])) {
        echo "<script>alert('Không có ID thể loại'); location.href='theloai.php';</script>";
        exit;
    }

    $key = $_GET["idTL"];

    // Check if record exists
    $sql_check = "SELECT icon FROM theloai WHERE idTL = :idTL";
    $stmt_check = $connect->prepare($sql_check);
    $stmt_check->execute([':idTL' => $key]);
    $row = $stmt_check->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        echo "<script>alert('Thể loại không tồn tại'); location.href='theloai.php';</script>";
        exit;
    }

    // Delete record
    $sql = "DELETE FROM theloai WHERE idTL = :idTL";
    $stmt = $connect->prepare($sql);
    $stmt->execute([':idTL' => $key]);

    // Delete associated image file
    $image_path = 'C:/xampp/htdocs/XamppAtSchool/Lab4/Bai7/image/' . $row['icon'];
    if ($row['icon'] && file_exists($image_path)) {
        if (!unlink($image_path)) {
            error_log("Failed to delete image: $image_path");
        }
    }

    // Redirect to theloai.php
    echo "<script>alert('Xóa thành công'); location.href='theloai.php';</script>";
} catch (PDOException $e) {
    error_log("PDO Error: " . $e->getMessage());
    echo "<script>alert('Lỗi khi xóa: " . addslashes($e->getMessage()) . "'); location.href='theloai.php';</script>";
}
?>