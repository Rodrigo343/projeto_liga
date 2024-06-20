<?php 

namespace App\DAO;

abstract class Conexao
{

    protected $pdo;

    public function __construct()
    {
        $host = getenv('GERENCIADOR_DE_LOJAS_MYSQL_HOST');
        $port = getenv('GERENCIADOR_DE_LOJAS_MYSQL_PORT');
        $user = getenv('GERENCIADOR_DE_LOJAS_MYSQL_USER');
        $pass = getenv('GERENCIADOR_DE_LOJAS_MYSQL_PASSWORD');
        $dbname = getenv('GERENCIADOR_DE_LOJAS_MYSQL_DBNAME');

        $dsn = "mysql:host={$host};dbname={$dbname};port={$port}";

        $this->pdo = new \PDO($dsn, $user, $pass);
        $this->pdo->setAttribute(
            \PDO::ATTR_ERRMODE,
            \PDO::ERRMODE_EXCEPTION
        );
    }
}

?>