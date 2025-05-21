<?php
// controllers/ArticleController.php
require_once BASE_PATH . '/models/Article.php';
require_once BASE_PATH . '/models/Category.php';

class ArticleController {
    private $articleModel;
    private $categoryModel;
    
    public function __construct() {
        $this->articleModel = new Article();
        $this->categoryModel = new Category();
    }
    
    public function show($id = null) {
        // Récupération de l'ID de l'article
        $articleId = $id ?? (isset($_GET['id']) ? (int)$_GET['id'] : 0);
        
        // Récupération de l'article
        $article = $this->articleModel->getArticleById($articleId);
        
        // Redirection si l'article n'existe pas
        if (!$article) {
            header("Location: " . BASE_URL . "/public/index.php");
            exit;
        }
        
        // Récupération de toutes les catégories pour le menu
        $categories = $this->categoryModel->getAllCategories();
        
        // Inclusion de la vue
        require_once BASE_PATH . '/views/layouts/header.php';
        require_once BASE_PATH . '/views/articles/show.php';
        require_once BASE_PATH . '/views/layouts/footer.php';
    }
}
?>