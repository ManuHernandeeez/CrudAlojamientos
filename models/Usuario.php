<?php
class Usuario {
    private $conn;
    private $table_name = "usuarios";

    public $id;
    public $nombre;
    public $email;
    public $password;
    public $tipo_usuario;
    public $fecha_registro;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                (nombre, email, password, tipo_usuario) 
                VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        // Limpiar datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->tipo_usuario = htmlspecialchars(strip_tags($this->tipo_usuario));

        // Ejecutar query
        if($stmt->execute([$this->nombre, $this->email, $this->password, $this->tipo_usuario])) {
            return true;
        }
        return false;
    }

    public function login($email, $password) {
        $query = "SELECT id, nombre, email, password, tipo_usuario 
                FROM " . $this->table_name . " 
                WHERE email = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);
        
        if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if(password_verify($password, $row['password'])) {
                return $row;
            }
        }
        return false;
    }
}
?>