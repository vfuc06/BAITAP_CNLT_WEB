<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Danh Sách Thể Loại</title>
</head>

<body>
    <?php include_once('../connect.php'); ?>
    <table align="center" border="1" width="600">
        <tr align="center">
            <td>Tên Thể Loại</td>
            <td>Thứ Tự</td>
            <td>Ẩn/Hiện</td>
            <td>Biểu Tượng</td>
            <td colspan="2"><a href="theloai_them.php">Thêm</a></td>
        </tr>
        <?php
        try {
            $sql = "SELECT * FROM theloai";
            $stmt = $connect->query($sql);
            $count = $stmt->rowCount();
            echo "Số bản ghi: $count<br>";
            while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
                <tr align="center">
                    <td><?php echo htmlspecialchars($rows['TenTL']); ?></td>
                    <td><?php echo $rows['ThuTu']; ?></td>
                    <td><?php echo ($rows['AnHien'] == 1) ? "Hiện" : "Ẩn"; ?></td>
                    <td>
                        <?php if ($rows['icon']) { ?>
                            <img src="../image/<?php echo htmlspecialchars($rows['icon']); ?>" width="40" height="40" />
                        <?php } else { ?>
                            No Image
                        <?php } ?>
                    </td>
                    <td><a href="theloai_sua.php?idTL=<?php echo $rows['idTL']; ?>">Sửa</a></td>
                    <td><a href="theloai_xoa.php?idTL=<?php echo $rows['idTL']; ?>" onclick="return confirm('Bạn có chắc chắn không?');">Xóa</a></td>
                </tr>
        <?php
            }
        } catch (PDOException $e) {
            echo 'Lỗi: ', $e->getMessage();
        }
        ?>
    </table>
</body>

</html>