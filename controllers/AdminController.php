<?php
require_once 'controllers/Controller.php';
require_once 'models/Alojamiento.php';

class AdminController extends Controller {
    private $alojamientoModel;

    public function __construct() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
            header("Location: " . BASE_URL . "login");
            exit();
        }

        $database = new Database();
        $db = $database->getConnection();
        $this->alojamientoModel = new Alojamiento($db);
    }

    public function index() {
        
        $stmt = $this->alojamientoModel->readAll();
        $alojamientos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->render('admin/index', ['alojamientos' => $alojamientos]);
    }

    public function crearAlojamiento() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->alojamientoModel->nombre = $_POST['nombre'] ?? '';
            $this->alojamientoModel->descripcion = $_POST['descripcion'] ?? '';
            $this->alojamientoModel->precio = $_POST['precio'] ?? 0;
            $this->alojamientoModel->ubicacion = $_POST['ubicacion'] ?? '';
            $this->alojamientoModel->tipo_alojamiento = $_POST['tipo_alojamiento'] ?? '';
            $this->alojamientoModel->capacidad = $_POST['capacidad'] ?? 1;
            $this->alojamientoModel->imagen_url = $_POST['imagen_url'] ?? '';
            $this->alojamientoModel->servicios = $_POST['servicios'] ?? '';

            if ($this->alojamientoModel->create()) {
                header("Location: " . BASE_URL . "admin/alojamientos");
                exit();
            } else {
                $this->render('admin/crear', ['error' => 'Error al crear el alojamiento']);
                return;
            }
        }

        $this->render('admin/crear');
    }

    public function editarAlojamiento() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->alojamientoModel->id = $_POST['id'] ?? 0;
            $this->alojamientoModel->nombre = $_POST['nombre'] ?? '';
            $this->alojamientoModel->descripcion = $_POST['descripcion'] ?? '';
            $this->alojamientoModel->precio = $_POST['precio'] ?? 0;
            $this->alojamientoModel->ubicacion = $_POST['ubicacion'] ?? '';
            $this->alojamientoModel->tipo_alojamiento = $_POST['tipo_alojamiento'] ?? '';
            $this->alojamientoModel->capacidad = $_POST['capacidad'] ?? 1;
            $this->alojamientoModel->imagen_url = $_POST['imagen_url'] ?? '';
            $this->alojamientoModel->servicios = $_POST['servicios'] ?? '';
            $this->alojamientoModel->activo = isset($_POST['activo']) ? 1 : 0;

            if ($this->alojamientoModel->update()) {
                header("Location: " . BASE_URL . "admin/alojamientos");
                exit();
            } else {
                $this->render('admin/editar', ['error' => 'Error al actualizar el alojamiento']);
                return;
            }
        }

        
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: " . BASE_URL . "admin/alojamientos");
            exit();
        }

        $alojamiento = $this->alojamientoModel->readOne($id);
        if (!$alojamiento) {
            header("Location: " . BASE_URL . "admin/alojamientos");
            exit();
        }

        $this->render('admin/editar', ['alojamiento' => $alojamiento]);
    }

    public function eliminarAlojamiento() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? 0;
            if ($this->alojamientoModel->softDelete($id)) {
                header("Location: " . BASE_URL . "admin/alojamientos");
                exit();
            }
        }

        header("Location: " . BASE_URL . "admin/alojamientos");
        exit();
    }
}
?>