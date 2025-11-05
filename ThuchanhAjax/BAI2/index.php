<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>OOP with PHP</title>
<link href="style.css" rel="stylesheet">

<script>
function ajax() {
    let obj = document.getElementById("chon").value;
    if (obj == "") {
        document.getElementById("info").style.display = "none";
        return;
    }

    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("info").style.display = "block";
            document.getElementById("info").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open("GET", "showTable.php?table=" + obj, true);
    xhttp.send();
}
</script>
</head>

<body>
<h1>OOP with PHP</h1>

<select id="chon" onChange="ajax();">
    <option value="">-- Chọn --</option>
    <option value="giaovien">Giáo viên</option>
    <option value="sinhvien">Sinh viên</option>
    <option value="hocphan">Học phần</option>
</select>

<hr>
<div id="info" style="display:none;"></div>

</body>
</html>
