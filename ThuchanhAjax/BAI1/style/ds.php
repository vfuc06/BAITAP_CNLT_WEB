<?php
include("../inc/connect.inc");

// Kiểm tra xem có truyền tham số 'lop' không
if (isset($_GET['lop']) && $_GET['lop'] != "") {
    $lop = $_GET['lop'];

    $sql = "SELECT * FROM sinhvien WHERE lop = '{$lop}'";
    $rs = mysqli_query($con, $sql);

    $str = "<table>";
    $str .= "<tr class='hd'>
                <td>TT</td>
                <td>Mã số</td>
                <td>Họ tên</td>
                <td>Địa chỉ</td>
             </tr>";
    $tt = 1;
    while ($row = mysqli_fetch_array($rs)) {
        $str .= "<tr>
                    <td>{$tt}</td>
                    <td>{$row['masv']}</td>
                    <td>{$row['hoten']}</td>
                    <td>{$row['diachi']}</td>
                 </tr>";
        $tt++;
    }
    $str .= "</table>";

    echo $str;
} else {
    // Nếu chưa có 'lop' thì không làm gì hoặc báo thông báo nhẹ
    echo "Chưa chọn lớp.";
}
?>
