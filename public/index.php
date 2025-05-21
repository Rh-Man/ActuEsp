<?php
// Point d'entrée unique de l'application (Router)

// Définir le chemin de base
define('BASE_PATH', dirname(__DIR__));
// Définir l'URL de base
define('BASE_URL', '/ActuEsp');

// Inclure les contrôleurs
require_once BASE_PATH . '/controllers/HomeController.php';
require_once BASE_PATH . '/controllers/ArticleController.php';
require_once BASE_PATH . '/controllers/CategoryController.php';

// Routage simple
$action = isset($_GET['action']) ? $_GET['action'] : 'home';

// Instancier le contrôleur approprié et appeler la méthode correspondante
switch ($action) {
    case 'article':
        $controller = new ArticleController();
        $controller->show();
        break;
    
    case 'category':
        $controller = new CategoryController();
        $controller->index();
        break;
    
    case 'home':
    default:
        $controller = new HomeController();
        $controller->index();
        break;
}
?>

