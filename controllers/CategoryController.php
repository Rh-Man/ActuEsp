<?php
// controllers/CategoryController.php
require_once BASE_PATH . '/models/Category.php';

class CategoryController {
    private $categoryModel;
    
    public function __construct() {
        $this->categoryModel = new Category();
    }
    
    public function index() {
        // Récupération de toutes les catégories
        $categories = $this->categoryModel->getAllCategories();
        
        // Inclusion de la vue (à implémenter si nécessaire)
        // require_once BASE_PATH . '/views/categories/index.php';
    }
}
?>