<?php
require_once __DIR__ . '/../Database.php';

class Produto {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Adiciona um item novo no cardápio
    public function criar($empresa_id, $nome, $preco, $categoria_id) {
        $query = "INSERT INTO produtos (empresa_id, nome, preco, categoria_id) VALUES (:empresa_id, :nome, :preco, :categoria_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':empresa_id', $empresa_id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':categoria_id', $categoria_id);
        return $stmt->execute();
    }

    // Busca todos os itens do cardápio para mostrar na tela
    public function listarPorEmpresa($empresa_id) {
        $query = "SELECT p.*, c.nome as categoria_nome 
                  FROM produtos p 
                  LEFT JOIN categorias c ON p.categoria_id = c.id 
                  WHERE p.empresa_id = :empresa_id 
                  ORDER BY p.nome ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':empresa_id', $empresa_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    // Movimenta o estoque (subtrai ao vender, soma ao cancelar)
    public function movimentarEstoque($id, $empresa_id, $quantidade, $acao = 'subtrair') {
        $operador = $acao === 'subtrair' ? '-' : '+';
        $query = "UPDATE produtos SET quantidade_estoque = quantidade_estoque $operador :quantidade WHERE id = :id AND empresa_id = :empresa_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':empresa_id', $empresa_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}