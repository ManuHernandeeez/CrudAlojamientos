<?php
require_once 'controllers/Controller.php';
require_once 'models/Usuario.php';

class AuthController extends Controller {
    private $usuarioModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->usuarioModel = new Usuario($db);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            // Validaciones básicas
            $errors = [];
            
            if (empty($email)) {
                $errors[] = 'El email es requerido';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'El formato del email no es válido';
            }
            
            if (empty($password)) {
                $errors[] = 'La contraseña es requerida';
            }

            if (!empty($errors)) {
                $data['error'] = implode('. ', $errors);
                $this->render('auth/login', $data);
                return;
            }

            if ($usuario = $this->usuarioModel->login($email, $password)) {
                $_SESSION['user_id'] = $usuario['id'];
                $_SESSION['user_name'] = $usuario['nombre'];
                $_SESSION['user_type'] = $usuario['tipo_usuario'];
                
                $this->redirect('');
            } else {
                $data['error'] = 'Credenciales inválidas';
                $this->render('auth/login', $data);
            }
        } else {
            $this->render('auth/login');
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            // Validaciones básicas
            $errors = [];
            
            if (empty($nombre)) {
                $errors[] = 'El nombre es requerido';
            } elseif (strlen($nombre) < 2) {
                $errors[] = 'El nombre debe tener al menos 2 caracteres';
            } elseif (strlen($nombre) > 50) {
                $errors[] = 'El nombre no puede exceder 50 caracteres';
            }
            
            if (empty($email)) {
                $errors[] = 'El email es requerido';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'El formato del email no es válido';
            }
            
            if (empty($password)) {
                $errors[] = 'La contraseña es requerida';
            } elseif (strlen($password) < 6) {
                $errors[] = 'La contraseña debe tener al menos 6 caracteres';
            } elseif (strlen($password) > 100) {
                $errors[] = 'La contraseña no puede exceder 100 caracteres';
            }

            if (!empty($errors)) {
                $data['error'] = implode('. ', $errors);
                $this->render('auth/register', $data);
                return;
            }

            $this->usuarioModel->nombre = $nombre;
            $this->usuarioModel->email = $email;
            $this->usuarioModel->password = $password;
            $this->usuarioModel->tipo_usuario = 'usuario';

            if ($this->usuarioModel->create()) {
                $this->redirect('login');
            } else {
                $data['error'] = 'Error al registrar el usuario';
                $this->render('auth/register', $data);
            }
        } else {
            $this->render('auth/register');
        }
    }

    public function logout() {
        session_destroy();
        $this->redirect('');
    }
}
?>