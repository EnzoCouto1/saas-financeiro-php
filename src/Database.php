<?php

class Database {
    // Configurações do seu PostgreSQL
    private $host = 'localhost';
    private $port = '5432';
    private $db   = 'saas_financeiro';
    private $user = 'postgres'; 
    private $pass = 'admin123'; 
    
    private $pdo;

    public function connect() {
        if ($this->pdo === null) {
            try {
                // A string de conexão (DSN) específica para PostgreSQL
                $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db}";
                
                // Opções para tratamento de erros e formato de retorno
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];

                $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
                
            } catch (PDOException $e) {
                // Em produção, você não deve mostrar o erro real na tela, 
                // mas para desenvolvimento isso ajuda a debugar.
                die("Erro de conexão com o banco de dados: " . $e->getMessage());
            }
        }
        return $this->pdo;
    }
}