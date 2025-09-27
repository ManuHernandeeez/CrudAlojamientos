<?php
require_once 'controllers/Controller.php';
require_once 'models/AlojamientoUsuario.php';

class UserController extends Controller {
    private $alojamientoUsuarioModel;

    public function __construct() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] === 'admin') {
            header("Location: " . BASE_URL . "login");
            exit();
        }

        $database = new Database();
        $db = $database->getConnection();
        $this->alojamientoUsuarioModel = new AlojamientoUsuario($db);
    }

    public function index() {
        $alojamientos = $this->alojamientoUsuarioModel->readByUsuario($_SESSION['user_id'])->fetchAll(PDO::FETCH_ASSOC);
        $this->render('user/index', ['alojamientos' => $alojamientos]);
    }

    public function agregarAlojamiento() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $alojamiento_id = $_POST['alojamiento_id'] ?? 0;
            
            // Verificar si ya existe la selección
            $this->alojamientoUsuarioModel->usuario_id = $_SESSION['user_id'];
            $this->alojamientoUsuarioModel->alojamiento_id = $alojamiento_id;
            
            if ($this->alojamientoUsuarioModel->exists()) {
                $_SESSION['error'] = "Ya has seleccionado este alojamiento anteriormente.";
                header("Location: " . BASE_URL . "user/alojamientos");
                exit();
            }

            if ($this->alojamientoUsuarioModel->create()) {
                $_SESSION['success'] = "Alojamiento agregado correctamente.";
                header("Location: " . BASE_URL . "user/alojamientos");
                exit();
            }
        }
        
        header("Location: " . BASE_URL);
        exit();
    }

    public function eliminarAlojamiento() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $alojamiento_id = $_POST['alojamiento_id'] ?? 0;
            
            $this->alojamientoUsuarioModel->usuario_id = $_SESSION['user_id'];
            $this->alojamientoUsuarioModel->alojamiento_id = $alojamiento_id;

            if ($this->alojamientoUsuarioModel->delete()) {
                header("Location: " . BASE_URL . "user/alojamientos");
                exit();
            }
        }
        
        header("Location: " . BASE_URL . "user/alojamientos");
        exit();
    }
}
?>