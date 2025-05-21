<?php
// models/Article.php
require_once BASE_PATH . '/config/database.php';

class Article {
    private $pdo;
    
    public function __construct() {
        $this->pdo = getConnection();
    }
    
    /**
     * Récupère tous les articles avec leur catégorie
     */
    public function getAllArticles() {
        $sql = "SELECT a.*, c.libelle as categorie_libelle 
                FROM Article a 
                JOIN Categorie c ON a.categorie = c.id 
                ORDER BY a.dateCreation DESC";
        
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
    
    /**
     * Récupère les articles d'une catégorie spécifique
     */
    public function getArticlesByCategory($categoryId) {
        $sql = "SELECT a.*, c.libelle as categorie_libelle 
                FROM Article a 
                JOIN Categorie c ON a.categorie = c.id 
                WHERE a.categorie = :categoryId 
                ORDER BY a.dateCreation DESC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['categoryId' => $categoryId]);
        return $stmt->fetchAll();
    }
    
    /**
     * Récupère un article par son ID
     */
    public function getArticleById($articleId) {
        $sql = "SELECT a.*, c.libelle as categorie_libelle 
                FROM Article a 
                JOIN Categorie c ON a.categorie = c.id 
                WHERE a.id = :articleId";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['articleId' => $articleId]);
        return $stmt->fetch();
    }
    
    /**
     * Ajoute un nouvel article
     */
    public function addArticle($titre, $contenu, $categorieId) {
        $sql = "INSERT INTO Article (titre, contenu, categorie) 
                VALUES (:titre, :contenu, :categorie)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'titre' => $titre,
            'contenu' => $contenu,
            'categorie' => $categorieId
        ]);
        
        return $this->pdo->lastInsertId();
    }
    
    /**
     * Met à jour un article existant
     */
    public function updateArticle($id, $titre, $contenu, $categorieId) {
        $sql = "UPDATE Article 
                SET titre = :titre, 
                    contenu = :contenu, 
                    categorie = :categorie,
                    dateModification = NOW()
                WHERE id = :id";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'titre' => $titre,
            'contenu' => $contenu,
            'categorie' => $categorieId
        ]);
    }
    
    /**
     * Supprime un article
     */
    public function deleteArticle($id) {
        $sql = "DELETE FROM Article WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
?>
