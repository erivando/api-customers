<?php

namespace App\DAO;

abstract class Conexao{
    /**
     * @var \PDO
     */
    protected $pdo;

    public function __construct(){
        $host = getenv('TESTE_MYSQL_HOST');
        $port = getenv('TESTE_MYSQL_PORT');
        $pass = getenv('TESTE_MYSQL_PASSWORD');
        $user = getenv('TESTE_MYSQL_USER');
        $dbname = getenv('TESTE_MYSQL_DBNAME');

        $dsn = "mysql:host={$host};dbname={$dbname};port={$port};charset=utf8";

        $this->pdo = new \PDO($dsn, $user, $pass);
        $this->pdo->setAttribute(
            \PDO::ATTR_ERRMODE,
            \PDO::ERRMODE_EXCEPTION
        );
    }
}