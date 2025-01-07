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

            return $query->execute();
        } catch (PDOException $e) {
            error_log("Error in save function: " . $e->getMessage());
            return false;
        }
    }

    public function authenticate($username, $password) {
        try {
            $query = $this->conn->prepare("CALL AuthenticateUser(:username);");
            $query->bindParam(':username', $username);
            $query->execute();
    
            if ($query->rowCount() > 0) {
                $user = $query->fetch(PDO::FETCH_ASSOC);
                error_log("Password from DB: " . $user['pw']);
                error_log("Password entered: " . $password);
    
                if (password_verify($password, $user['pw'])) {
                    error_log("Password verification successful.");
                //    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
                    return $user;
                } else {
                    error_log("Password verification failed.");
                }
            } else {
                error_log("No user found with username: $username");
            }
        } catch (PDOException $e) {
            error_log("Error in authenticate function: " . $e->getMessage());
        }
        return false;
    }
    
}
