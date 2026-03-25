<?php
require_once __DIR__ . '/../Database.php';

class Usuario {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Método para cadastrar um novo usuário vinculado a uma empresa
    public function criar($empresa_id, $nome, $email, $senha) {
        // 1. CRIPTOGRAFIA DE SENHA (O diferencial pro currículo)
        // O BCRYPT gera um hash seguro e irreversível
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        // 2. Prepara a query de inserção (evitando SQL Injection)
        $query = "INSERT INTO usuarios (empresa_id, nome, email, senha_hash) 
                  VALUES (:empresa_id, :nome, :email, :senha_hash)";
        
        $stmt = $this->conn->prepare($query);
        
        // 3. Vincula os parâmetros
        $stmt->bindParam(':empresa_id', $empresa_id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha_hash', $senha_hash);
        
        // 4. Executa e retorna true se der certo
        try {
            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            // Se o email já existir, o banco vai dar erro (pois colocamos UNIQUE na tabela)
            return false;
        }
        
        return false;
    }
    
    // Método para listar os usuários de uma empresa específica (Regra do SaaS!)
    public function listarPorEmpresa($empresa_id) {
        $query = "SELECT id, nome, email, criado_em FROM usuarios WHERE empresa_id = :empresa_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':empresa_id', $empresa_id);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
}