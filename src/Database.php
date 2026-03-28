<?php

class Database {
    private $host;
    private $port;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    public function __construct() {
        // Lê o arquivo .env e transforma as linhas em um array
        $envPath = __DIR__ . '/../.env';
        
        if (file_exists($envPath)) {
            $env = parse_ini_file($envPath);
            $this->host = $env['DB_HOST'] ?? 'localhost';
            $this->port = $env['DB_PORT'] ?? '5432';
            $this->db_name = $env['DB_NAME'] ?? 'saas_financeiro';
            $this->username = $env['DB_USER'] ?? 'postgres';
            $this->password = $env['DB_PASS'] ?? '';
        } else {
            die("Erro crítico: Arquivo .env não encontrado. Crie um baseado no .env.example");
        }
    }

    public function connect() {
        $this->conn = null;

        try {
            $dsn = "pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name;
            $this->conn = new PDO($dsn, $this->username, $this->password);
            
            // Configura o PDO para lançar exceções em caso de erro (ajuda muito a debugar)
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
        } catch(PDOException $e) {
            // Em produção, nós salvaríamos o erro em um log, mas não mostraríamos na tela.
            echo "Erro de conexão com o banco de dados. " . $e->getMessage();
        }

        return $this->conn;
    }
}