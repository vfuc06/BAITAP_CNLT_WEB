<?php
if (isset($_POST["ten"])) {
    $ten = $_POST["ten"];
    echo "Chào bạn " . htmlspecialchars(string: $ten);
}
?>
