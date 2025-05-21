<?php
// controllers/HomeController.php
require_once BASE_PATH . '/models/Article.php';
require_once BASE_PATH . '/models/Category.php';

class HomeController {
    private $articleModel;
    private $categoryModel;
    
    public function __construct() {
        $this->articleModel = new Article();
        $this->categoryModel = new Category();
    }
    
    public function index() {
        // Récupération de la catégorie sélectionnée (si présente)
        $selectedCategoryId = isset($_GET['category']) ? (int)$_GET['category'] : null;
        
        // Récupération des articles selon la catégorie sélectionnée
        if ($selectedCategoryId) {
            $articles = $this->articleModel->getArticlesByCategory($selectedCategoryId);
        } else {
            $articles = $this->articleModel->getAllArticles();
        }
        
        // Récupération de toutes les catégories
        $categories = $this->categoryModel->getAllCategories();
        
        // Liste des images disponibles
        $availableImages = [
           'Sn.png',
           'ChatGPT Image 9 avr. 2025, 19_38_25.png',
           'can-2025-maroc.jpg',
           'ChatGPT Image 9 avr. 2025, 19_38_23.png',
           'ChatGPT Image 9 avr. 2025, 19_38_20.png',
        ];
        
        // Inclusion de la vue
        require_once BASE_PATH . '/views/layouts/header.php';
        require_once BASE_PATH . '/views/home/index.php';
        require_once BASE_PATH . '/views/layouts/footer.php';
    }
}
?>