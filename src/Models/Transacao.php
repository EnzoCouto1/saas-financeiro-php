<?php
require_once __DIR__ . '/../Database.php';

class Transacao {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Grava o dinheiro entrando ou saindo
    public function criar($empresa_id, $usuario_id, $categoria_id, $descricao, $valor, $tipo, $data_transacao) {
        $query = "INSERT INTO transacoes (empresa_id, usuario_id, categoria_id, descricao, valor, tipo, data_transacao) 
                  VALUES (:empresa_id, :usuario_id, :categoria_id, :descricao, :valor, :tipo, :data_transacao)";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':empresa_id', $empresa_id);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':categoria_id', $categoria_id);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':data_transacao', $data_transacao);
        
        return $stmt->execute();
    }

    // Busca o extrato completo da empresa cruzando dados com a tabela de categorias
    public function listarPorEmpresa($empresa_id) {
        $query = "SELECT t.*, c.nome as categoria_nome 
                  FROM transacoes t
                  JOIN categorias c ON t.categoria_id = c.id
                  WHERE t.empresa_id = :empresa_id 
                  ORDER BY t.data_transacao DESC, t.id DESC";
                  
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':empresa_id', $empresa_id);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    // Calcula o total de receitas, despesas e o saldo atual
    public function calcularResumo($empresa_id) {
        // Usamos o recurso SUM do SQL para fazer a matemática pesada direto no banco
        $query = "SELECT 
                    SUM(CASE WHEN tipo = 'Entrada' THEN valor ELSE 0 END) as total_receitas,
                    SUM(CASE WHEN tipo = 'Saida' THEN valor ELSE 0 END) as total_despesas
                  FROM transacoes 
                  WHERE empresa_id = :empresa_id";
                  
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':empresa_id', $empresa_id);
        $stmt->execute();
        
        $resultado = $stmt->fetch();

        // Se não tiver nada no banco, garante que o valor seja 0
        $receitas = $resultado['total_receitas'] ?? 0;
        $despesas = $resultado['total_despesas'] ?? 0;
        $saldo = $receitas - $despesas;

        return [
            'receitas' => $receitas,
            'despesas' => $despesas,
            'saldo' => $saldo
        ];
    }
}