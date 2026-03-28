<?php
require_once __DIR__ . '/../Database.php';

class Categoria {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Cria a categoria garantindo que está vinculada à empresa certa
    public function criar($empresa_id, $nome, $tipo) {
        $query = "INSERT INTO categorias (empresa_id, nome, tipo) VALUES (:empresa_id, :nome, :tipo)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':empresa_id', $empresa_id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':tipo', $tipo);
        
        return $stmt->execute();
    }

    // Busca apenas as categorias da empresa logada
    public function listarPorEmpresa($empresa_id) {
        $query = "SELECT * FROM categorias WHERE empresa_id = :empresa_id ORDER BY tipo, nome";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':empresa_id', $empresa_id);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
}