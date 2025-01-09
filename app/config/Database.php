<?php

    namespace App\Config;

    use PDO;
    use PDOException;
    
    class Database {
        private static $conn;
        private static $instance = null;
    
        private $host = 'host.docker.internal';  
        private $db = 'devto_db';  
        private $user = 'root';  
        private $pass = 'root_password';  
        private $port = 3307;
    
        private function __construct() {
            try {
                $dsn = "mysql:host=$this->host;dbname=$this->db;port=$this->port";
                self::$conn = new PDO($dsn, $this->user, $this->pass);  
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }

        private function __clone(){
        }

        public function __wakeup(){
        }
    
        public static function getInstance() {
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }
    
        public static function getConnection() {
            return self::$conn;
        }
    
 
    }
    
    





