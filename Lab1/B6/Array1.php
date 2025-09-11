<?php
    $ket_qua = 0;
    $mang_so = array();
    if(isset($_POST['btn_goi'])){
        // Lấy chuỗi từ ô input
        $chuoi = $_POST['nhap_mang'];

        // Tách thành mảng theo dấu phẩy
        $mang_so = explode(",", $chuoi);

        // Tính tổng các phần tử
        $n = count($mang_so);
        for($i = 0; $i < $n; $i++){
            $ket_qua += $mang_so[$i];
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Array1</title>
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
    td {
        padding: 5px;
    }
    </style>
</head>
<body>
    <form method="POST" action="Array1.php">
        <table border="1">
            <thead>
                <tr>
                    <th colspan="2">NHẬP VÀ TÍNH TRÊN DÃY SỐ</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nhập dãy số:</td>
                    <td>
                        <input type="text" name="nhap_mang" 
                               value="<?php if(isset($_POST['nhap_mang'])) echo htmlspecialchars($_POST['nhap_mang']); ?>">
                        <br><small>(Ví dụ: 1,2,3,4)</small>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="btn_goi" value="Tổng dãy số" ></td>
                </tr>
                <tr>
                    <td>Tổng dãy số:</td>
                    <td>
                        <input type="text" disabled="disabled" 
                               value="<?php echo $ket_qua; ?>" >
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</body>
</html>
