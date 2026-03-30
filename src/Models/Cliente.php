<?php
require_once __DIR__ . '/../Database.php';

class Cliente {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Abre a conta para um novo cliente
    public function criar($empresa_id, $nome) {
        $query = "INSERT INTO clientes (empresa_id, nome, status) VALUES (:empresa_id, :nome, 'aberto')";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':empresa_id', $empresa_id);
        $stmt->bindParam(':nome', $nome);
        return $stmt->execute();
    }


    // Busca apenas UM cliente específico (usaremos quando você clicar no card dele)
    public function buscarPorId($id, $empresa_id) {
        $query = "SELECT * FROM clientes WHERE id = :id AND empresa_id = :empresa_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':empresa_id', $empresa_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Fecha a conta e anota como o cliente pagou
    public function fecharConta($id, $empresa_id, $forma_pagamento) {
        $query = "UPDATE clientes SET status = 'pago', fechado_em = CURRENT_TIMESTAMP, forma_pagamento = :forma_pagamento WHERE id = :id AND empresa_id = :empresa_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':empresa_id', $empresa_id);
        $stmt->bindParam(':forma_pagamento', $forma_pagamento);
        return $stmt->execute();
    }

    // Busca os clientes com conta aberta E os que pagaram nas últimas 6 horas
    public function listarAtivosERecentes($empresa_id) {
        // A mágica acontece no WHERE com o INTERVAL '6 hours' do PostgreSQL
        $query = "SELECT c.id, c.nome, c.status, c.criado_em, c.fechado_em,
                         COALESCE(SUM(t.valor), 0) as total_conta
                  FROM clientes c
                  LEFT JOIN transacoes t ON t.cliente_id = c.id AND t.tipo = 'Entrada'
                  WHERE c.empresa_id = :empresa_id 
                    AND (c.status = 'aberto' OR (c.status = 'pago' AND c.fechado_em >= NOW() - INTERVAL '6 hours'))
                  GROUP BY c.id, c.nome, c.status, c.criado_em, c.fechado_em
                  ORDER BY c.status ASC, c.fechado_em DESC, c.criado_em DESC";
                  
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':empresa_id', $empresa_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}