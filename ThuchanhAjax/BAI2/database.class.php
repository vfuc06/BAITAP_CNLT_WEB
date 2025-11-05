<?php
class Database {
    private static $dsn = 'mysql:host=localhost;port=3307;dbname=udn;charset=utf8';
    private static $username = 'root';  // hoặc tài khoản của bạn
    private static $password = '';
    private static $db;

    private function __construct() {}

    public static function getDB() {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn, self::$username, self::$password);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Lỗi kết nối CSDL: " . $e->getMessage();
                exit();
            }
        }
        return self::$db;
    }
}
?>
