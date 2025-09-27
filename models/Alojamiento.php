<?php
class Alojamiento {
    private $conn;
    private $table_name = "alojamientos";

    public $id;
    public $nombre;
    public $descripcion;
    public $precio;
    public $ubicacion;
    public $tipo_alojamiento;
    public $capacidad;
    public $imagen_url;
    public $servicios;
    public $fecha_creacion;
    public $activo;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE activo = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY fecha_creacion DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Leer un alojamiento por id
    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                (nombre, descripcion, precio, ubicacion, tipo_alojamiento, 
                capacidad, imagen_url, servicios, activo) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        // Limpiar datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->precio = htmlspecialchars(strip_tags($this->precio));
        $this->ubicacion = htmlspecialchars(strip_tags($this->ubicacion));
        $this->tipo_alojamiento = htmlspecialchars(strip_tags($this->tipo_alojamiento));
        $this->capacidad = htmlspecialchars(strip_tags($this->capacidad));
        $this->imagen_url = htmlspecialchars(strip_tags($this->imagen_url));
        $this->servicios = htmlspecialchars(strip_tags($this->servicios));

        // Ejecutar query
        return $stmt->execute([
            $this->nombre,
            $this->descripcion,
            $this->precio,
            $this->ubicacion,
            $this->tipo_alojamiento,
            $this->capacidad,
            $this->imagen_url,
            $this->servicios,
            1 // activo por defecto
        ]);
    }

    // Actualizar un alojamiento
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET 
            nombre = ?, descripcion = ?, precio = ?, ubicacion = ?, tipo_alojamiento = ?, capacidad = ?, imagen_url = ?, servicios = ?, activo = ?
            WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        // Limpiar datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->precio = htmlspecialchars(strip_tags($this->precio));
        $this->ubicacion = htmlspecialchars(strip_tags($this->ubicacion));
        $this->tipo_alojamiento = htmlspecialchars(strip_tags($this->tipo_alojamiento));
        $this->capacidad = htmlspecialchars(strip_tags($this->capacidad));
        $this->imagen_url = htmlspecialchars(strip_tags($this->imagen_url));
        $this->servicios = htmlspecialchars(strip_tags($this->servicios));
        $this->activo = (int)$this->activo;

        return $stmt->execute([
            $this->nombre,
            $this->descripcion,
            $this->precio,
            $this->ubicacion,
            $this->tipo_alojamiento,
            $this->capacidad,
            $this->imagen_url,
            $this->servicios,
            $this->activo,
            $this->id
        ]);
    }

    // Borrado lógico (marcar como inactivo)
    public function softDelete($id) {
        $query = "UPDATE " . $this->table_name . " SET activo = 0 WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>