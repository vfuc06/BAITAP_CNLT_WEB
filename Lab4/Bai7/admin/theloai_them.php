<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Thêm Thể Loại</title>
</head>

<body>
    <form action="theloai_them_xl.php" method="post" enctype="multipart/form-data" name="form1" onsubmit="return validateForm()">
        <table align="left" width="400">
            <tr>
                <td align="right">Tên Thể Loại:</td>
                <td><input type="text" name="TenTL" id="TenTL" value="" required /></td>
            </tr>
            <tr>
                <td align="right">Thứ Tự:</td>
                <td><input type="text" name="ThuTu" value="" /></td>
            </tr>
            <tr>
                <td align="right">Ẩn/Hiện:</td>
                <td>
                    <select name="AnHien">
                        <option value="0">Ẩn</option>
                        <option value="1" selected>Hiện</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right">Icon:</td>
                <td><input type="file" name="image" id="anh" accept="image/jpeg,image/png,image/gif" /></td>
            </tr>
            <tr>
                <td align="right"><input type="submit" name="Them" value="Thêm" /></td>
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
</body>

</html>