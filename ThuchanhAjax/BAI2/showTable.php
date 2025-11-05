<?php
require_once("database.class.php");
$db = Database::getDB();

if (!isset($_GET['table'])) {
    echo "Chưa chọn bảng.";
    exit;
}

$table = $_GET['table'];
$allowed = ['giaovien', 'sinhvien', 'hocphan']; // chống truy cập sai

if (!in_array($table, $allowed)) {
    echo "Bảng không hợp lệ.";
    exit;
}

$query = "SELECT * FROM $table";
$stmt = $db->query($query);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($rows) == 0) {
    echo "Không có dữ liệu.";
    exit;
}

echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr style='background:navy;color:white;'>";
foreach (array_keys($rows[0]) as $col) {
    echo "<th>$col</th>";
}
echo "</tr>";

foreach ($rows as $r) {
    echo "<tr>";
    foreach ($r as $val) echo "<td>$val</td>";
    echo "</tr>";
}
echo "</table>";
?>
