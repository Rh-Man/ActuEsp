<?php
require_once 'config.php';

class Category {
    private $pdo;
    
    public function __construct() {
        $this->pdo = getConnection();
    }
    
  
    public function getAllCategories() {
        $sql = "SELECT * FROM Categorie ORDER BY libelle";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
    
   
    public function getCategoryById($id) {
        $sql = "SELECT * FROM Categorie WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
  
    public function addCategory($libelle) {
        $sql = "INSERT INTO Categorie (libelle) VALUES (:libelle)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['libelle' => $libelle]);
        return $this->pdo->lastInsertId();
    }
    
  
    public function updateCategory($id, $libelle) {
        $sql = "UPDATE Categorie SET libelle = :libelle WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id, 'libelle' => $libelle]);
    }
    
  
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