<?php
require_once 'controllers/Controller.php';
require_once 'models/Alojamiento.php';

class HomeController extends Controller {
    private $alojamientoModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->alojamientoModel = new Alojamiento($db);
    }

    public function index() {
        $stmt = $this->alojamientoModel->read();
        $alojamientos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $this->render('home/index', ['alojamientos' => $alojamientos]);
    }
}
?>