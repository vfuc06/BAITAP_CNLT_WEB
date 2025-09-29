<?php
try {
     $dsn = 'mysql:host=localhost;port=3307;dbname=my_guitar_shop1';
    $username = 'root';
    $password = '';
    $connect = new PDO($dsn, $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connect->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
    die("Error: Could not connect to the database. An error " . $e->getMessage() . " occurred.");
}
?>