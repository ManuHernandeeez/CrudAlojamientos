<?php
class Controller {
    protected function render($view, $data = []) {
        
        extract($data);
        
        
        ob_start();
        
        
        include "views/{$view}.php";
        
        
        $content = ob_get_clean();
        
        
        include "views/layouts/main.php";
    }
    
    protected function redirect($url) {
        header("Location: " . BASE_URL . $url);
        exit();
    }
}
?>