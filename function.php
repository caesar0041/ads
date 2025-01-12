<?php
class Database {
    private static $conn;

    public static function connect() {
        if (!self::$conn) {
            $host = '127.0.0.1';
            $dbname = 'ads_final';
            $user = 'root';
            $pass = '';
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
    function getAllRecords() {
        $query = $this->conn->prepare("SELECT * FROM users");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
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
    public function trackSession($userId, $action) {
        try {
            $query = $this->conn->prepare('CALL TrackUserSession(:user_id, :action);');
            $query->bindParam(':user_id', $userId);
            $query->bindParam(':action', $action);

            return $query->execute();
        } catch (PDOException $e) {
            error_log("Error in trackSession function: " . $e->getMessage());
            return false;
        }
    }

    public function getUserById($user_id) {
        try {
            $query = $this->conn->prepare('SELECT * FROM users WHERE id = :user_id');
            $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in getUserById function: " . $e->getMessage());
            return false;
        }
    }
    
}

class Product{

    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
        if ($this->conn === null) {
            throw new Exception("Failed to connect to the database.");
        }
    }

    public function getAllProducts() {
        $query = $this->conn->prepare("SELECT * FROM products");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    }

    public function save($product_name, $description, $quantity, $category, $image, $price) {
        try {
            $query = $this->conn->prepare('CALL addproduct(:product_name, :description, :quantity, :category, :image, :price);');
            $query->bindParam(':product_name', $product_name);
            $query->bindParam(':description', $description);
            $query->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $query->bindParam(':category', $category);
            $query->bindParam(':image', $image);
            $query->bindParam(':price', $price);
            return $query->execute();
        } catch (PDOException $e) {
            error_log("Error in save function: " . $e->getMessage());
            return false;
        }
    }
    
    public function update($product_id, $product_name, $description, $quantity, $category, $image, $price){
        try {
            $query = $this->conn->prepare('CALL UpdateProduct(:product_id, :product_name, :description, :quantity, :category, :image, :price);');
            $query->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $query->bindParam(':product_name', $product_name);
            $query->bindParam(':description', $description);
            $query->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $query->bindParam(':category', $category);
            $query->bindParam(':image', $image);
            $query->bindParam(':price', $price);
            return $query->execute();
        } catch (PDOException $e) {
            error_log("Error in update function: " . $e->getMessage());
            return false;
        }
    }

    public function delete($product_id) {
        try {
            $query = $this->conn->prepare('CALL DeleteProduct(:product_id)');
            $query->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    
            if ($query->execute()) {
                return true;
            } else {
                error_log("Delete procedure execution failed: " . json_encode($query->errorInfo()));
                return false;
            }
        } catch (PDOException $e) {
            error_log("PDO Exception in delete method: " . $e->getMessage());
            return false;
        }
    }

    public function getProductById($product_id) {
        try {
            $query = $this->conn->prepare("SELECT * FROM products WHERE product_id = :product_id");
            $query->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in getProductById: " . $e->getMessage());
            return false;
        }
    }
    
}

class Cart {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
        if ($this->conn === null) {
            throw new Exception("Database connection failed.");
        }
    }

    public function getCartItems($user_id) {
        try {
            $query = $this->conn->prepare("
                SELECT c.cart_id, p.id as product_id, c.user_id, p.product_name, p.price, c.quantity
                FROM cart c
                JOIN products p ON c.product_id = p.id
                WHERE c.user_id = :user_id
            ");
            $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in getCartItems: " . $e->getMessage());
            return [];
        }
    }

    public function addToCart($user_id, $product_id, $quantity) {
        try {
            $query = $this->conn->prepare('CALL AddToCart(:user_id, :product_id, :quantity);');
            $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $query->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $query->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            return $query->execute();
        } catch (PDOException $e) {
            error_log("Error in addToCart: " . $e->getMessage());
            return false;
        }
    }

    // Update quantity for an item in the cart
    public function editCartItem($cart_id, $quantity) {
        try {
            $query = $this->conn->prepare('CALL EditCartItem(:cart_id, :quantity);');
            $query->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
            $query->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            return $query->execute();
        } catch (PDOException $e) {
            error_log("Error in editCartItem function: " . $e->getMessage());
            return false;
        }
    }

    // Remove an item from the cart
    public function removeCartItem($cart_id) {
        try {
            $query = $this->conn->prepare('CALL DeleteCartItem(:cart_id);');
            $query->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
            return $query->execute();
        } catch (PDOException $e) {
            error_log("Error in removeCartItem function: " . $e->getMessage());
            return false;
        }
    }

    // Clear all items for a specific user's cart
    public function clearCart($user_id) {
        try {
            $query = $this->conn->prepare('CALL ClearCart(:user_id);');
            $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            return $query->execute();
        } catch (PDOException $e) {
            error_log("Error in clearCart function: " . $e->getMessage());
            return false;
        }
    }
}
