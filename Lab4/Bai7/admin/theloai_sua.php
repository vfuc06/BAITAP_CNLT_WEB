<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("../connect.php");

try {
    if (isset($_GET['idTL'])) {
        $sql = "SELECT * FROM theloai WHERE idTL = :idTL";
        $stmt = $connect->prepare($sql);
        $stmt->execute([':idTL' => $_GET['idTL']]);
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$d) {
            echo "<script>alert('Thể loại không tồn tại'); location.href='theloai.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Không có ID thể loại'); location.href='theloai.php';</script>";
        exit;
    }
} catch (PDOException $e) {
    echo "<script>alert('Lỗi khi lấy dữ liệu: " . addslashes($e->getMessage()) . "'); location.href='theloai.php';</script>";
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sửa Thể Loại</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data" name="form1" onsubmit="return validateForm()">
        <table align="left" width="400">
            <tr>
                <td align="right">Tên Thể Loại</td>
                <td><input type="text" name="TenTL" id="TenTL" value="<?php echo htmlspecialchars($d['TenTL']); ?>" required /></td>
            </tr>
            <tr>
                <td align="right">Thứ Tự</td>
                <td><input type="text" name="ThuTu" value="<?php echo $d['ThuTu']; ?>" /></td>
            </tr>
            <tr>
                <td align="right">Ẩn/Hiện</td>
                <td>
                    <select name="AnHien">
                        <option value="0" <?php if ($d['AnHien'] == 0) echo "selected"; ?>>Ẩn</option>
                        <option value="1" <?php if ($d['AnHien'] == 1) echo "selected"; ?>>Hiện</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right">Icon</td>
                <td>
                    <?php if ($d['icon']) { ?>
                        <img src="../image/<?php echo htmlspecialchars($d['icon']); ?>" width="40" height="40" />
                    <?php } else { ?>
                        No Image
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td align="right">&nbsp;</td>
                <td>
                    <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/gif" />
                    <input type="hidden" name="ten_anh" value="<?php echo htmlspecialchars($d['icon']); ?>" />
                </td>
            </tr>
            <tr>
                <td align="right">
                    <input type="hidden" name="idTL" value="<?php echo $_GET['idTL']; ?>" />
                    <input type="submit" name="Sua" value="Sửa" />
                </td>
                <td><input type="reset" name="Huy" value="Hủy" /></td>
            </tr>
        </table>
    </form>
    <script>
        function validateForm() {
            let tenTL = document.getElementById('TenTL').value;
            if (tenTL.trim() === '') {
                alert('Tên thể loại không được để trống.');
                return false;
            }
            return true;
        }
    </script>

    <?php
    if (isset($_POST['Sua'])) {
        $theloai = $_POST['TenTL'];
        $thutu = $_POST['ThuTu'] ?: 0;
        $an = $_POST['AnHien'];
        $ten_file_tai_len = $_FILES['image']['name'];
        $icon = $ten_file_tai_len ?: $_POST['ten_anh'];
        $key = $_POST['idTL'];

        try {
            // Check for duplicate TenTL (excluding current record)
            $sql_check = "SELECT COUNT(*) as count FROM theloai WHERE TenTL = :TenTL AND idTL != :idTL";
            $stmt_check = $connect->prepare($sql_check);
            $stmt_check->execute([':TenTL' => $theloai, ':idTL' => $key]);
            $result = $stmt_check->fetch(PDO::FETCH_ASSOC);

            if ($result['count'] > 0) {
                echo "<script>alert('Tên thể loại \"$theloai\" đã tồn tại. Vui lòng chọn tên khác.'); location.href='theloai_sua.php?idTL=$key';</script>";
                exit;
            }

            // Validate file upload
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            if ($ten_file_tai_len && !in_array($_FILES['image']['type'], $allowed_types)) {
                echo "<script>alert('Chỉ chấp nhận file JPG, PNG, hoặc GIF!'); location.href='theloai_sua.php?idTL=$key';</script>";
                exit;
            }

            // Handle file upload if a new file is provided
            if ($ten_file_tai_len) {
                $upload_dir = 'C:/xampp/htdocs/XamppAtSchool/Lab4/Bai7/image/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $ten_file_tai_len)) {
                    echo "<script>alert('Lỗi khi upload ảnh!'); location.href='theloai_sua.php?idTL=$key';</script>";
                    exit;
                }
                // Delete old image if it exists and is different
                if ($ten_file_tai_len != $_POST['ten_anh'] && $_POST['ten_anh']) {
                    $old_image = $upload_dir . $_POST['ten_anh'];
                    if (file_exists($old_image)) {
                        unlink($old_image);
                    }
                }
            }

            // Update database
            $sql = "UPDATE theloai SET TenTL = :TenTL, ThuTu = :ThuTu, AnHien = :AnHien, icon = :icon WHERE idTL = :idTL";
            $stmt = $connect->prepare($sql);
            $stmt->execute([
                ':TenTL' => $theloai,
                ':ThuTu' => $thutu,
                ':AnHien' => $an,
                ':icon' => $icon,
                ':idTL' => $key
            ]);

            echo "<script>alert('Sửa thành công'); location.href='theloai.php';</script>";
        } catch (PDOException $e) {
            error_log("PDO Error: " . $e->getMessage());
            echo "<script>alert('Lỗi khi sửa: " . addslashes($e->getMessage()) . "'); location.href='theloai_sua.php?idTL=$key';</script>";
        }
    }
    ?>
</body>

</html>