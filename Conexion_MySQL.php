<?php
class BaseDatos {
    private $host = 'localhost';
    private $dbName = 'noticias';
    private $user = 'buscador'; 
    private $puerto = '3306';
    private $password = '12345'; 
    private $charset = 'utf8mb4';
    private $connection;

    public function __construct() {
        $dsn = "mysql:host={$this->host};port={$this->puerto};dbname={$this->dbName};charset={$this->charset}";
        
        try {
            $this->connection = new PDO($dsn, $this->user, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            
            error_log("Connection Error: " . $e->getMessage());
            die("Error interno en el servidor de datos.");
        }
    }

    public function Conexion(): PDO {
        return $this->connection;
    }
}
