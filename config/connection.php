<?php 
    class DB {
        private static $localhost = "localhost";
        private static $username = "root";
        private static $password = "";
        private static $dbName = "ecommerce";

        public static function connect() {
            $conn = new mysqli(self::$localhost, self::$username, self::$password, self::$dbName);
            
           (!$conn->connect_error) or die("Connection Failed: ". $conn->connect_error);

           return $conn;
        }
    }
?>