<?php
// Precisamos importar a conexão com o banco
require_once __DIR__ . '/../Database.php';

class Empresa {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Método para cadastrar uma nova empresa
    public function criar($nome_fantasia) {
        $query = "INSERT INTO empresas (nome_fantasia) VALUES (:nome_fantasia)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome_fantasia', $nome_fantasia);
        
        if ($stmt->execute()) {
            // O pulo do gato: retorna o ID que o banco acabou de gerar!
            return $this->conn->lastInsertId();
        }
        return false;
    }

    // Método para buscar todas as empresas cadastradas
    public function listarTodas() {
        $query = "SELECT * FROM empresas ORDER BY criado_em DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(); // Retorna os dados como um array associativo
    }
}