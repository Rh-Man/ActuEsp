<?php
require_once BASE_PATH . '/config/database.php';

class Category {
    private $pdo;
    
    public function __construct() {
        $this->pdo = getConnection();
    }
    
    /**
     * Récupère toutes les catégories
     */
    public function getAllCategories() {
        $sql = "SELECT * FROM Categorie ORDER BY libelle";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
    
    /**
     * Récupère une catégorie par son ID
     */
    public function getCategoryById($id) {
        $sql = "SELECT * FROM Categorie WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
    /**
     * Ajoute une nouvelle catégorie
     */
    public function addCategory($libelle) {
        $sql = "INSERT INTO Categorie (libelle) VALUES (:libelle)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['libelle' => $libelle]);
        return $this->pdo->lastInsertId();
    }
    
    /**
     * Met à jour une catégorie existante
     */
    public function updateCategory($id, $libelle) {
        $sql = "UPDATE Categorie SET libelle = :libelle WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id, 'libelle' => $libelle]);
    }
    
    /**
     * Supprime une catégorie
     */
    public function deleteCategory($id) {
        // Vérifier si des articles sont liés à cette catégorie
        $checkSql = "SELECT COUNT(*) FROM Article WHERE categorie = :id";
        $checkStmt = $this->pdo->prepare($checkSql);
        $checkStmt->execute(['id' => $id]);
        
        if ($checkStmt->fetchColumn() > 0) {
            return false; // Ne pas supprimer si des articles sont liés
        }
        
        $sql = "DELETE FROM Categorie WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
?>