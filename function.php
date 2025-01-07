<?php
class Database {
    private static $conn;

    public static function connect() {
        if (!self::$conn) {
            $host = '127.0.0.1:3307';
            $dbname = 'thrift_shop';
            $user = 'root';
            $pass = '04129';
            $dsn = "mysql:host=$host;dbname=$dbname";
            try {
                self::$conn = new PDO($dsn, $user, $pass);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                self::$conn = null;
            }
        }
        return self::$conn;
    }
}

class User {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
        if ($this->conn === null) {
            throw new Exception("Failed to connect to the database.");
        }
    }

    public function save($username, $first_name, $last_name, $hashed_password) {
        try {
            $query = $this->conn->prepare('CALL CreateUser(:username, :first_name, :last_name, :password);');
            $query->bindParam(':username', $username);
            $query->bindParam(':first_name', $first_name);
            $query->bindParam(':last_name', $last_name);
            $query->bindParam(':password', $hashed_password);
            
            if ($query->execute()) {
                return true;
            } else {
                print_r($query->errorInfo());
            }
        } catch (PDOException $e) {
            echo "PDOException: " . $e->getMessage();
        }
        return false;
    }
}
 