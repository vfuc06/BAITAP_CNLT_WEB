<?php
// Khai báo mảng rỗng ban đầu
$mang_so = array();
$mang_duy_nhat = array();
$so_lan = array();
$chuoi = "";

// Nếu người dùng đã nhập mảng
if(isset($_POST['nhap_mang'])){
    // Tách chuỗi nhập vào thành mảng, phân cách bằng dấu ,
    $mang_so = explode(",", $_POST['nhap_mang']);

    // Tạo mảng duy nhất (loại bỏ phần tử trùng)
    $mang_duy_nhat = array_unique($mang_so);

    // Đếm số lần xuất hiện của từng phần tử
    $so_lan = array_count_values($mang_so);

    // Tạo chuỗi kết quả số lần xuất hiện
    foreach($so_lan as $key => $value){
        $chuoi .= $key . ":" . $value . "  ";
    }
}

// Hàm in ra mảng duy nhất
function mang_duy_nhat($mang_so){
    if(isset($mang_so[0])){
        echo implode(", ", $mang_so);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>ĐẾM SỐ LẦN XUẤT HIỆN VÀ TẠO MẢNG DUY NHẤT</title>
    <meta charset="utf-8">
    <style>
    *{
        font-family: Tahoma;
    }
    table{
        width: 400px;
        margin: 100px auto;
        border-collapse: collapse;
    }
    table th{
        background: #66CCFF;
        padding: 10px;
        font-size: 18px;
    }
    input{
        width: 100%;
    }
    td {
        padding: 5px;
    }
    </style>
</head>
<body>
    <form action="Array3.php" method="POST">
        <table border="1">
            <thead>
                <tr>
                    <th colspan="2">ĐẾM SỐ LẦN XUẤT HIỆN VÀ TẠO MẢNG DUY NHẤT</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Mảng:</td>
                    <td><input type="text" name="nhap_mang" value="<?php echo isset($_POST['nhap_mang']) ? $_POST['nhap_mang'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td>Số lần xuất hiện:</td>
                    <td><input type="text" disabled value="<?php echo $chuoi; ?>"></td>
                </tr>
                <tr>
                    <td>Mảng duy nhất:</td>
                    <td><input type="text" disabled value="<?php mang_duy_nhat($mang_duy_nhat); ?>"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Thực hiện"></td>
                </tr>
            </tbody>
        </table>
    </form>
</body>
</html>
