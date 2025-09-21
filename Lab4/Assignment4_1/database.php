<?php
    try {
    $dsn = 'mysql:host=localhost;port=3307; dbname=my_guitar_shop1';
    $username = 'root';
    $password = '';
    // $username = 'mgs_user';
    // $password = 'pa55word';

    $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>
