<?php
class AlojamientoUsuario {
    private $conn;
    private $table_name = "alojamientos_usuario";

    public $id;
    public $usuario_id;
    public $alojamiento_id;
    public $fecha_seleccion;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                (usuario_id, alojamiento_id) 
                VALUES (?, ?)";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$this->usuario_id, $this->alojamiento_id]);
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " 
                WHERE usuario_id = ? AND alojamiento_id = ?";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$this->usuario_id, $this->alojamiento_id]);
    }

    public function readByUsuario($usuario_id) {
        $query = "SELECT a.* 
                FROM alojamientos a 
                INNER JOIN " . $this->table_name . " au ON a.id = au.alojamiento_id 
                WHERE au.usuario_id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$usuario_id]);
        return $stmt;
    }

    public function exists() {
        $query = "SELECT COUNT(*) FROM alojamientos_usuario 
                 WHERE usuario_id = :usuario_id AND alojamiento_id = :alojamiento_id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":usuario_id", $this->usuario_id);
        $stmt->bindParam(":alojamiento_id", $this->alojamiento_id);
        $stmt->execute();
        
        return $stmt->fetchColumn() > 0;
    }
}
?>